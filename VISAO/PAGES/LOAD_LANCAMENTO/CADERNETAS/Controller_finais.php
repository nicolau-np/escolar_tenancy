<?php

ob_start();
session_start();
if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../../CONTROLO/Conexao.php';
include_once '../../../../CONTROLO/Globals.php';
include_once '../../../../CONTROLO/Alertas.php';
include_once '../../../../CONTROLO/Calculos.php';
include_once '../../../../MODELO/Estudante.php';
include_once '../../../../MODELO/Finais.php';
include_once '../../../../DAO/FinaisDAO.php';


$objCalulos = new Calculos();
$objGlobals = new Globals();
$objAlertas = new Alertas();
$objFinais = new Finais();
$objEstudante = new Estudante();
$objFinaisDAO = new FinaisDAO($_SESSION['dbname']);

$id_notasfinais = addslashes(htmlspecialchars($_POST['id']));
$campo = addslashes(htmlspecialchars($_POST['campo']));
$valor = addslashes(htmlspecialchars($_POST['valor']));

$objFinais->setId_notasfinais($id_notasfinais);
$objFinais->setData_lancamento($objGlobals->getData());
$res1 = $objFinaisDAO->update($objFinais, $campo, $valor);
if ($res1 == "yes"):
    $res2 = $objFinaisDAO->buscarEstudante($objFinais);
    $view2 = $res2->fetch(PDO::FETCH_OBJ);
    
    $objEstudante->setId_estudante($view2->id_estudante);
    $objFinais->setId_disciplina($view2->id_disciplina);
    $objFinais->setAno_lectivoF($view2->ano_lectivo);
    $objFinais->setData_lancamento($objGlobals->getData());
    
    $res3 = $objFinaisDAO->verificar($objFinais, $objEstudante);
    $view3 = $res3->fetch(PDO::FETCH_OBJ);
    
    $objCalulos->setCapC($view3->cap);
    $objCalulos->setCpeC($view3->cpe);
    
    $cf = $objCalulos->calcular_cf();
    $objFinais->setCf($cf);
    $res4 = $objFinaisDAO->updateCF($objFinais, $objEstudante);
endif;















