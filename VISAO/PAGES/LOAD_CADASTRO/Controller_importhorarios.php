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
include_once '../../../MODELO/Director.php';
include_once '../../../MODELO/PERUsuario.php';
include_once '../../../MODELO/Usuario.php';
include_once '../../../DAO/UsuarioDAO.php';
include_once '../../../DAO/TipoPERDAO.php';
include_once '../../../DAO/PERUsuarioDAO.php';
include_once '../../../DAO/DirectorDAO.php';
include_once '../../../DAO/FuncionarioDAO.php';
include_once '../../../DAO/HorarioDAO.php';
include_once '../../../DAO/DisciplinasDAO.php';
include_once '../../../DAO/TurmaDAO.php';
include_once '../../../DAO/SalaDAO.php';

$objAlertas = new Alertas();
$objHorario = new Horario();
$objSala = new Sala();
$objFuncionario = new Funcionario();
$objTurma = new Turma();
$objDirector = new Director();
$objUsuario = new Usuario();
$objPERUsuario = new PERUsuario();
$objDisciplina = new Disciplinas();

$objHorarioDAO = new HorarioDAO($_SESSION['dbname']);
$objDirectorDAO = new DirectorDAO($_SESSION['dbname']);
$objUsuarioDAO = new UsuarioDAO($_SESSION['dbname']);
$objPERUsuarioDAO = new PERUsuarioDAO($_SESSION['dbname']);
$objTipoPERDAO = new TipoPERDAO($_SESSION['dbname']);
$objFuncionarioDAO = new FuncionarioDAO($_SESSION['dbname']);
$objDisciplinaDAO = new DisciplinasDAO($_SESSION['dbname']);
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);
$objSalaDAO = new SalaDAO($_SESSION['dbname']);


/*$id_funcionarioDir = addslashes(htmlspecialchars($_POST['id_funcionarioDir']));
$id_turma = addslashes(htmlspecialchars($_POST['id_turma']));
$ano_lectivo = addslashes(htmlspecialchars($_POST['ano_lectivo']));*/
$nome_director = null;
$ano = null;
$id_turma = null;
$resposta_final = 0;

if ($_FILES['arquivo']['type'] == "text/xml") {

    if (!empty($_FILES['arquivo']['tmp_name'])) {
        $arquivo = new DomDocument();
        $arquivo->load($_FILES['arquivo']['tmp_name']);

        $linhas = $arquivo->getElementsByTagName("Row");
        $primeira_linha = true;

        foreach ($linhas as $linha) {
            if ($primeira_linha == false) {

                $disciplina = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
                $nome_professor = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                $turma = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
                $sala = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
                $ano = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
                $nome_director = $linha->getElementsByTagName("Data")->item(5)->nodeValue;

                //pesquisar disciplina e trazer ID
                $objDisciplina->setNome_disciplina($disciplina);
                $resDis = $objDisciplinaDAO->buscar_ID($objDisciplina);
                $viewDis = $resDis->fetch(PDO::FETCH_OBJ);

                //pesquisar funcionario e trazer ID
                $objFuncionario->setNome($nome_professor);
                $resFun = $objFuncionarioDAO->buscar_ID($objFuncionario);
                $viewFun = $resFun->fetch(PDO::FETCH_OBJ);

                //pesquisar turma e trazer ID
                $objTurma->setTurma($turma);
                $resTur = $objTurmaDAO->busca_ID($objTurma);
                $viewTur = $resTur->fetch(PDO::FETCH_OBJ);

                //pesquisar sala e trazer ID
                $objSala->setDesignacao($sala);
                $resSal = $objSalaDAO->busca_ID($objSala);
                $viewSal = $resSal->fetch(PDO::FETCH_OBJ);




                if ($viewDis->id_disciplina != "" && $viewFun->id_funcionario != "" && $viewTur->id_turma != "") {
                    //echo "Disciplina: " . $viewDis->id_disciplina . " == Funcionario: " . $viewFun->id_funcionario . " == Turma: " . $viewTur->id_turma . " == Sala: ".$viewSal->id_sala."<br/>";

                    $objHorario->setId_disciplina($viewDis->id_disciplina);
                    $objFuncionario->setId_funcionario($viewFun->id_funcionario);
                    $objTurma->setId_turma($viewTur->id_turma);
                    $objSala->setId_sala($viewSal->id_sala);
                    $objHorario->setAno_lectivo($ano);

                    $id_turma = $viewTur->id_turma;


                    $res = $objHorarioDAO->verificar($objHorario, $objSala, $objTurma, $objFuncionario);
                    if ($res->rowCount() <= 0):
                        $res3 = $objHorarioDAO->Prof_VS_disciplinas($objHorario, $objTurma, $objFuncionario);
                        if ($res3 == "yes"):
                            $res4 = $objHorarioDAO->salvar($objHorario, $objSala, $objTurma, $objFuncionario);
                            if ($res4 == "yes"):
                                $resposta_final = 1;
                            endif;
                        endif;
                    endif;
                } else {
                    echo "Nao encontrou";
                }

            }
            $primeira_linha = false;
        }

        if ($resposta_final == 1) {
            $objFuncionario->setNome($nome_director);
            $resDir = $objFuncionarioDAO->buscar_ID($objFuncionario);
            $viewDir = $resDir->fetch(PDO::FETCH_OBJ);

            $objDirector->setAno_lectivo($ano);
            $objDirector->setId_turma($id_turma);
            $objFuncionario->setId_funcionario($viewDir->id_funcionario);
            $objPERUsuario->setTipo("restrit 2");

            /*buscar id permicao apartir do tipo*/
            $res7 = $objTipoPERDAO->buscar_idTipo($objPERUsuario);
            $view7 = $res7->fetch(PDO::FETCH_OBJ);
            /***/
            $res1 = $objDirectorDAO->verificar($objDirector, $objFuncionario);
            if ($res1->rowCount() <= 0):
                $res2 = $objDirectorDAO->verificar_prof($objDirector, $objFuncionario);
                if ($res2->rowCount() <= 0):
                    $res3 = $objDirectorDAO->verificar_turma($objDirector);
                    if ($res3->rowCount() <= 0):
                        $res4 = $objDirectorDAO->salvar($objDirector, $objFuncionario);
                        if ($res4 == "yes"):
                            // codigo fica aqui
                            $objUsuario->setId_funcionario($viewDir->id_funcionario);
                            $res5 = $objUsuarioDAO->buscarID_usuario($objUsuario);
                            $view5 = $res5->fetch(PDO::FETCH_OBJ);
                            $objPERUsuario->setId_tipopermicao($view7->id_tipopermicao);
                            $objUsuario->setId_usuario($view5->id_usuario);
                            $res6 = $objPERUsuarioDAO->salvar($objPERUsuario, $objUsuario);
                            if ($res6 == "yes"):
                                $resposta_final = 1;
                            endif;

                        endif;
                    endif;
                endif;
            endif;
        }

        // echo "<hr/>Director de Turma: $nome_director<hr/>";
        echo $resposta_final;
    }
} else {
    echo '<div class="alert alert-danger">Tipo do ficheiro nao reconhecido</div>';
}

