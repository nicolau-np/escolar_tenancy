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
include_once '../../../MODELO/Estudante.php';
include_once '../../../MODELO/Pessoa.php';
include_once '../../../MODELO/Turno.php';
include_once '../../../MODELO/Turma.php';
include_once '../../../MODELO/ESHistoricos.php';
include_once '../../../MODELO/Curso.php';
include_once '../../../MODELO/Classes.php';

include_once '../../../DAO/EstudanteDAO.php';
include_once '../../../DAO/PessoaDAO.php';
include_once '../../../DAO/ESHistoricosDAO.php';
include_once '../../../DAO/TurnoDAO.php';
include_once '../../../DAO/TurmaDAO.php';
include_once '../../../DAO/CursoDAO.php';
include_once '../../../DAO/ClassesDAO.php';

$objPessoa = new Pessoa();
$objEstudante = new Estudante();
$objTurno = new Turno();
$objTurma = new Turma();
$objGlobals = new Globals();
$objESHistorico = new ESHistoricos();
$objCurso = new Curso();
$objClasses = new Classes();

$objPessoaDAO = new PessoaDAO($_SESSION['dbname']);
$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);
$objESHistoricoDAO = new ESHistoricosDAO($_SESSION['dbname']);
$objTurnoDAO = new TurnoDAO($_SESSION['dbname']);
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);
$objCursoDAO = new CursoDAO($_SESSION['dbname']);
$objClassesDAO = new ClassesDAO($_SESSION['dbname']);

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
                $curso = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                $classe = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
                $turma = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
                $turno = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
                $ano_lectivo = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
                $idade = $linha->getElementsByTagName("Data")->item(6)->nodeValue;
                $genero = $linha->getElementsByTagName("Data")->item(7)->nodeValue;

                $bilhete = "";
                $estado_civil = "solteiro(a)";

                if ($idade == null || $idade == 0) {
                    $data_nascimento = "1000-01-01";
                } else {
                    $data_nascimento = (date("Y") - $idade) . "-01-01";
                }


                //echo $nome." == ".$curso." == ".$classe." == ".$turma." == ".$turno." == ".$ano_lectivo." == ".$data_nascimento." == ".$genero." == ".$bilhete." == ".$estado_civil."<br/>";

                //pesquisar curso e trazer ID
                $objCurso->setNome_curso($curso);
                $resCurs = $objCursoDAO->busca_ID($objCurso);
                $viewCurs = $resCurs->fetch(PDO::FETCH_OBJ);

                //pesquisar classe e trazer ID
                $objClasses->setClasse($classe);
                $resCla = $objClassesDAO->busca_ID($objClasses);
                $viewCla = $resCla->fetch(PDO::FETCH_OBJ);

                //pesquisar turma e trazer ID
                $objTurma->setTurma($turma);
                $resTurm = $objTurmaDAO->busca_ID($objTurma);
                $viewTurm = $resTurm->fetch(PDO::FETCH_OBJ);

                //pesquisar turno e trazer ID
                $objTurno->setTurno($turno);
                $resTurn = $objTurnoDAO->busca_ID($objTurno);
                $viewTurn = $resTurn->fetch(PDO::FETCH_OBJ);


                // fazer cadastro pessoa
                /* dados pessoais */
                $objPessoa->setNome($nome);
                $objPessoa->setData_nascimento($data_nascimento);
                $objPessoa->setGenero($genero);
                $objPessoa->setEstado_civil($estado_civil);
                $objPessoa->setBilhete($bilhete);
                /* fim */

                $res3 = $objPessoaDAO->verificar($objPessoa);
                if ($res3->rowCount() <= 0):
                    $resV = $objPessoaDAO->verificar2($objPessoa);
                    if ($resV->rowCount() <= 0):
                        $res4 = $objPessoaDAO->salvar($objPessoa);
                        if ($res4 > 0):

                            /* dados academicos */
                            // fazer cadastro estudante
                            $objEstudante->setAno_lectivo($ano_lectivo);
                            $objEstudante->setData_cadastro(date("Ymd"));
                            $objEstudante->setId_pessoa($res4);
                            $objTurno->setId_classe($viewCla->id_classe);
                            $objTurno->setId_curso($viewCurs->id_curso);
                            $objTurno->setId_turma($viewTurm->id_turma);
                            /* fim */
                            $res6 = $objEstudanteDAO->salvar($objEstudante, $objTurno);
                            if ($res6 > 0):
                                /* dados historico */
                                $objESHistorico->setAno_lectivo2($ano_lectivo);
                                $objESHistorico->setId_estudante($res6);

                                /* fim */
                                $res8 = $objESHistoricoDAO->salvar($objESHistorico, $objTurno);
                                if ($res8 == "yes"):
                                    $resposta_final = 1;
                                endif;
                            endif;
                        endif;
                    endif;
                elseif ($res3->rowCount() >= 1):
                    if ($viewCurs->id_curso != "" && $viewTurm->id_turma != "" && $viewTurn->id_turno != "" && $viewCla->id_classe != ""):
                        //echo $nome . " == " . $viewCurs->id_curso . " == " . $viewCla->id_classe . " == " . $viewTurm->id_turma . " == " . $viewTurn->id_turno . " == " . $ano_lectivo . " == " . $data_nascimento . " == " . $genero . " == " . $bilhete . " == " . $estado_civil . "<br/>";

                        $viewB = $res3->fetch(PDO::FETCH_OBJ);
                        if ($viewB->bilhete == ""):

                            $resV = $objPessoaDAO->verificar2($objPessoa);
                            if ($resV->rowCount() <= 0):
                                $res4 = $objPessoaDAO->salvar($objPessoa);
                                if ($res4 > 0):

                                    /* dados academicos */
                                    // fazer cadastro estudante
                                    $objEstudante->setAno_lectivo($ano_lectivo);
                                    $objEstudante->setData_cadastro(date("Ymd"));
                                    $objEstudante->setId_pessoa($res4);
                                    $objTurno->setId_classe($viewCla->id_classe);
                                    $objTurno->setId_curso($viewCurs->id_curso);
                                    $objTurno->setId_turma($viewTurm->id_turma);
                                    /* fim */
                                    $res6 = $objEstudanteDAO->salvar($objEstudante, $objTurno);
                                    if ($res6 > 0):
                                        /* dados historico */
                                        $objESHistorico->setAno_lectivo2($ano_lectivo);
                                        $objESHistorico->setId_estudante($res6);

                                        /* fim */
                                        $res8 = $objESHistoricoDAO->salvar($objESHistorico, $objTurno);
                                        if ($res8 == "yes"):
                                            $resposta_final = 1;
                                        endif;
                                    endif;
                                endif;
                            endif;
                        endif;

                    else:
                        echo "Erro encontrado";
                    endif;

                endif;

                //fazer cadastro historico

            }
            $primeira_linha = false;
        }
        echo $resposta_final;
    }
} else {
    echo '<div class="alert alert-danger">Tipo do ficheiro nao reconhecido</div>';
}

