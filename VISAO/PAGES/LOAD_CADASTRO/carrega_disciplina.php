<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Turma.php';
include_once '../../../MODELO/Curso.php';
include_once '../../../MODELO/Classes.php';
include_once '../../../DAO/TurmaDAO.php';
include_once '../../../DAO/DISCursoDAO.php';
include_once '../../../DAO/DisciplinasDAO.php';

$objTurma = new Turma();
$objCurso = new Curso();
$objClasse = new Classes();
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);
$objDISCursoDAO = new DISCursoDAO($_SESSION['dbname']);
$objDisciplinasDAO = new DisciplinasDAO($_SESSION['dbname']);

$id_turma = addslashes(htmlspecialchars($_GET['id_turma']));

$objTurma->setId_turma($id_turma);
$res1 = $objTurmaDAO->buscarTurma_ID($objTurma);
$view1 = $res1->fetch(PDO::FETCH_OBJ);

$objClasse->setId_classe($view1->id_classe);
$objCurso->setId_curso($view1->id_curso);

$res2 = $objDISCursoDAO->buscarDisciplina_ID($objCurso, $objClasse);


?>

<div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-file"></i></span>
</div>
<select name="id_disciplina" class="form-control" required="">
    <option value="">Disciplina</option>
    <?php
    while ($view2 = $res2->fetch(PDO::FETCH_OBJ)):
        $res3 = $objDisciplinasDAO->ID_buscarDisciplina($view2->id_disciplina);
        $view3 = $res3->fetch(PDO::FETCH_OBJ);
        ?>
        <option value="<?php echo $view3->id_disciplina; ?>"><?php echo $view3->nome_disciplina; ?></option>

    <?php
    endwhile;
    ?>
</select>






