<?php
include_once '../CONTROLO/Conexao.php';
include_once '../CONTROLO/Estilos.php';
include_once '../MODELO/Estudante.php';
include_once '../MODELO/Escola.php';
include_once '../MODELO/Trimestrais.php';
include_once '../MODELO/Finais.php';
include_once '../DAO/EscolaDAO.php';
include_once '../DAO/EstudanteDAO.php';
include_once '../DAO/TrimestraisDAO.php';
include_once '../DAO/FinaisDAO.php';
include_once '../DAO/DISCursoDAO.php';

$codigo = addslashes(htmlspecialchars($_POST['codigo']));
$n_estudante = addslashes(htmlspecialchars($_POST['n_estudante']));
$ano_lectivo = addslashes(htmlspecialchars($_POST['ano_lectivo']));
$resposta1 = null;
$resposta2 = null;

$dbname = "tenancyschool_" . $codigo;

$dbname2 = "tenancyschool";

$objEscolaDAO = new EscolaDAO($dbname2);
$objEscola = new Escola();
$objTrimestrais = new Trimestrais();
$objEstudante = new Estudante();
$objFinais = new Finais();
$objEstilos = new Estilos();


$objEscola->setId_school($codigo);
$res = $objEscolaDAO->consultaEscola($objEscola);
if ($res->rowCount() <= 0):
    echo '<div class="alert alert-danger">Nº escolar incorrecto!</div>';
elseif ($res->rowCount() >= 1):
    $view = $res->fetch(PDO::FETCH_OBJ);
    $resposta1 = "sim";


    $objEstudante->setAno_lectivo($ano_lectivo);
    $objEstudante->setId_estudante($n_estudante);
    $objEstudanteDAO = new EstudanteDAO($dbname);
    $objTrimestraisDAO = new TrimestraisDAO($dbname);
    $objFinaisDAO = new FinaisDAO($dbname);
    $objDISCursoDAO = new DISCursoDAO($dbname);

    $res1 = $objEstudanteDAO->ver_estudante($objEstudante);
    if ($res1->rowCount() <= 0):
        echo '<div class="alert alert-warning">Estudante não encontrado</div>';
    elseif ($res1->rowCount() >= 1):
        $view1 = $res1->fetch(PDO::FETCH_OBJ);
        $resposta2 = "sim";

    endif;

endif;
?>

<?php if ($resposta1 == "sim" && $resposta2 == "sim"): ?>
    <!-- carregar conteudo -->
    <?php
    if (($view1->ensino == "Primário & I Cíclo (ini . 9)") && (($view1->classe == "7ª") || ($view1->classe == "8ª") || ($view1->classe == "9ª"))):
        include 'z_pautas/pt_Pri_Bas_789.php';
    elseif (($view1->ensino == "Primário & I Cíclo (ini . 9)") && (($view1->classe == "2ª") || ($view1->classe == "4ª"))):
        include 'z_pautas/pt_Pri_Bas_24.php';
    elseif (($view1->ensino == "Primário & I Cíclo (ini . 9)") && (($view1->classe == "Iniciação") || ($view1->classe == "1ª") || ($view1->classe == "3ª"))):
        include 'z_pautas/pt_Pri_Bas_ini3.php';
    elseif (($view1->ensino == "Secundário & II Cí­clo (10 . 13)") && (($view1->classe == "10ª") || ($view1->classe == "11ª") || ($view1->classe == "12ª") || ($view1->classe == "13ª"))):
        include 'z_pautas/pt_Sec_1013.php';
    elseif (($view1->ensino == "Formação Técnico Profissional(10 . 13)") && (($view1->classe == "10ª") || ($view1->classe == "11ª") || ($view1->classe == "12ª") || ($view1->classe == "13ª"))):
        include 'z_pautas/pt_Tec_1013.php';
    endif;
    ?>
    <!-- carregar conteudo -->
<?php endif; ?>






































