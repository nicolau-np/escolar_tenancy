<?php
ob_start();
session_start();
if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Bloqueio.php';
include_once '../../../DAO/BloqueioDAO.php';
include_once '../../../CONTROLO/Globals.php';

$objBloqueio = new Bloqueio();
$objBloqueioDAO = new BloqueioDAO($_SESSION['dbname']);
$objGlobals = new Globals();
$estado = null;
$retorno = null;

if(!isset($_POST['tipos_bloqueios'])):
    echo "<div class='alert alert-danger'>Deve selecionar a(s) epoca(s)</div>";
else:
    foreach ($_POST['tipos_bloqueios'] as $epocas){
    $objBloqueio->setEpoca($epocas);
    $res = $objBloqueioDAO->verificar($objBloqueio);
    $view = $res->fetch(PDO::FETCH_OBJ);
    if($view->estado == "on"):
        $estado = "off";
    else:
        $estado = "on";
    endif;
    $objBloqueio->setData_modificacao($objGlobals->getData());
    $objBloqueio->setEstado($estado);
    $res1 = $objBloqueioDAO->update($objBloqueio);
    if($res1 == "yes"):
        $retorno = "1";
    endif;
    }
    echo $retorno;
endif;





