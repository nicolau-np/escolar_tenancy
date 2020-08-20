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
include_once '../../../MODELO/Estudante.php';
include_once '../../../MODELO/Pessoa.php';
include_once '../../../MODELO/Turno.php';
include_once '../../../MODELO/ESHistoricos.php';

include_once '../../../DAO/EstudanteDAO.php';
include_once '../../../DAO/PessoaDAO.php';
include_once '../../../DAO/ESHistoricosDAO.php';
include_once '../../../DAO/TurmaDAO.php';
$turmaE = "nenhum";
$objPessoa = new Pessoa();
$objEstudante = new Estudante();
$objTurno = new Turno();
$objGlobals = new Globals();
$objESHistorico = new ESHistoricos();
$objAlertas = new Alertas();

$objPessoaDAO = new PessoaDAO($_SESSION['dbname']);
$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);
$objESHistoricoDAO = new ESHistoricosDAO($_SESSION['dbname']);
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);
$resE = $objTurmaDAO->pesq($turmaE);
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

/* dados academicos */
$id_curso = addslashes(htmlspecialchars($_POST['id_curso']));
$id_classe = addslashes(htmlspecialchars($_POST['id_classe']));
$ano_lectivo = addslashes(htmlspecialchars($_POST['ano_lectivo']));
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

$res = $objPessoaDAO->verificar($objPessoa);
if ($res->rowCount() >= 1):
    $viewB = $res->fetch(PDO::FETCH_OBJ);
    if($viewB->bilhete == ""){
        $res1 = $objPessoaDAO->salvar($objPessoa);
        if ($res1 > 0):
            /* dados academicos */
            $objEstudante->setAno_lectivo($ano_lectivo);
            $objEstudante->setData_cadastro(date("Ymd"));
            $objEstudante->setId_pessoa($res1);
            $objTurno->setId_classe($id_classe);
            $objTurno->setId_curso($id_curso);
            $objTurno->setId_turma($viewE->id_turma);
            /* fim */

            $res3 = $objEstudanteDAO->salvar($objEstudante, $objTurno);
            if ($res3 > 0):
                /* dados historico */
                $objESHistorico->setAno_lectivo2($ano_lectivo);
                $objESHistorico->setId_estudante($res3);

                /* fim */
                $res5 = $objESHistoricoDAO->salvar($objESHistorico, $objTurno);
                if ($res5 == "yes"):
                    echo "1";
                endif;

            endif;
        endif;

    }else{
        echo $objAlertas->bilhete_existente();
    }
elseif ($res->rowCount() <= 0):
    $res1 = $objPessoaDAO->salvar($objPessoa);
    if ($res1 > 0):

        /* dados academicos */
        $objEstudante->setAno_lectivo($ano_lectivo);
        $objEstudante->setData_cadastro(date("Ymd"));
        $objEstudante->setId_pessoa($res1);
        $objTurno->setId_classe($id_classe);
        $objTurno->setId_curso($id_curso);
        $objTurno->setId_turma($viewE->id_turma);
        /* fim */

        $res3 = $objEstudanteDAO->salvar($objEstudante, $objTurno);
        if ($res3 > 0):
            /* dados historico */
            $objESHistorico->setAno_lectivo2($ano_lectivo);
            $objESHistorico->setId_estudante($res3);

            /* fim */
            $res5 = $objESHistoricoDAO->salvar($objESHistorico, $objTurno);
            if ($res5 == "yes"):
                echo "1";
            endif;

        endif;
    endif;

endif;















