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

$id_escalao = 1;
$id_cargo = 2;
$data_nascimento = "1000-01-01";
$data_cadastro = date("Y-m-d");
$senha = "@welwitchia2020";
$estado = "on";
$estado_civil = "solteiro(a)";
$id_tipopermicao = 2;
$id_provincia = 7;
$id_municipio = 1;

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


$resposta_final = 0;

if ($_FILES['arquivo']['type'] == "text/xml") {

    if (!empty($_FILES['arquivo']['tmp_name'])) {
        $arquivo = new DomDocument();
        $arquivo->load($_FILES['arquivo']['tmp_name']);

        $linhas = $arquivo->getElementsByTagName("Row");
        $primeira_linha = true;

        foreach ($linhas as $linha) {
            if ($primeira_linha == false) {

                $nome = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
                $genero = $linha->getElementsByTagName("Data")->item(1)->nodeValue;

                $retorno_conversao = $objGlobals->converter_acentos($nome);
                $retorno_semPonto = $objGlobals->tirando_pontos($retorno_conversao);
                $array_usuario = explode(" ", $retorno_semPonto);
                $nome_usuario = strtolower($array_usuario[0] . "_" . $array_usuario[1]);


                //echo $nome." == ".$genero." == ".$nome_usuario." == ".$senha." == ".$estado_civil." == ".$id_cargo." == ".$data_nascimento." == ".$data_cadastro." == ".$id_escalao." == ".$id_tipopermicao."<br/>";

                /* dados pessoais */
                $objPessoa->setNome($nome);
                $objPessoa->setData_nascimento($data_nascimento);
                $objPessoa->setGenero($genero);
                $objPessoa->setEstado_civil($estado_civil);
                $objPessoa->setId_provincia($id_provincia);
                $objPessoa->setId_municipio($id_municipio);
                /* fim */


                $res = $objPessoaDAO->verificar2($objPessoa);

                if ($res->rowCount() >= 1):

                elseif ($res->rowCount() <= 0):
                    $res2 = $objPessoaDAO->salvar($objPessoa);
                    if ($res2 > 0):
                        /* dados dos funcionarios */
                        $objFuncionario->setId_pessoa($res2);
                        $objFuncionario->setData_cadastro($data_cadastro);
                        $objCargo->setId_cargo($id_cargo);
                        $objEscalao->setId_escalao($id_escalao);
                        /* fim */

                        $res5 = $objFuncionarioDAO->salvar($objFuncionario, $objCargo, $objEscalao);
                        if ($res5 > 0):
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
                                        $resposta_final = 1;
                                    endif;
                                endif;
                            endif;
                        endif;
                    endif;
                endif;
            }
            $primeira_linha = false;
        }
        echo $resposta_final;
    }
} else {
    echo '<div class="alert alert-danger">Tipo do ficheiro nao reconhecido</div>';
}

