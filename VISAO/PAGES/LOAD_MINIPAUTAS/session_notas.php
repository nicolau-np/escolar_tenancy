<?php 
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Disciplinas.php';
include_once '../../../MODELO/Turma.php';
include_once '../../../DAO/TurmaDAO.php';
include_once '../../../DAO/DISCursoDAO.php';

$objTurma = new Turma(); 
$objDisciplinas = new Disciplinas();
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);
$objDISCursoDAO = new DISCursoDAO($_SESSION['dbname']);


$id_disciplina = addslashes(htmlspecialchars($_POST['id_disciplina']));
$id_turma = addslashes(htmlspecialchars($_POST['id_turma']));

$objDisciplinas->setId_disciplina($id_disciplina);
$objTurma->setId_turma($id_turma);

$res = $objTurmaDAO->buscarTurma_ID2($objTurma);
$view = $res->fetch(PDO::FETCH_OBJ);
$_SESSION['id_disciplinaM'] = $id_disciplina;
$_SESSION['id_turmaM'] = $id_turma;
$_SESSION['ensinoM'] = $view->ensino;
$_SESSION['cursoM'] = $view->nome_curso;
$_SESSION['classeM'] = $view->classe;
$_SESSION['turmaM'] = $view->turma;

$res1 = $objDISCursoDAO->buscarDISC_ID($objDisciplinas);
$view1 = $res1->fetch(PDO::FETCH_OBJ);
$_SESSION['epocaDisM'] = $view1->tipo;
$_SESSION['nome_disciplinaM'] = $view1->nome_disciplina;
$_SESSION['siglaM'] = $view1->sigla;

$resposta = array(
"ensinoM" => $_SESSION['ensinoM'],
"cursoM" => $_SESSION['cursoM'],
"classeM" => $_SESSION['classeM'],
"turmaM" => $_SESSION['turmaM'],
"epocaDisM" => $_SESSION['epocaDisM'],   
"nome_disciplinaM" => $_SESSION['nome_disciplinaM'],
"siglaM" => $_SESSION['siglaM']  
);

echo json_encode($resposta);

