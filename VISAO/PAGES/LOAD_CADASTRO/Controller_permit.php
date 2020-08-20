<?php

ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Usuario.php';
include_once '../../../MODELO/PERUsuario.php';
include_once '../../../DAO/PERUsuarioDAO.php';

$resposta = null;
$objUsuario = new Usuario();
$objPERUsuario = new PERUsuario();
$objPERUsuarioDAO = new PERUsuarioDAO($_SESSION['dbname']);

$objUsuario->setId_usuario($_SESSION['id_usuarioPERMIT']);

if (addslashes(htmlspecialchars(isset($_POST['permicao'])))):
    
    foreach ($_POST['permicao'] as $id_tipopermicao) {
        $objPERUsuario->setId_tipopermicao($id_tipopermicao);

        $res = $objPERUsuarioDAO->verificar($objPERUsuario, $objUsuario);
        if ($res->rowCount() >= 1):
            $res1 = $objPERUsuarioDAO->remover($objPERUsuario, $objUsuario);
            if($res1 == "yes"):
                $resposta = "yes";
            endif;
        elseif ($res->rowCount() <= 0):
            $res4 = $objPERUsuarioDAO->salvar($objPERUsuario, $objUsuario);
            if($res4 == "yes"):
                $resposta = "yes";
            endif;
        endif;
    }
    if ($resposta == "yes"):
        echo '1';
    endif;
else:
    echo '2';
endif;




































