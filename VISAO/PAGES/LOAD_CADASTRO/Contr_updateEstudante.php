<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Estudante.php';
include_once '../../../MODELO/ESHistoricos.php';
include_once '../../../MODELO/Turma.php';
include_once '../../../DAO/EstudanteDAO.php';
include_once '../../../DAO/ESHistoricosDAO.php';

$id_turma = addslashes(htmlspecialchars($_POST['id_turma']));

$objEstudante = new Estudante();
$objESHistorico = new ESHistoricos();
$objTurma = new Turma();
$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);
$objESHistoricoDAO = new ESHistoricosDAO($_SESSION['dbname']);

$objTurma->setId_turma($id_turma);
$objEstudante->setAno_lectivo($_SESSION['ano_lectivoSS']);
$objESHistorico->setAno_lectivo2($_SESSION['ano_lectivoSS']);

$resposta = null;

if (!isset($_POST['id_estudante'])):
    $resposta = "<div class='alert alert-danger'>Deve selecionar estudantes</div>";
else:
    foreach ($_POST['id_estudante'] as $id_estudante) {
        $objEstudante->setId_estudante($id_estudante);
        $res = $objEstudanteDAO->updateTurma($objEstudante, $objTurma);
    }
    if ($res == "yes"):
        foreach ($_POST['id_estudante'] as $id_estudante) {
            $objESHistorico->setId_estudante($id_estudante);
            $res1 = $objESHistoricoDAO->updateTurma($objESHistorico, $objTurma);
        }
        if ($res1 == "yes"):
            $resposta = 1;
        endif;
    endif;



endif;

echo $resposta;

