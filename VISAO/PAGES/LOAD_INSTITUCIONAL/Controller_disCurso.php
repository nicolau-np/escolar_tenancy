<?php
ob_start();
session_start();
include_once '../../../CONTROLO/Conexao.php';
include_once '../../../CONTROLO/Alertas.php';
include_once '../../../MODELO/Curso.php';
include_once '../../../MODELO/Classes.php';
include_once '../../../MODELO/DISCurso.php';
include_once '../../../MODELO/Disciplinas.php';
include_once '../../../DAO/DISCursoDAO.php';

$objAlertas = new Alertas();
$objCurso = new Curso();
$objClasses = new Classes();
$objDISCurso = new DISCurso();
$objDisciplinas = new Disciplinas();
$objDISCursoDAO = new DISCursoDAO($_SESSION['dbname']);


$id_curso = addslashes(htmlspecialchars($_POST['curso']));
$id_classe = addslashes(htmlspecialchars($_POST['classe']));
$id_epocaDis = addslashes(htmlspecialchars($_POST['epocaDis']));

$objClasses->setId_classe($id_classe);
$objCurso->setId_curso($id_curso);
$objDISCurso->setId_epocaDis($id_epocaDis);

if((!isset($_SESSION["favoritos"])) or ($_SESSION["favoritos"] == null)):
    echo $objAlertas->deve_selecionaDisciplinas();
elseif((isset($_SESSION["favoritos"])) && ($_SESSION["favoritos"] != null)):
    
foreach ($_SESSION["favoritos"] as $key => $value) {
    $id_disciplina = $_SESSION["favoritos"][$key];
    $objDisciplinas->setId_disciplina($id_disciplina);
    
    $res = $objDISCursoDAO->verificar($objCurso, $objDISCurso, $objClasses, $objDisciplinas);
    if($res->rowCount()<=0):
        $res1 = $objDISCursoDAO->salvar($objCurso, $objDISCurso, $objClasses, $objDisciplinas);
    elseif($res->rowCount()>=1):
        $res1 = "no";
    endif;
 
}
if($res1 == "yes"):
    unset($_SESSION["favoritos"]);
    echo "1";
elseif($res1 == "no"):
    echo $objAlertas->disciplina_cadastrada_curso();
endif; 

endif;

?>
