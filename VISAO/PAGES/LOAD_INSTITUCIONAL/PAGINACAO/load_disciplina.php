<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../../CONTROLO/Conexao.php';
include_once '../../../../DAO/DisciplinasDAO.php';

$objDisciplinasDAO = new DisciplinasDAO($_SESSION['dbname']);

$pagina = addslashes(htmlspecialchars(isset($_GET['pagina']))) ? addslashes(htmlspecialchars($_GET['pagina'])) : 1;

$res = $objDisciplinasDAO->buscarDisciplinas();
$total = $res->rowCount();
$registros = 12;
$numpaginas = ceil($total / $registros);
$inicio = ($registros * $pagina) - $registros;

$res2 = $objDisciplinasDAO->Disciplinas_paginacao($inicio, $registros);
$total2 = $res2->rowCount();
?>

<table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nome disciplina</th>
                        <th scope="col">Sígla</th>
                        <th scope="col">Componente</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($view2 = $res2->fetch(PDO::FETCH_OBJ)):
                        ?>
                        <tr>
                            <th scope="row">
                    <div class="media align-items-center">
                        <div class="media-body">
                            <span class="mb-0 text-sm"><?php echo $view2->nome_disciplina; ?></span>
                        </div>
                    </div>
                    </th>
                    <td>
                        <?php echo $view2->sigla; ?>
                    </td>
                    <td>
                        <?php echo $view2->componente; ?>
                    </td>
                    <td class="text-right">
                        <a href="#" class="bt_editar" title="Editar"><i class="fa fa-edit fa-2x"></i></a>&nbsp;&nbsp;
                        <a href="#" class="bt_horario" title="Horário de trabalho"><i class="fa fa-clock fa-2x"></i></a>

                    </td>
                    </tr>
                    <?php
                endwhile;
                ?>
                </tbody>
            </table>



<script>
    $("document").ready(function (e) {
        //paginacao
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
        
    });
</script>


















