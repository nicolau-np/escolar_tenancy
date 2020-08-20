<?php
ob_start();
session_start();

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/ClassesDAO.php';
include_once '../../../MODELO/Classes.php';

$objConexao = new Conexao();
$objClasseDAO = new ClassesDAO($_SESSION['dbname']);
$objClasse = new Classes();

$id_curso = addslashes(htmlspecialchars($_GET['id_curso']));
$objClasse->setId_curso($id_curso);

$res = $objClasseDAO->buscarClasses_porCurso($objClasse);
?>
<div class="input-group-prepend">
    <span class="input-group-text"><i class="fa fa-building"></i></span>
</div>
<select class="form-control" required="" name="classe">
    <option value="">Classe</option>
    <?php
    while ($view = $res->fetch(PDO::FETCH_OBJ)):
        ?>
        <option value="<?php echo $view->id_classe; ?>"><?php echo $view->classe; ?></option>
        <?php
    endwhile;
    ?>
</select>  
