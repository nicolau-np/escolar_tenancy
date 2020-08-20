<?php
ob_start();
session_start();
if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;
include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Director.php';
include_once '../../../MODELO/PERUsuario.php';
include_once '../../../MODELO/Usuario.php';
include_once '../../../DAO/UsuarioDAO.php';
include_once '../../../DAO/TipoPERDAO.php';
include_once '../../../DAO/PERUsuarioDAO.php';
include_once '../../../DAO/DirectorDAO.php';

$id_funcionarioDir = addslashes(htmlspecialchars($_POST['id_funcionarioDir']));
$id_turma = addslashes(htmlspecialchars($_POST['id_turma']));
$ano_lectivo = addslashes(htmlspecialchars($_POST['ano_lectivo']));

$objDirector = new Director();
$objUsuario = new Usuario();
$objFuncionario = new Funcionario;
$objPERUsuario = new PERUsuario();
$objDirectorDAO = new DirectorDAO($_SESSION['dbname']);
$objUsuarioDAO = new UsuarioDAO($_SESSION['dbname']);
$objPERUsuarioDAO = new PERUsuarioDAO($_SESSION['dbname']);
$objTipoPERDAO = new TipoPERDAO($_SESSION['dbname']);


$objDirector->setAno_lectivo($ano_lectivo);
$objDirector->setId_turma($id_turma);
$objFuncionario->setId_funcionario($id_funcionarioDir);
$objPERUsuario->setTipo("restrit 2");

/*buscar id permicao apartir do tipo*/
$res7 = $objTipoPERDAO->buscar_idTipo($objPERUsuario);
$view7 = $res7->fetch(PDO::FETCH_OBJ);
/***/
$res1 = $objDirectorDAO->verificar($objDirector, $objFuncionario);
if($res1->rowCount() >= 1):
    echo '4';
elseif($res1->rowCount() <= 0):
 $res2 = $objDirectorDAO->verificar_prof($objDirector, $objFuncionario);
    if($res2->rowCount() >= 1):
        echo '2';
    elseif($res2->rowCount() <= 0):
        $res3 = $objDirectorDAO->verificar_turma($objDirector);
        if($res3->rowCount() >= 1):
            echo '3';
        elseif($res3->rowCount() <= 0):
            $res4 = $objDirectorDAO->salvar($objDirector, $objFuncionario);
            if($res4 == "yes"):
                // codigo fica aqui
                $objUsuario->setId_funcionario($id_funcionarioDir);
                $res5 = $objUsuarioDAO->buscarID_usuario($objUsuario);
                $view5 = $res5->fetch(PDO::FETCH_OBJ);
                $objPERUsuario->setId_tipopermicao($view7->id_tipopermicao);
                $objUsuario->setId_usuario($view5->id_usuario);
                $res6 = $objPERUsuarioDAO->salvar($objPERUsuario, $objUsuario);
                if($res6 == "yes"):
                   echo '1'; 
                endif;
                
            else:
                echo '0';
            endif;
        endif;
    endif;
endif;










































