<?php

ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../CONTROLO/Alertas.php';
include_once '../../../MODELO/Senha.php';
include_once '../../../DAO/SenhaDAO.php';

$objAlertas = new Alertas();
$objSenha = new Senha();
$objSenhaDAO = new SenhaDAO($_SESSION['dbname']);

$passe_actual = addslashes(htmlspecialchars($_POST['passe_actual']));
$nova_passe = addslashes(htmlspecialchars($_POST['nova_passe']));
$nova_passe2 = addslashes(htmlspecialchars($_POST['nova_passe2']));

$objSenha->setId_usuario($_SESSION['id_usuarioLOG']);

$res = $objSenhaDAO->verificar($objSenha);
$view = $res->fetch(PDO::FETCH_OBJ);
if ($view->senha != $passe_actual):
    echo $objAlertas->passe_errada();
else:
    if ($nova_passe != $nova_passe2):
        echo $objAlertas->confirmacao_errada();
    else:
        $objSenha->setSenha($nova_passe);
        $res1 = $objSenhaDAO->update($objSenha);
        if($res1 == "yes"):
            echo '1';
        endif;
    endif;
endif;














