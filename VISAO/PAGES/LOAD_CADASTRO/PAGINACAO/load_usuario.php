<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../../CONTROLO/Conexao.php';
include_once '../../../../DAO/UsuarioDAO.php';

$objUsuarioDAO = new UsuarioDAO($_SESSION['dbname']);

$pagina = addslashes(htmlspecialchars(isset($_GET['pagina']))) ? addslashes(htmlspecialchars($_GET['pagina'])) : 1;

$res = $objUsuarioDAO->buscar_usuarios();
$total = $res->rowCount();
$registros = 12;
$numpaginas = ceil($total / $registros);
$inicio = ($registros * $pagina) - $registros;

$res2 = $objUsuarioDAO->usuarios_paginacao($inicio, $registros);
$total2 = $res2->rowCount();
?>



<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome pessoal</th>
            <th scope="col">Nome de usuário</th>
            <th scope="col">Gênero</th>
            <th scope="col">Estado</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php while ($view = $res2->fetch(PDO::FETCH_OBJ)):
            ?>
            <tr>
                <td class="nr">
                    <?php echo $view->id_usuario; ?>
                </td>

                <th scope="row">
                    <?php echo $view->nome; ?>
                </th>
                <td>
                    <?php echo $view->nome_usuario; ?>
                </td>
                <td>

                    <?php echo $view->genero; ?>

                </td>
                <td>
                    <?php
                    if ($view->estado_us == "on"): echo '<span class="badge badge-dot"><i class="bg-success"></i>' . $view->estado_us . ' </span>';
                    else: echo '<span class="badge badge-dot"><i class="bg-danger"></i>' . $view->estado_us . ' </span>';
                    endif;
                    ?>
                </td>

                <td class="text-right">
                    <a href="#" class="bt_permicao" title="Permiçoes"><i class="fa fa-key fa-2x"></i></a>&nbsp;&nbsp;
                    <a href="#" class="bt_editar" title="Editar"><i class="fa fa-edit fa-2x"></i></a>
                </td>
            </tr>
            <?php
        endwhile;
        ?>
    </tbody>
</table>
<script>
    $("document").ready(function (e) {
        //paginacoes
        $("#registro_anterior").hide();
        $("#registro_seguinte").hide();
        $("#txtna").val(<?php echo $pagina; ?>);
        $("#txtna2").val(<?php echo $numpaginas; ?>);
        var a = $("#txtna").val();
        var b = $("#txtna2").val();
        if (a != 1)
        {
            $("#registro_anterior").show();
        }
        if (a != b)
        {
            $("#registro_seguinte").show();
        }
        //fim

        //modal permicao
        $(".bt_permicao").click(function () {
            var item = $(this).closest("tr").find(".nr").text();
            $("#modal_permicao").modal("show");

            $.ajax({
                type: "POST",
                url: "LOAD_CADASTRO/load_permit.php",
                data: {id_usuario: item},
                success: function (dados) {
                    $("#my_group").text('').append(dados);
                }
            });
        });
//fim
//modal editar
        $(".bt_editar").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            $("#modal_editar").modal("show");
            $("#carrega_nomeE").text($item);
        });
        //fim   

    });
</script>






