<?php

ob_start();
session_start();
include_once '../../../CONTROLO/Conexao.php';
include_once '../../../CONTROLO/Alertas.php';
include_once '../../../MODELO/Sala.php';
include_once '../../../DAO/SalaDAO.php';

$objAlertas = new Alertas();
$objSala = new Sala();
$objSalaDAO = new SalaDAO($_SESSION['dbname']);

$id_tiposala = addslashes(htmlspecialchars($_POST['id_tipoSala']));
$quant_estudantes = addslashes(htmlspecialchars($_POST['quant_estudantes']));
$designacao = addslashes(htmlspecialchars($_POST['designacao']));

$objSala->setDesignacao($designacao);
$objSala->setId_tiposala($id_tiposala);
$objSala->setQuant_estudantes($quant_estudantes);


$res = $objSalaDAO->verificar($objSala);
if ($res->rowCount() >= 1):
    echo $objAlertas->sala_cadastrada();
elseif ($res->rowCount() <= 0):
    $res1 = $objSalaDAO->salvar($objSala);
    if ($res1 == "yes"):
        echo "1";
    endif;
endif;
?>


