<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/MunicipioDAO.php';
include_once '../../../MODELO/Municipio.php';

$objMunicipioDAO = new MunicipioDAO($_SESSION['dbname']);
$objMunicipio = new Municipio();

$id_provincia = addslashes(htmlspecialchars($_GET['id_provincia']));
$objMunicipio->setId_provincia($id_provincia);

$res = $objMunicipioDAO->buscarMunicipio($objMunicipio);
?>
<div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-city"></i></span>
</div>

<select name="id_municipio" id="municipio" class="form-control" required="">
    <option value="">Município</option>
    <?php 
    while($view = $res->fetch(PDO::FETCH_OBJ)):
    ?>
    <option value="<?php echo $view->id_municipio;?>"><?php echo $view->municipio; ?></option>
    <?php endwhile;?>
</select>


