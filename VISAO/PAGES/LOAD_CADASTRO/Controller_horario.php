<?php

ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
        . 'window.location.href="login.php";'
        . '</script>';
endif;

include_once '../../../CONTROLO/Alertas.php';
include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Turma.php';
include_once '../../../MODELO/Horario.php';
include_once '../../../MODELO/Sala.php';
include_once '../../../MODELO/Funcionario.php';

include_once '../../../DAO/HorarioDAO.php';

$objAlertas = new Alertas();
$objHorario = new Horario();
$objSala = new Sala();
$objFuncionario = new Funcionario();
$objTurma = new Turma();

$objHorarioDAO = new HorarioDAO($_SESSION['dbname']);

$id_funcionario = addslashes(htmlspecialchars($_POST["ID_funcionario"]));
$id_turma = addslashes(htmlspecialchars($_POST["id_turma"]));
$id_disciplina = addslashes(htmlspecialchars($_POST["id_disciplina"]));
$ano_lectivo = addslashes(htmlspecialchars($_POST["ano_lectivo"]));
$id_sala = addslashes(htmlspecialchars($_POST["id_sala"]));

$objHorario->setId_disciplina($id_disciplina);
$objTurma->setId_turma($id_turma);
$objSala->setId_sala($id_sala);
$objFuncionario->setId_funcionario($id_funcionario);
$objHorario->setAno_lectivo($ano_lectivo);

$res = $objHorarioDAO->verificar($objHorario, $objSala, $objTurma, $objFuncionario);
if ($res->rowCount() >= 1):
    echo $objAlertas->horario_cadastrado();
elseif ($res->rowCount() <= 0):
    $res3 = $objHorarioDAO->Prof_VS_disciplinas($objHorario, $objTurma, $objFuncionario);
    if ($res3 == "no"):
        echo $objAlertas->disciplina_oucupada_prof();
    elseif ($res3 == "yes"):
        $res4 = $objHorarioDAO->salvar($objHorario, $objSala, $objTurma, $objFuncionario);
        if ($res4 == "yes"):
            echo '1';
        endif;
    endif;


endif;
?>

