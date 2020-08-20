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
include_once '../../../../MODELO/Estudante.php';
include_once '../../../../MODELO/Turma.php';
include_once '../../../../MODELO/Finais.php';
include_once '../../../../MODELO/Trimestrais.php';
include_once '../../../../MODELO/Avaliacao.php';
include_once '../../../../MODELO/Prova.php';
include_once '../../../../DAO/EstudanteDAO.php';
include_once '../../../../DAO/FinaisDAO.php';
include_once '../../../../DAO/TrimestraisDAO.php';
include_once '../../../../DAO/AvaliacaoDAO.php';
include_once '../../../../DAO/ProvaDAO.php';

$objGlobals = new Globals();
$objAlertas = new Alertas();
$objEstudante = new Estudante();
$objTurma = new Turma();
$objFinais = new Finais();
$objTrimestrais = new Trimestrais();
$objAvaliacao = new Avaliacao();
$objProva = new Prova();
$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);
$objFinaisDAO = new FinaisDAO($_SESSION['dbname']);
$objTrimestraisDAO = new TrimestraisDAO($_SESSION['dbname']);
$objAvaliacaoDAO = new AvaliacaoDAO($_SESSION['dbname']);
$objProvaDAO = new ProvaDAO($_SESSION['dbname']);

$epocaS = addslashes(htmlspecialchars($_POST['epoca']));

$objTurma->setTurma($_SESSION['turmaS']);
$objEstudante->setAno_lectivo($objGlobals->getAno_lectivo());


$objTrimestrais->setId_disciplina($_SESSION['id_disciplinaS']);
$objTrimestrais->setAno_lectivoT($objGlobals->getAno_lectivo());
$objTrimestrais->setEpoca($epocaS);

$objAvaliacao->setAno_lectivoA($objGlobals->getAno_lectivo());
$objAvaliacao->setId_disciplina($_SESSION['id_disciplinaS']);
$objAvaliacao->setEpoca($epocaS);

$objProva->setAno_lectivoP($objGlobals->getAno_lectivo());
$objProva->setId_disciplina($_SESSION['id_disciplinaS']);
$objProva->setEpoca($epocaS);

$objFinais->setId_disciplina($_SESSION['id_disciplinaS']);
$objFinais->setAno_lectivoF($objGlobals->getAno_lectivo());

$res1 = $objEstudanteDAO->buscarEstudantes_turma($objEstudante, $objTurma);

while ($view1 = $res1->fetch(PDO::FETCH_OBJ)):
    $objEstudante->setId_estudante($view1->id_estudante);
    $res2 = $objAvaliacaoDAO->verificar($objAvaliacao, $objEstudante);
    if ($res2->rowCount() <= 0):
        $resP1 = $objAvaliacaoDAO->salvar($objAvaliacao, $objEstudante);
        if ($resP1 == "yes"):
            echo 'Feito::Avalicao:: ' . $view1->nome . "<br/>";
        endif;
    endif;

    $res3 = $objProvaDAO->verificar($objProva, $objEstudante);
    if ($res3->rowCount() <= 0):
        $resP2 = $objProvaDAO->salvar($objProva, $objEstudante);
        if ($resP2 == "yes"):
            echo 'Feito::PROVA:: ' . $view1->nome . "<br/>";
        endif;
    endif;

    $res4 = $objTrimestraisDAO->verificar($objTrimestrais, $objEstudante);
    if ($res4->rowCount() <= 0):
        $resP3 = $objTrimestraisDAO->salvar($objTrimestrais, $objEstudante);
        if ($resP3 == "yes"):
            echo 'Feito::TRIMESTRE:: ' . $view1->nome . "<br/>";
        endif;
    endif;

    $res5 = $objFinaisDAO->verificar($objFinais, $objEstudante);
    if ($res5->rowCount() <= 0):
        $resP4 = $objFinaisDAO->salvar($objFinais, $objEstudante);
        if ($resP4 == "yes"):
            echo 'Feito::FINAIS:: ' . $view1->nome . "<br/>";
        endif;
    endif;
endwhile;


