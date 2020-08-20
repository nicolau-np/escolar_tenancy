<?php

ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
        . 'window.location.href="login.php";'
        . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Sala.php';


include_once '../../../DAO/TIPSalaDAO.php';
include_once '../../../DAO/SalaDAO.php';

$objSala = new Sala();
$objTIPSala = new TIPSala();

$objSalaDAO = new SalaDAO($_SESSION['dbname']);
$objTIPSalaDAO = new TIPSalaDAO($_SESSION['dbname']);

$resposta_final = 0;

if ($_FILES['arquivo']['type'] == "text/xml") {

    if (!empty($_FILES['arquivo']['tmp_name'])) {
        $arquivo = new DomDocument();
        $arquivo->load($_FILES['arquivo']['tmp_name']);

        $linhas = $arquivo->getElementsByTagName("Row");
        $primeira_linha = true;

        foreach ($linhas as $linha) {
            if ($primeira_linha == false) {

                $designacao = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
                $quant_estudantes = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
                $tipo_sala = $linha->getElementsByTagName("Data")->item(2)->nodeValue;


                //pesquisar tiposala e trazer ID
                $objTIPSala->setTipo($tipo_sala);
                $resTip = $objTIPSalaDAO->verificar($objTIPSala);
                $viewTip = $resTip->fetch(PDO::FETCH_OBJ);


                if ($viewTip->id_tiposala != "") {
                    $objSala->setId_tiposala($viewTip->id_tiposala);
                    $objSala->setDesignacao($designacao);
                    $objSala->setQuant_estudantes($quant_estudantes);


                    $res1 = $objSalaDAO->verificar($objSala);
                    if ($res1->rowCount() <= 0) {
                        $res2 = $objSalaDAO->salvar($objSala);
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

