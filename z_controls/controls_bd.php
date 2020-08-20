<?php

include_once '../CONTROLO/Conexao.php';
include_once '../CONTROLO/Alertas.php';
include_once '../MODELO/Escola.php';
include_once '../DAO/EscolaDAO.php';
include_once '../DAO/LicencaDAO.php';
include_once '../CONTROLO/Base.php';
$dbname = "tenancyschool";

$alertas = new Alertas();
$escola = new Escola();
$escolaDAO = new EscolaDAO($dbname);
$licencaDAO = new LicencaDAO($dbname);
$base = new Base();

$codigo = addslashes(htmlspecialchars($_POST['codigo']));
$banco_importando = "tenancyschool_" . $codigo;
$banco = "../CONTROLO/00tenancyschool.sql";

$base->setDbname($banco_importando);

$res = $base->verificar_tabelas();
if ($res->rowCount() >= 1):
    echo $alertas->upload_feito();
else:
    $res1 = $base->importar($banco);
    if ($res1 == "yes"):
        echo "1";
    else:
        echo $alertas->ficheiro_inexistente();
    endif;
endif;
?>
