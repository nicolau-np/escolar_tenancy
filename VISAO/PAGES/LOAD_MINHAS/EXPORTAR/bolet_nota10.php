<meta charset="utf-8">
<style>
    .mau{
        color: #EF3159;
    }
    .sufice{
        color:#ffd600; 
    }
    .mediuque{
        color: #b37400;  
    }
    .bom{
        color:#2dce89; 
    }
    .muito_bom{
        color: #4d7bca;
    }
    .nada{
        color:#333;
    }
    .desc{
        color: #4d7bca;
    }
    
</style>
<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../../CONTROLO/Conexao.php';
include_once '../../../../CONTROLO/Estilos.php';
include_once '../../../../MODELO/Estudante.php';
include_once '../../../../MODELO/Turma.php';
include_once '../../../../MODELO/Trimestrais.php';
include_once '../../../../DAO/EstudanteDAO.php';
include_once '../../../../DAO/DisciplinasDAO.php';
include_once '../../../../DAO/TrimestraisDAO.php';

$objEstudante = new Estudante();
$objEstilos = new Estilos();
$objTurma = new Turma();
$objTrimestrais = new Trimestrais();
$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);
$objDisciplinasDAO = new DisciplinasDAO($_SESSION['dbname']);
$objTrimestraisDAO = new TrimestraisDAO($_SESSION['dbname']);


$arquivo_saida = "Boletim de Nota_" . $_SESSION['turmaMINHA'] . "_" . $_SESSION['epocaBO'] . "_" . $_SESSION['ano_lectivoBO'] . ".xls";

// configuracao header para forcar download
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified:" . gmdate("D,d M YH:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/x-msexcel");
header("Content-Disposition: attachment; filename=\"{$arquivo_saida}\"");
header("Content-Description: PHP Generated Data");
//fim


if (isset($_SESSION['favoritosBO']) && $_SESSION['favoritosBO'] != null):
    $objTrimestrais->setAno_lectivoT($_SESSION['ano_lectivoBO']);
    $objTrimestrais->setEpoca($_SESSION['epocaBO']);

    $objEstudante->setAno_lectivo($_SESSION['ano_lectivoBO']);
    $objTurma->setTurma($_SESSION['turmaMINHA']);
    $res = $objEstudanteDAO->buscarEstudantes_turma($objEstudante, $objTurma);
    ?>




    <table class="table align-items-center table-flush" border='1' style="font-family: arial; font-size: 13px; width: 100%;">
        <thead class="thead-light">
            <tr>
                <th>BOLETIM DE NOTA &nbsp;&nbsp;&nbsp;TURMA: <?php echo $_SESSION['turmaMINHA']; ?>&nbsp;&nbsp;&nbsp;TRIMESTRE: <?php echo $_SESSION['epocaBO']; ?> &nbsp;&nbsp;&nbsp;ANO: <?php echo $_SESSION['ano_lectivoBO']; ?> </th>
            </tr>

        </thead>
    </table>

    <?php
    $a = 0;
    while ($view = $res->fetch(PDO::FETCH_OBJ)):
        $a++;
        ?>
<table border="1" style="font-family: arial; font-size: 13px;">
            <thead>
                <tr>
                    <th scope="col" class="desc"><?php echo "Nº[" . $a . "]-" . $view->nome; ?></th>
                    <?php
                    foreach ($_SESSION["favoritosBO"] as $key => $value) {
                        $id_disciplina = $_SESSION["favoritosBO"][$key];
                        $resDis = $objDisciplinasDAO->ID_buscarDisciplina($id_disciplina);
                        $viewDis = $resDis->fetch(PDO::FETCH_OBJ);
                        ?>
                        <th scope="col"><?php echo $viewDis->sigla; ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>MAC</td>
                    <?php
                    foreach ($_SESSION["favoritosBO"] as $key => $value) {
                        $id_disciplina = $_SESSION["favoritosBO"][$key];

                        $objTrimestrais->setId_disciplina($id_disciplina);
                        $objEstudante->setId_estudante($view->id_estudante);
                        $resNot = $objTrimestraisDAO->verificar($objTrimestrais, $objEstudante);
                        $viewNot = $resNot->fetch(PDO::FETCH_OBJ);
                        ?>
                        <td class="<?php if ($resNot->rowCount() >= 1): echo $objEstilos->nota10($viewNot->mac);
            endif;
            ?>">

                            <?php
                            if ($resNot->rowCount() >= 1): if ($viewNot->mac != ""):echo $viewNot->mac;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>

                        </td>
        <?php } ?>
                </tr>

                <tr>
                    <td>CPP</td>
                    <?php
                    foreach ($_SESSION["favoritosBO"] as $key => $value) {
                        $id_disciplina = $_SESSION["favoritosBO"][$key];

                        $objTrimestrais->setId_disciplina($id_disciplina);
                        $objEstudante->setId_estudante($view->id_estudante);
                        $resNot2 = $objTrimestraisDAO->verificar($objTrimestrais, $objEstudante);
                        $viewNot2 = $resNot2->fetch(PDO::FETCH_OBJ);
                        ?>
                        <td class="<?php if ($resNot2->rowCount() >= 1): echo $objEstilos->nota10($viewNot2->cpp);
                        endif;
                        ?>">

                            <?php
                            if ($resNot2->rowCount() >= 1): if ($viewNot2->data_lancamento != ""):echo $viewNot2->cpp;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>

                        </td>
        <?php } ?>
                </tr>

                <tr>
                    <td>CT</td>
                    <?php
                    foreach ($_SESSION["favoritosBO"] as $key => $value) {
                        $id_disciplina = $_SESSION["favoritosBO"][$key];

                        $objTrimestrais->setId_disciplina($id_disciplina);
                        $objEstudante->setId_estudante($view->id_estudante);
                        $resNot3 = $objTrimestraisDAO->verificar($objTrimestrais, $objEstudante);
                        $viewNot3 = $resNot3->fetch(PDO::FETCH_OBJ);
                        ?>
                        <td class="<?php if ($resNot3->rowCount() >= 1): echo $objEstilos->nota10($viewNot3->ct);
                endif;
                        ?>">

                            <?php
                            if ($resNot3->rowCount() >= 1): if ($viewNot3->ct != ""):echo $viewNot3->ct;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>

                        </td>
        <?php } ?>
                </tr>
            </tbody>
        </table>
        <hr/>
    <?php endwhile; ?>

    <?php
else:
    echo "nenhum estudante encontrado";
endif;


exit;
?>
