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

$licenca = addslashes(addslashes(htmlspecialchars($_POST['licenca'])));
$nome = addslashes(htmlspecialchars($_POST['nome']));
$provincia = addslashes(htmlspecialchars($_POST['provincia']));
$municipio = addslashes(htmlspecialchars($_POST['municipio']));
$bairro = addslashes(htmlspecialchars($_POST['bairro']));
$telefone = addslashes(htmlspecialchars($_POST['telefone']));
$array_codigo = explode("-", $licenca);

$codigo = strtolower($array_codigo[0]);

$logo_image = "none.jpg";
$new_dbname = "tenancyschool_" . $codigo;
/* enviando pelo os setters */
$escola->setCity($municipio);
$escola->setDate_cad(date("Ymd"));
$escola->setDistrit($bairro);
$escola->setId_school($codigo);
$escola->setLicence_cod($licenca);
$escola->setLogo_image($logo_image);
$escola->setNome($nome);
$escola->setPhone($telefone);
$escola->setProvince($provincia);
$escola->setDbname($new_dbname);
/* invocando as funcoes */
$base->setDbname($new_dbname);
$res = $escolaDAO->verificar($escola);
if ($res->rowCount() >= 1):
    echo $alertas->codigo_escolar();
elseif ($res->rowCount() <= 0):
    $res1 = $licencaDAO->verificar($licenca);
    $ver1 = $res1->fetch(PDO::FETCH_OBJ);
    if ($res1->rowCount() >= 1):
        if ($ver1->uses == "sim"):
            echo $alertas->licenca_usada();
        elseif ($ver1->uses == "nao"):
            $escola->setId_licence($ver1->id_licence);
            $res2 = $escolaDAO->salvar($escola);
            if ($res2 == "yes"):
                $res3 = $licencaDAO->muda_uso($ver1->id_licence);
                if ($res3 == "yes"):
                    $res4 = $base->criar();
                    if ($res4 == "yes"):
                        $_UP['pasta'] = '../FICHEIROS/' . $codigo;
                        $_UP['pasta2'] = '../FICHEIROS/' . $codigo . '/' . $codigo . '_fotos';
                        $_UP['pasta3'] = '../FICHEIROS/' . $codigo . '/' . $codigo . '_documentos';
                        $_UP['pasta4'] = '../FICHEIROS/' . $codigo . '/' . $codigo . '_videos';

                        mkdir($_UP['pasta'], 0777);
                        mkdir($_UP['pasta2'], 0777);
                        mkdir($_UP['pasta3'], 0777);
                        mkdir($_UP['pasta4'], 0777);

                        echo "1";
                    endif;
                endif;
            endif;


        endif;


    elseif ($res1->rowCount() <= 0):
        echo $alertas->licenca_errada();
    endif;
endif;
?>




