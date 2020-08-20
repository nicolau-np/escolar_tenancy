<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/EstudanteDAO.php';
$nome_estudante = addslashes(htmlspecialchars($_GET['nome_estudante']));

$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);
$res1 = $objEstudanteDAO->search($nome_estudante);
?>
<script type="text/javascript">
    $(document).ready(function () {
//bt detalhes
        $(".bt_detalhes").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            $("#modal_detalhes").modal("show");
            $("#carrega_nomeD").text($item);
        });
//fim

        $(".bt_editar").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            $("#modal_editar").modal("show");
            $("#carrega_nomeE").text($item);
        });
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
        while ($view = $res1->fetch(PDO::FETCH_OBJ)):
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




