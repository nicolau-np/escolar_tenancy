<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../../CONTROLO/Conexao.php';
include_once '../../../../DAO/EstudanteDAO.php';

$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);

$pagina = addslashes(htmlspecialchars(isset($_GET['pagina']))) ? addslashes(htmlspecialchars($_GET['pagina'])) : 1;

$res = $objEstudanteDAO->buscar_estudante();
$total = $res->rowCount();
$registros = 12;
$numpaginas = ceil($total / $registros);
$inicio = ($registros * $pagina) - $registros;

$res2 = $objEstudanteDAO->estudante_paginacao($inicio, $registros);
$total2 = $res2->rowCount();
?>
<script>
   $(document).ready(function(){
      //bt_editar
        $(".bt_editar").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            $("#modal_editar").modal("show");
            $("#carrega_nomeE").text($item);
        });
//fim

//bt detalhes
        $(".bt_detalhes").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            $("#modal_detalhes").modal("show");
            $("#carrega_nomeD").text($item);
        });
//fim
   });
    </script>

<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col">Processo</th>
            <th scope="col">Nome estudante</th>
            <th scope="col">Curso</th>
            <th scope="col">Classe</th>
            <th scope="col">Turma</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($view = $res2->fetch(PDO::FETCH_OBJ)):
            ?>
            <tr>
                <td class="nr"><?php echo $view->id_estudante; ?></td>
                <th scope="row">
                    <?php echo $view->nome; ?>
                </th>
                <td>
                    <?php echo $view->nome_curso; ?>
                </td>
                <td>
                    <?php echo $view->classe; ?>
                </td>
                <td>
                    <?php echo $view->turma; ?>
                </td>

                <td class="text-right">
                    <a href="#" class="bt_editar" title="Editar"><i class="fa fa-edit fa-2x"></i></a>&nbsp;&nbsp;
                    <a href="#" class="bt_detalhes" title="Detalhes"><i class="fa fa-newspaper fa-2x"></i></a>&nbsp;
                    <a href="#" class="bt_eliminar" title="Eliminar"><i class="fa fa-trash fa-2x"></i></a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script>
    $("document").ready(function (e) {
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
    });
</script>













