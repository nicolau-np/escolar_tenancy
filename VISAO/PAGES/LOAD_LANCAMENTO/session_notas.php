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
$_SESSION['id_disciplinaS'] = $id_disciplina;
$_SESSION['id_turmaS'] = $id_turma;
$_SESSION['ensinoS'] = $view->ensino;
$_SESSION['cursoS'] = $view->nome_curso;
$_SESSION['classeS'] = $view->classe;
$_SESSION['turmaS'] = $view->turma;

$res1 = $objDISCursoDAO->buscarDISC_ID($objDisciplinas);
$view1 = $res1->fetch(PDO::FETCH_OBJ);
$_SESSION['epocaDisS'] = $view1->tipo;
$_SESSION['nome_disciplinaS'] = $view1->nome_disciplina;
$_SESSION['siglaS'] = $view1->sigla;

$resposta = array(
"ensinoS" => $_SESSION['ensinoS'],
"cursoS" => $_SESSION['cursoS'],
"classeS" => $_SESSION['classeS'],
"turmaS" => $_SESSION['turmaS'],
"epocaDisS" => $_SESSION['epocaDisS'],   
"nome_disciplinaS" => $_SESSION['nome_disciplinaS'],
"siglaS" => $_SESSION['siglaS']  
);

echo json_encode($resposta);

