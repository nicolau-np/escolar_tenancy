<?php
ob_start();
session_start();
include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/UsuarioDAO.php';

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

$nome_usuario = addslashes(htmlspecialchars($_GET['nome_usuario']));

$objUsuarioDAO = new UsuarioDAO($_SESSION['dbname']);
$res1 = $objUsuarioDAO->search($nome_usuario);
?>
<script type="text/javascript">
    $(document).ready(function () {
        //modal permicao
     $(".bt_permicao").click(function () {
            var item = $(this).closest("tr").find(".nr").text();
            $("#modal_permicao").modal("show");
           
         $.ajax({
                type: "POST",
                url: "LOAD_CADASTRO/load_permit.php",
                data: {id_usuario:item},
                success: function(dados){
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
        <?php while ($view = $res1->fetch(PDO::FETCH_OBJ)):
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







