<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Usuario.php';
include_once '../../../DAO/PERUsuarioDAO.php';
include_once '../../../DAO/UsuarioDAO.php';
include_once '../../../DAO/TipoPERDAO.php';




$objUsuario = new Usuario();
$objTipoPERDAO = new TipoPERDAO($_SESSION['dbname']);
$objUsuarioDAO = new UsuarioDAO($_SESSION['dbname']);
$objPERUsuarioDAO = new PERUsuarioDAO($_SESSION['dbname']);

$res1 = $objTipoPERDAO->buscar_tiposPermicao();

$id_usuario = addslashes(htmlspecialchars($_POST['id_usuario']));
$_SESSION['id_usuarioPERMIT'] = $id_usuario;
$objUsuario->setId_usuario($id_usuario);

$res3 = $objUsuarioDAO->buscar_nomeUS($objUsuario);
$view3 = $res3->fetch(PDO::FETCH_OBJ);
?>

<fieldset class="col-md-12">
    <legend><?php echo $view3->nome_usuario;?></legend>

    <div class="col-md-12">
        <div class="form-group">
      <?php
      $res2 = $objPERUsuarioDAO->buscar_permicoesUsuario($objUsuario);
      ?>
            
            <?php
      while ($view2 = $res2->fetch(PDO::FETCH_OBJ)):
          echo $view2->	tipo."<br/>";
      endwhile;
            ?>
        </div>
    </div>

</fieldset>






