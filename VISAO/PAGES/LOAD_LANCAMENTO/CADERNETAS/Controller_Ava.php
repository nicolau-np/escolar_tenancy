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
include_once '../../../../MODELO/Avaliacao.php';
include_once '../../../../MODELO/Trimestrais.php';
include_once '../../../../MODELO/Estudante.php';
include_once '../../../../MODELO/Finais.php';
include_once '../../../../DAO/TrimestraisDAO.php';
include_once '../../../../DAO/AvaliacaoDAO.php';
include_once '../../../../DAO/FinaisDAO.php';

$objCalulos = new Calculos();
$objGlobals = new Globals();
$objAlertas = new Alertas();
$objFinais = new Finais();
$objEstudante = new Estudante();
$objTrimestrais = new Trimestrais();
$objAvaliacao = new Avaliacao();
$objTrimestraisDAO = new TrimestraisDAO($_SESSION['dbname']);
$objFinaisDAO = new FinaisDAO($_SESSION['dbname']);
$objAvaliacaoDAO = new AvaliacaoDAO($_SESSION['dbname']);

$id_avaliacao = addslashes(htmlspecialchars($_POST['id']));
$campo = addslashes(htmlspecialchars($_POST['campo']));
$valor = addslashes(htmlspecialchars($_POST['valor']));

$objAvaliacao->setAno_lectivoA($objGlobals->getAno_lectivo());
$objAvaliacao->setId_avaliacao($id_avaliacao);

$res1 = $objAvaliacaoDAO->update($objAvaliacao, $campo, $valor, $objGlobals->getData());
if ($res1 == "yes"):
    $res2 = $objAvaliacaoDAO->buscarEstudante($objAvaliacao);
    $view2 = $res2->fetch(PDO::FETCH_OBJ);
    $numero_ava = 0;
    $soma_ava = 0;
    //deve se ver essa condicao

    //caso 1
    if ($view2->valor1 != "" && $view2->valor2 != "" && $view2->valor3 != "") {
        $numero_ava = 3;
        $soma_ava = ($view2->valor1 + $view2->valor2 + $view2->valor3);
    }
    //caso 2
    elseif ($view2->valor1 != "" && $view2->valor2 != "" && $view2->valor3 == "") {
        $numero_ava = 2;
        $soma_ava = ($view2->valor1 + $view2->valor2);
    }
    //caso 3
    elseif ($view2->valor1 != "" && $view2->valor2 == "" && $view2->valor3 == "") {
        $numero_ava = 1;
        $soma_ava = ($view2->valor1);
    }
    //caso 4
    elseif ($view2->valor1 == "" && $view2->valor2 == "" && $view2->valor3 != "") {
        $numero_ava = 1;
        $soma_ava = ($view2->valor3);
    }
    //caso 5
    elseif ($view2->valor1 == "" && $view2->valor2 != "" && $view2->valor3 != "") {
        $numero_ava = 2;
        $soma_ava = ($view2->valor2 + $view2->valor3);
    }
    //caso 6
    elseif ($view2->valor1 == "" && $view2->valor2 != "" && $view2->valor3 == "") {
        $numero_ava = 1;
        $soma_ava = ($view2->valor2);
    }

    //fim
    $mac = $objCalulos->calcular_mac($soma_ava, $numero_ava);

    $objEstudante->setId_estudante($view2->id_estudante);
    $objTrimestrais->setAno_lectivoT($view2->ano_lectivo);
    $objTrimestrais->setEpoca($view2->epoca);
    $objTrimestrais->setId_disciplina($view2->id_disciplina);
    $objTrimestrais->setMac($mac);

    $res3 = $objTrimestraisDAO->updateMac($objTrimestrais, $objEstudante);
    if ($res3 == "yes"):
        $res3_1 = $objTrimestraisDAO->verificar($objTrimestrais, $objEstudante);
        $view3_1 = $res3_1->fetch(PDO::FETCH_OBJ);
        $ct = $objCalulos->calcular_ct($view3_1->mac, $view3_1->cpp);

        $objTrimestrais->setCt($ct);
        $res3_2 = $objTrimestraisDAO->updateCt($objTrimestrais, $objEstudante);
        if ($res3_2 == "yes"):

            $soma_ct = $objTrimestraisDAO->somarCT($objTrimestrais, $objEstudante);
            $cap = $objCalulos->calcular_cap($soma_ct);

            $objFinais->setAno_lectivoF($view2->ano_lectivo);
            $objFinais->setId_disciplina($view2->id_disciplina);
            $objFinais->setCap($cap);

            $res4 = $objFinaisDAO->updateCAP($objFinais, $objEstudante);
            if ($res4 == "yes"):
                $res5 = $objFinaisDAO->verificar($objFinais, $objEstudante);
                $view5 = $res5->fetch(PDO::FETCH_OBJ);

                $objCalulos->setCapC($view5->cap);
                $objCalulos->setCpeC($view5->cpe);

                $cf = $objCalulos->calcular_cf();
                $objFinais->setCf($cf);

                $res6 = $objFinaisDAO->updateCF($objFinais, $objEstudante);
            endif;
        endif;

    endif;
endif;

