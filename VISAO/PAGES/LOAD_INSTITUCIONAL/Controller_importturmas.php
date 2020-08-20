<?php

ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
        . 'window.location.href="login.php";'
        . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Turno.php';


include_once '../../../DAO/ClassesDAO.php';
include_once '../../../DAO/TurmaDAO.php';
include_once '../../../DAO/TurnoDAO.php';
include_once '../../../DAO/CursoDAO.php';

$objCurso = new Curso();
$objClasse = new Classes();
$objTurma = new Turma();
$objTurno = new Turno();

$objCursoDAO = new CursoDAO($_SESSION['dbname']);
$objClasseDAO = new ClassesDAO($_SESSION['dbname']);
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);
$objTurnoDAO = new TurnoDAO($_SESSION['dbname']);


$resposta_final = 0;

if ($_FILES['arquivo']['type'] == "text/xml") {

    if (!empty($_FILES['arquivo']['tmp_name'])) {
        $arquivo = new DomDocument();
        $arquivo->load($_FILES['arquivo']['tmp_name']);

        $linhas = $arquivo->getElementsByTagName("Row");
        $primeira_linha = true;

        foreach ($linhas as $linha) {
            if ($primeira_linha == false) {

                $curso = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
                $classe = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                $turno = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
                $turma = $linha->getElementsByTagName("Data")->item(3)->nodeValue;

                //
                //pesquisar curso e trazer ID e classe e trazer ID

                $objClasse->setClasse($classe);
                $objClasse->setNome_curso($curso);
                $resClaCur = $objClasseDAO->busca_ID_curso_classe($objClasse);
                $viewClaCur = $resClaCur->fetch(PDO::FETCH_OBJ);

                //pesquisar turno e trazer ID
                $objTurno->setTurno($turno);
                $resTurn = $objTurnoDAO->busca_ID($objTurno);
                $viewTurn = $resTurn->fetch(PDO::FETCH_OBJ);


                if ($viewClaCur->id_curso != "" && $viewTurn->id_turno != "" && $viewClaCur->id_classe != "") {
                    $objTurno->setId_curso($viewClaCur->id_curso);
                    $objTurno->setId_classe($viewClaCur->id_classe);
                    $objTurno->setId_turno($viewTurn->id_turno);
                    $objTurno->setTurma($turma);

                    $res1 = $objTurmaDAO->verificarTurma($objTurno);
                    if ($res1->rowCount() <= 0) {
                        $res2 = $objTurmaDAO->salvar($objTurno);
                        if ($res2 == "yes") {
                            $resposta_final = 1;
                        }
                    }

                } else {
                    echo "Nao encontrou";
                }

            }
            $primeira_linha = false;
        }
        echo $resposta_final;
    }
} else {
    echo '<div class="alert alert-danger">Tipo do ficheiro nao reconhecido</div>';
}

