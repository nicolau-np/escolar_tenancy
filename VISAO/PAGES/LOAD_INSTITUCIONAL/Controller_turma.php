<?php

ob_start();
session_start();
include_once '../../../CONTROLO/Conexao.php';
include_once '../../../CONTROLO/Alertas.php';
include_once '../../../MODELO/Turno.php';
include_once '../../../DAO/TurmaDAO.php';

$objTurno = new Turno();
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);
$objAlertas = new Alertas();

$curso = addslashes(htmlspecialchars($_POST['curso']));
$classe = addslashes(htmlspecialchars($_POST['classe']));
$turno = addslashes(htmlspecialchars($_POST['turno']));
$nome_turma = addslashes(htmlspecialchars($_POST['nome_turma']));

$objTurno->setId_curso($curso);
$objTurno->setId_classe($classe);
$objTurno->setId_turno($turno);
$objTurno->setTurma($nome_turma);

$res = $objTurmaDAO->verificarTurma($objTurno);
if ($res->rowCount() >= 1):
    echo $objAlertas->turma_cadastrada();
elseif ($res->rowCount() <= 0):
    $res1 = $objTurmaDAO->verNome($objTurno);
    if ($res1->rowCount() >= 1):
        echo $objAlertas->nome_turmaIgual();
    elseif ($res1->rowCount() <= 0):
        $res2 = $objTurmaDAO->salvar($objTurno);
        if ($res2 == "yes"):
            echo "1";
        endif;
    endif;
endif;
?>
