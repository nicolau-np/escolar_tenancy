<?php

ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../CONTROLO/Globals.php';
include_once '../../../CONTROLO/Alertas.php';
include_once '../../../MODELO/Funcionario.php';
include_once '../../../MODELO/Pessoa.php';
include_once '../../../MODELO/Cargo.php';
include_once '../../../MODELO/Escalao.php';
include_once '../../../MODELO/Usuario.php';
include_once '../../../MODELO/Senha.php';
include_once '../../../MODELO/PERUsuario.php';
include_once '../../../DAO/FuncionarioDAO.php';
include_once '../../../DAO/PessoaDAO.php';
include_once '../../../DAO/PERUsuarioDAO.php';
include_once '../../../DAO/UsuarioDAO.php';
include_once '../../../DAO/SenhaDAO.php';
include_once '../../../DAO/EscalaoDAO.php';
$escalao = "nenhum";
$objAlertas = new Alertas();
$objFuncionario = new Funcionario();
$objSenha = new Senha();
$objGlobals = new Globals();
$objPERUsuario = new PERUsuario();
$objCargo = new Cargo();
$objEscalao = new Escalao();
$objUsuario = new Usuario();
$objPessoa = new Pessoa();

$objUsuarioDAO = new UsuarioDAO($_SESSION['dbname']);
$objPERUsuarioDAO = new PERUsuarioDAO($_SESSION['dbname']);
$objFuncionarioDAO = new FuncionarioDAO($_SESSION['dbname']);
$objPessoaDAO = new PessoaDAO($_SESSION['dbname']);
$objSenhaDAO = new SenhaDAO($_SESSION['dbname']);
$objEscalaoDAO = new EscalaoDAO($_SESSION['dbname']);
$resE = $objEscalaoDAO->buscarEscalao($escalao);
$viewE = $resE->fetch(PDO::FETCH_OBJ);


/* dados pessoais */
$nome = addslashes(htmlspecialchars($_POST['nome']));
$data_nascimento = addslashes(htmlspecialchars($_POST['data_nascimento']));
$genero = addslashes(htmlspecialchars($_POST['genero']));
$estado_civil = addslashes(htmlspecialchars($_POST['estado_civil']));
$id_provincia = addslashes(htmlspecialchars($_POST['id_provincia']));
$id_municipio = addslashes(htmlspecialchars($_POST['id_municipio']));
$telefone = addslashes(htmlspecialchars($_POST['telefone']));
$bilhete = addslashes(htmlspecialchars($_POST['bilhete']));
$data_emissao = addslashes(htmlspecialchars($_POST['data_emissao']));
$local_emissao = addslashes(htmlspecialchars($_POST['local_emissao']));
$pai = addslashes(htmlspecialchars($_POST['pai']));
$mae = addslashes(htmlspecialchars($_POST['mae']));
$comuna = addslashes(htmlspecialchars($_POST['comuna']));
$array_dataNascimento = explode("-", $data_nascimento);
$idade = $objGlobals->getAno_lectivo() - $array_dataNascimento[0];

/* fim */
/* dados profissionais */
$id_cargo = addslashes(htmlspecialchars($_POST['cargo']));
$id_escalao = addslashes(htmlspecialchars($_POST['escalao']));
$agente = addslashes(htmlspecialchars($_POST['agente']));
/* fim */
/* dados usuario */
$retorno_conversao = $objGlobals->converter_acentos($nome);
$retorno_semPonto = $objGlobals->tirando_pontos($retorno_conversao);
$array_usuario = explode(" ", $retorno_semPonto);
$nome_usuario = strtolower($array_usuario[0] . "_" . $array_usuario[1]);
$senha = strtolower($bilhete);
$id_tipopermicao = 2;
$estado = "on";
/* fim */

/* dados pessoais */
$objPessoa->setNome($nome);
$objPessoa->setData_nascimento($data_nascimento);
$objPessoa->setGenero($genero);
$objPessoa->setEstado_civil($estado_civil);
$objPessoa->setId_provincia($id_provincia);
$objPessoa->setId_municipio($id_municipio);
$objPessoa->setTelefone($telefone);
$objPessoa->setBilhete($bilhete);
$objPessoa->setData_emissao($data_emissao);
$objPessoa->setLocal_emissao($local_emissao);
$objPessoa->setPai($pai);
$objPessoa->setMae($mae);
$objPessoa->setIdade($idade);
$objPessoa->setComuna($comuna);
/* fim */

$objFuncionario->setAgente($agente);

$res1 = $objPessoaDAO->verificar($objPessoa);
if ($res1->rowCount() >= 1):
    echo $objAlertas->bilhete_existente();
elseif ($res1->rowCount() <= 0):
    $res2 = $objFuncionarioDAO->verificar($objFuncionario);
    if ($res2->rowCount() >= 1 && $agente != ""):
        echo $objAlertas->agente_existente();
       
    elseif (($res2->rowCount() <= 0) || ($res2->rowCount() >=1 && $agente == "")):
        $res3 = $objPessoaDAO->salvar($objPessoa);
        if ($res3 > 0):
            /* dados dos funcionarios */
            $objFuncionario->setId_pessoa($res3);
            $objFuncionario->setData_cadastro(date("Ymd"));
            $objCargo->setId_cargo($id_cargo);
            if ($id_escalao != ""):
                $objEscalao->setId_escalao($id_escalao);
            else:
                $objEscalao->setId_escalao($viewE->id_escalao);
            endif;

            /* fim */

            $res5 = $objFuncionarioDAO->salvar($objFuncionario, $objCargo, $objEscalao);
            if ($res5 > 0):
                if (($objCargo->getId_cargo()) == 1 or ( $objCargo->getId_cargo() == 2) or ( $objCargo->getId_cargo() == 3)):

                    /* dados usuario */
                    $objUsuario->setNome_usuario($nome_usuario);
                    $objUsuario->setId_funcionario($res5);
                    $objUsuario->setEstado($estado);
                    /* fim */
                    $res7 = $objUsuarioDAO->salvar($objUsuario);
                    if ($res7 > 0):
                        /* dados senha */
                        $objSenha->setSenha($senha);
                        $objSenha->setId_usuario($res7);
                        /* fim */
                        $res9 = $objSenhaDAO->salvar($objSenha);
                        if ($res9 > 0):
                            /* dados permicao */
                            $objUsuario->setId_usuario($res7);
                            $objPERUsuario->setId_tipopermicao($id_tipopermicao);
                            /* fim */
                            $res10 = $objPERUsuarioDAO->salvar($objPERUsuario, $objUsuario);
                            if ($res10 == "yes"):
                                echo "1";
                            endif;
                        endif;
                    endif;
                elseif (($objCargo->getId_cargo() != 1) || ($objCargo->getId_cargo() != 2) || ($objCargo->getId_cargo() != 3)):
                    echo "1";
                endif;


            endif;


        endif;

    endif;

endif;

/* fim */
























