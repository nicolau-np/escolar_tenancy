<?php

ob_start();
session_start();
include_once '../../../CONTROLO/Conexao.php';
include_once '../../../CONTROLO/Alertas.php';
include_once '../../../MODELO/Classes.php';
include_once '../../../DAO/CursoDAO.php';
include_once '../../../DAO/ClassesDAO.php';


$objCurso = new Curso();
$objClasse = new Classes();
$objCursoDAO = new CursoDAO($_SESSION['dbname']);
$objClasseDAO = new ClassesDAO($_SESSION['dbname']);
$objAlertas = new Alertas();

$id_ensino = addslashes(htmlspecialchars($_POST['ensino']));
$curso = addslashes(htmlspecialchars($_POST['nome_curso']));

$array_superior = array("1 ano", "2 ano", "3 ano", "4 ano", "5 ano", "6 ano");
$array_Iciclo = array("Iniciação", "1ª", "2ª", "3ª", "4ª", "5ª", "6ª", "7ª", "8ª", "9ª");
$array_TecIIciclo = array("10ª", "11ª", "12ª", "13ª");

$objCurso->setId_ensino($id_ensino);
$objCurso->setNome_curso($curso);


$res = $objCursoDAO->verificarCurso($objCurso);
if ($res->rowCount() >= 1):
    echo $objAlertas->curso_existente();
elseif ($res->rowCount() <= 0):
    $res1 = $objCursoDAO->salvar($objCurso);

    if ($res1 == "yes"):
        $res2 = $objCursoDAO->verificarCurso($objCurso);
        $view2 = $res2->fetch(PDO::FETCH_OBJ);
        if ($res2->rowCount() >= 1):
            if ($id_ensino == 2):
                foreach ($array_Iciclo as $array_usar) {
                    $objClasse->setClasse($array_usar);
                    $objClasse->setId_curso($view2->id_curso);

                    $res4 = $objClasseDAO->salvar($objClasse);
                } elseif (($id_ensino == 3) || ($id_ensino == 4)):
                foreach ($array_TecIIciclo as $array_usar) {
                    $objClasse->setClasse($array_usar);
                    $objClasse->setId_curso($view2->id_curso);

                    $res4 = $objClasseDAO->salvar($objClasse);
                } elseif ($id_ensino == 5):
                foreach ($array_superior as $array_usar) {
                    $objClasse->setClasse($array_usar);
                    $objClasse->setId_curso($view2->id_curso);

                    $res4 = $objClasseDAO->salvar($objClasse);
                }
            endif;

            if ($res4 == "yes"):
                echo "1";
            endif;
        endif;
    endif;
endif;
?>

