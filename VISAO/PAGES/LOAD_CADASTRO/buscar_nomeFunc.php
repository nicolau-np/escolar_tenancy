<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Funcionario.php';
include_once '../../../DAO/FuncionarioDAO.php';

$objFuncionario = new Funcionario();
$objFuncionarioDAO = new FuncionarioDAO($_SESSION['dbname']);

$id_funcionario = addslashes(htmlspecialchars($_POST['id_funcionario']));

$objFuncionario->setId_funcionario($id_funcionario);

$res = $objFuncionarioDAO->buscar_funcionarioID($objFuncionario);
$view = $res->fetch(PDO::FETCH_OBJ);
echo $view->nome;

?>

