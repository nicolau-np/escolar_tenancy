<?php

ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
        . 'window.location.href="login.php";'
        . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Disciplinas.php';

include_once '../../../DAO/DisciplinasDAO.php';
include_once '../../../DAO/ComponenteDAO.php';

$objDisciplina = new Disciplinas();
$objComponete = new Componente();

$objDisciplinaDAO = new DisciplinasDAO($_SESSION['dbname']);
$objComponeteDAO = new ComponenteDAO($_SESSION['dbname']);

$resposta_final = 0;

if ($_FILES['arquivo']['type'] == "text/xml") {

    if (!empty($_FILES['arquivo']['tmp_name'])) {
        $arquivo = new DomDocument();
        $arquivo->load($_FILES['arquivo']['tmp_name']);

        $linhas = $arquivo->getElementsByTagName("Row");
        $primeira_linha = true;

        foreach ($linhas as $linha) {
            if ($primeira_linha == false) {

                $componente = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
                $nome_disciplina = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                $sigla = $linha->getElementsByTagName("Data")->item(2)->nodeValue;


                //pesquisar componente e trazer ID
                $objComponete->setComponente($componente);
                $resCom = $objComponeteDAO->buscar_ID($objComponete);
                $viewCom = $resCom->fetch(PDO::FETCH_OBJ);


                /* dados disciplina */
                $objDisciplina->setNome_disciplina($nome_disciplina);
                $objDisciplina->setSigla($sigla);
                /* fim */

                if ($viewCom->id_componente != "") {
                    $objDisciplina->setId_componente($viewCom->id_componente);
                    $res1 = $objDisciplinaDAO->verificar($objDisciplina);
                    if($res1->rowCount() <= 0){
                        $res2 = $objDisciplinaDAO->salvar($objDisciplina);
                        if($res2 == "yes"){
                            $resposta_final = 1;
                        }
                    }
                }else{
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

