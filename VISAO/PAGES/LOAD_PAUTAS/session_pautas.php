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

$id_turma = $_SESSION['id_turmaP'];
$ano_lectivo = $_SESSION['ano_lectivoP'];

$objTurma->setId_turma($id_turma);

$res = $objTurmaDAO->buscarTurma_ID2($objTurma);
$view = $res->fetch(PDO::FETCH_OBJ);
$_SESSION['id_turmaP'] = $id_turma;
$_SESSION['ensinoP'] = $view->ensino;
$_SESSION['cursoP'] = $view->nome_curso;
$_SESSION['classeP'] = $view->classe;
$_SESSION['turmaP'] = $view->turma;
$_SESSION['ano_lectivoP'] = $ano_lectivo;

$resposta1 = array(
"ensinoP" => $_SESSION['ensinoP'],
 "cursoP" => $_SESSION['cursoP'],
 "classeP" => $_SESSION['classeP'],
 "turmaP" => $_SESSION['turmaP'],
 "ID_turma" =>$id_turma
);

echo json_encode($resposta1);











