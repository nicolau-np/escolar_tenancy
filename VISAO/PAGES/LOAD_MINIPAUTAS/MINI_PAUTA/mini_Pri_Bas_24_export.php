<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../../CONTROLO/Conexao.php';
include_once '../../../../CONTROLO/Globals.php';
include_once '../../../../CONTROLO/Estilos.php';
include_once '../../../../MODELO/Estudante.php';
include_once '../../../../MODELO/Trimestrais.php';
include_once '../../../../MODELO/Turma.php';
include_once '../../../../DAO/TrimestraisDAO.php';
include_once '../../../../DAO/EstudanteDAO.php';
include_once '../../../../MODELO/Finais.php';
include_once '../../../../DAO/FinaisDAO.php';
include_once '../../../../DAO/TurmaDAO.php';

$objGlobals = new Globals();
$objEstilos = new Estilos();
$objTurma = new Turma();
$objTrimestrais = new Trimestrais();
$objTrimestraisDAO = new TrimestraisDAO($_SESSION['dbname']);
$objFinais = new Finais();
$objFinaisDAO = new FinaisDAO($_SESSION['dbname']);
$objEstudante = new Estudante();
$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);

$objEstudante->setAno_lectivo($objGlobals->getAno_lectivo());
$objTurma->setTurma($_SESSION['turmaM']);

$objTrimestrais->setAno_lectivoT($objGlobals->getAno_lectivo());
$objTrimestrais->setNome_disciplina($_SESSION['nome_disciplinaM']);

$objFinais->setAno_lectivoF($objGlobals->getAno_lectivo());
$objFinais->setNome_disciplina($_SESSION['nome_disciplinaM']);

$arquivo_saida = "mini_pauta_" . $_SESSION['nome_disciplinaM'] . "_" . $_SESSION['turmaM'] . "_" . $objGlobals->getAno_lectivo() . ".xls";

// configuracao header para forcar download
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified:" . gmdate("D,d M YH:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/x-msexcel");
header("Content-Disposition: attachment; filename=\"{$arquivo_saida}\"");
header("Content-Description: PHP Generated Data");
//fim
?>
<meta charset="utf-8"/>
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
</style>
<div class="pagina">

    <table class="table align-items-center table-flush" border="1" style="font-family:arial; font-size: 13px;">
        <thead class="thead-light">
            <tr>
                <th colspan="15">MINI PAUTA DISCIPLINA: <?php echo $_SESSION['nome_disciplinaM']; ?>&nbsp;&nbsp; TURMA: <?php echo $_SESSION['turmaM']; ?> &nbsp;&nbsp; ANO: <?php echo $objGlobals->getAno_lectivo(); ?></th>
            </tr>
            <tr>
                <th colspan="3" style="text-align:center;">Dados Pessoais</th>
                <th colspan="3" style="text-align:center;">1º Trimestre</th>
                <th colspan="3" style="text-align:center;">2º Trimestre</th>
                <th colspan="3" style="text-align:center;">3º Trimestre</th>
                <th colspan="3" style="text-align:center;">Dados Finais</th>
            </tr>
            <tr>

                <th scope="col" style="width: 8%;">Nº</th>
                <th scope="col">Nome do estudante</th>
                <th scope="col">Gênero</th>

                <th scope="col">MAC</th>
                <th scope="col">CPP</th>
                <th>CT</th>

                <th scope="col">MAC</th>
                <th scope="col">CPP</th>
                <th>CT</th>

                <th scope="col">MAC</th>
                <th scope="col">CPP</th>
                <th>CT</th>

                <th scope="col">CAP</th>
                <th scope="col">CPE</th>
                <th>CF</th>
            </tr>
        </thead>
        <tbody>
<?php
$cont = 0;
$resEs = $objEstudanteDAO->buscarEstudantes_turma($objEstudante, $objTurma);
while ($viewEs = $resEs->fetch(PDO::FETCH_OBJ)):
    $cont ++;
    $objEstudante->setId_estudante($viewEs->id_estudante);

    $objTrimestrais->setEpoca(1);
    $res1 = $objTrimestraisDAO->search_nota($objTrimestrais, $objEstudante);
    $view1 = $res1->fetch(PDO::FETCH_OBJ);

    $objTrimestrais->setEpoca(2);
    $res2 = $objTrimestraisDAO->search_nota($objTrimestrais, $objEstudante);
    $view2 = $res2->fetch(PDO::FETCH_OBJ);

    $objTrimestrais->setEpoca(3);
    $res3 = $objTrimestraisDAO->search_nota($objTrimestrais, $objEstudante);
    $view3 = $res3->fetch(PDO::FETCH_OBJ);

    $resFi = $objFinaisDAO->search_nota($objFinais, $objEstudante);
    $viewFi = $resFi->fetch(PDO::FETCH_OBJ);
    ?>
                <tr>

                    <td><?php echo $cont; ?></td>
                    <td>
    <?php echo $viewEs->nome; ?>
                    </td>
                    <td>
    <?php echo $viewEs->genero; ?>
                    </td>
                    <!-- 1 trimestre-->
                    <td class="<?php if ($res1->rowCount() >= 1): echo $objEstilos->nota10($view1->mac);
    endif;
    ?>">
                        <?php
                            if ($res1->rowCount() >= 1): if ($view1->mac != ""):echo $view1->mac;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    <td class="<?php if ($res1->rowCount() >= 1): echo $objEstilos->nota10($view1->cpp);
                        endif;
                        ?>">
                            <?php
                            if ($res1->rowCount() >= 1): if ($view1->data_lancamento != ""):echo $view1->cpp;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    <td class="<?php if ($res1->rowCount() >= 1): echo $objEstilos->nota10($view1->ct);
                        endif;
                            ?>">
                            <?php
                            if ($res1->rowCount() >= 1): if ($view1->ct != ""):echo $view1->ct;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    <!-- 2 trimestre-->
                    <td class="<?php if ($res2->rowCount() >= 1): echo $objEstilos->nota10($view2->mac);
                            endif;
                            ?>">
                            <?php
                            if ($res2->rowCount() >= 1): if ($view2->mac != ""):echo $view2->mac;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    <td class="<?php if ($res2->rowCount() >= 1): echo $objEstilos->nota10($view2->cpp);
                            endif;
                            ?>">
                            <?php
                            if ($res2->rowCount() >= 1): if ($view2->data_lancamento != ""):echo $view2->cpp;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    <td class="<?php if ($res2->rowCount() >= 1): echo $objEstilos->nota10($view2->ct);
                    endif;
                            ?>">
                            <?php
                            if ($res2->rowCount() >= 1): if ($view2->ct != ""):echo $view2->ct;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    <!-- 3 trimestre-->
                    <td class="<?php if ($res3->rowCount() >= 1): echo $objEstilos->nota10($view3->mac);
                    endif;
                            ?>">
                            <?php
                            if ($res3->rowCount() >= 1): if ($view3->mac != ""):echo $view3->mac;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    <td class="<?php if ($res3->rowCount() >= 1): echo $objEstilos->nota10($view3->cpp);
                        endif;
                            ?>">
                            <?php
                            if ($res3->rowCount() >= 1): if ($view2->data_lancamento != ""):echo $view3->cpp;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    <td class="<?php if ($res3->rowCount() >= 1): echo $objEstilos->nota10($view3->ct);
                        endif;
                            ?>">
    <?php
    if ($res3->rowCount() >= 1): if ($view3->ct != ""):echo $view3->ct;
        else: echo "---";
        endif;
    else: echo"---";
    endif;
    ?>
                    </td>
                    <!-- finais-->
                    <td class="<?php if ($resFi->rowCount() >= 1): echo $objEstilos->nota10($viewFi->cap);
                        endif;
    ?>">
                        <?php
                        if ($resFi->rowCount() >= 1): if ($viewFi->cap != ""):echo $viewFi->cap;
                            else: echo "---";
                            endif;
                        else: echo"---";
                        endif;
                        ?>
                    </td>
                    <td class="<?php if ($resFi->rowCount() >= 1): echo $objEstilos->nota10($viewFi->cpe);
                        endif;
                        ?>">
                        <?php
                            if ($resFi->rowCount() >= 1): if ($viewFi->data_lancamento != ""):echo $viewFi->cpe;
                                else: echo "---";
                                endif;
                            else: echo"---";
                            endif;
                            ?>
                    </td>
                    <td class="<?php if ($resFi->rowCount() >= 1): echo $objEstilos->nota10($viewFi->cf);
                        endif;
                        ?>">
    <?php
    if ($resFi->rowCount() >= 1): if ($viewFi->cf != ""):echo $viewFi->cf;
        else: echo "---";
        endif;
    else: echo"---";
    endif;
    ?>
                    </td>
                </tr>
<?php endwhile; ?>
        </tbody>
    </table>

</div>
<?php exit; ?>
