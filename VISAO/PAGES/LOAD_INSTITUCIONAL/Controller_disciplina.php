<?php

ob_start();
session_start();
include_once '../../../CONTROLO/Conexao.php';
include_once '../../../CONTROLO/Alertas.php';
include_once '../../../MODELO/Disciplinas.php';
include_once '../../../DAO/DisciplinasDAO.php';


$objDisciplinas = new Disciplinas();
$objDisciplinasDAO = new DisciplinasDAO($_SESSION['dbname']);
$objAlertas = new Alertas();

$id_componente = addslashes(htmlspecialchars($_POST['componente']));
$nome_disciplina = addslashes(htmlspecialchars($_POST['nome_disciplina']));
$sigla = addslashes(htmlspecialchars($_POST['sigla']));

$objDisciplinas->setId_componente($id_componente);
$objDisciplinas->setNome_disciplina($nome_disciplina);
$objDisciplinas->setSigla($sigla);

$res = $objDisciplinasDAO->verificar($objDisciplinas);
if ($res->rowCount() >= 1):
    echo $objAlertas->disciplina_cadastrada();
elseif ($res->rowCount() <= 0):
    $res1 = $objDisciplinasDAO->salvar($objDisciplinas);
    if ($res1 == "yes"):
        echo "1";
    endif;
endif;
?>

