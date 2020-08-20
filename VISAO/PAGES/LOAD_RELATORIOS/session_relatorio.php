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
include_once '../../../DAO/TurmaDAO.php';

$objTurma = new Turma(); 
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);

$id_turma = addslashes(htmlspecialchars($_POST['id_turma']));
$ano_lectivo = addslashes(htmlspecialchars($_POST['ano_lectivo']));
$epoca = addslashes(htmlspecialchars($_POST['epoca']));

$objTurma->setId_turma($id_turma);

$res = $objTurmaDAO->buscarTurma_ID2($objTurma);
$view = $res->fetch(PDO::FETCH_OBJ);
$_SESSION['id_turmaR'] = $id_turma;
$_SESSION['ensinoR'] = $view->ensino;
$_SESSION['cursoR'] = $view->nome_curso;
$_SESSION['classeR'] = $view->classe;
$_SESSION['turmaR'] = $view->turma;
$_SESSION['ano_lectivoR'] = $ano_lectivo;
$_SESSION['epocaR'] = $epoca;

$resposta = array(
"ensinoR" => $_SESSION['ensinoR'],
"cursoR" => $_SESSION['cursoR'],
"classeR" => $_SESSION['classeR'],
"turmaR" => $_SESSION['turmaR']
);

echo json_encode($resposta);

