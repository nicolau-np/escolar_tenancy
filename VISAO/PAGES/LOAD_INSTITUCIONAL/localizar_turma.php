<?php
ob_start();
session_start();
include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/EstudanteDAO.php';
include_once '../../../DAO/TurmaDAO.php';
include_once '../../../MODELO/Estudante.php';
include_once '../../../MODELO/Turma.php';

if (isset(addslashes(htmlspecialchars($_POST['id_turma'])))):
    $id_turma = addslashes(htmlspecialchars($_POST['id_turma']));
    $ano_lectivo = addslashes(htmlspecialchars($_POST['ano_lectivo']));

    $_SESSION['id_turmaLOCA'] = $id_turma;
    $_SESSION['ano_lectivoLOCA'] = $ano_lectivo;
else:
    $id_turma = $_SESSION['id_turmaLOCA'];
    $ano_lectivo = $_SESSION['ano_lectivoLOCA'];
endif;


$objTurma = new Turma();
$objEstudante = new Estudante();
$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);

$objTurma->setId_turma($id_turma);
$res1 = $objTurmaDAO->buscarTurma_ID($objTurma);
$view1 = $res1->fetch(PDO::FETCH_OBJ);

$objTurma->setTurma($view1->turma);
$objEstudante->setAno_lectivo($ano_lectivo);
$res2 = $objEstudanteDAO->buscarEstudantes_turma($objEstudante, $objTurma);

?>
<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col">Nome Estudante</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($view2 = $res2->fetch(PDO::FETCH_OBJ)):
            ?>
            <tr>
                <th scope="row">
                <?php echo $view2->nome; ?>
                </th>
                
                <td class="text-right">
                    <a href="#" class="bt_marcar" title="Marcar"><i class="fa fa-edit fa-2x"></i></a>&nbsp;&nbsp;
                </td>
            </tr>
            <?php
        endwhile;
        ?>
    </tbody>
</table>
