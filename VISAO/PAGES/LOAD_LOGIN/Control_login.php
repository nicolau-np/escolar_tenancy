<?php

ob_start();
session_start();

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../CONTROLO/Alertas.php';
include_once '../../../MODELO/Senha.php';
include_once '../../../MODELO/Escola.php';
include_once '../../../DAO/UsuarioDAO.php';
include_once '../../../DAO/LicencaDAO.php';
include_once '../../../DAO/EscolaDAO.php';

$dbname1 = "tenancyschool";

$objAlertas = new Alertas();
$objSenha = new Senha();
$objEscola = new Escola();
$objLicenca = new Licenca();
$objEscolaDAO = new EscolaDAO($dbname1);

$usuario = addslashes(htmlspecialchars($_POST['usuario']));
$senha = addslashes(htmlspecialchars($_POST['senha']));
$codigo_escolar = addslashes(htmlspecialchars($_POST['codigo']));

$objEscola->setId_school($codigo_escolar);

$res = $objEscolaDAO->consultaEscola($objEscola);
$view = $res->fetch(PDO::FETCH_OBJ);
if ($res->rowCount() <= 0):
    echo $objAlertas->erro_codigoEscola();
elseif ($res->rowCount() >= 1):
    $objLicenca->setId_licence($view->id_licence);
    $objLicencaDAO = new LicencaDAO($dbname1);
    $res1 = $objLicencaDAO->statusLicenca($objLicenca);
    $view1 = $res1->fetch(PDO::FETCH_OBJ);
    if ($view1->statu == "off"):
        echo $objAlertas->licenca_caducada();
    elseif ($view1->statu == "on"):
        $dbname2 = "tenancyschool_" . $codigo_escolar;
        $objSenha->setNome_usuario($usuario);
        $objSenha->setSenha($senha);

        $objUsuarioDAO = new UsuarioDAO($dbname2);
        $res2 = $objUsuarioDAO->localisarUsuario($objSenha);
        $view2 = $res2->fetch(PDO::FETCH_OBJ);
        if ($res2->rowCount() <= 0):
            echo $objAlertas->erro_usuario();
        elseif ($res2->rowCount() >= 1):
            if ($view2->estado_us == "off"):
                echo $objAlertas->usuario_bloqueado();
            elseif ($view2->estado_us == "on"):
                $_SESSION['nome_escolaLOG'] = $view->nome;
                $_SESSION['dbname'] = $dbname2;
                $_SESSION['id_usuarioLOG'] = $view2->id_usuario;
                $_SESSION['id_funcionarioLOG'] = $view2->id_funcionario;
                $_SESSION['nome_usuarioLOG'] = $view2->nome_usuario;
                $_SESSION['nome_pessoaLOG'] = $view2->nome;
                $_SESSION['cargoLOG'] = $view2->cargo;
                $_SESSION['agenteLOG'] = $view2->agente;
                $_SESSION['idadeLOG'] = $view2->idade;
                $_SESSION['provinciaLOG'] = $view2->provincia;
                $_SESSION['municipioLOG'] = $view2->municipio;
                $_SESSION['telefoneLOG'] = $view2->telefone;
                
              echo "1";
            endif;
        endif;
    endif;
                                            endif;
