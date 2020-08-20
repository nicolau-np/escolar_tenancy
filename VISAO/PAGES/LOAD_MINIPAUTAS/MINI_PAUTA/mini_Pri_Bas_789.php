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
?>
<script>
    $(document).ready(function () {

        $("#voltar").click(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            jQuery.ajax({
                type: "POST",
                url: "LOAD_MINIPAUTAS/notas.php",
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    $("#carrega_mini").text('')
                            .append(data);
                }
            });
            return false;

        });

        $("#estatistic").click(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            jQuery.ajax({
                type: "POST",
                url: "LOAD_MINIPAUTAS/ESTATISTICAS/esta_Geral_20Quant.php",
                data: {pagina: "mini_Pri_Bas_789.php"},
                success: function (resultado) {
                    $("#modal-carregamento").modal("hide");
                    $("#carrega_mini").text('')
                            .append(resultado);
                }
            });
            return false;
        });

    });
</script>
<style>
    fieldset{

        border: 1px inset #f5365c;
        width: 100%;
    } 
    fieldset legend{
        font-size: 13px;
        border: 1px solid #ccc;
        width: 30%;
        border-radius: 5px;
        background: #f5365c;
        color:#fff;

        padding: 6px;
        -webkit-box-shadow: 3px 3px 2px #ccc;
        -moz-box-shadow: 3px 3px 2px #ccc;
        box-shadow: 3px 3px 2px #ccc;
    }
    fieldset label{
        font-size: 12px;
        color:#4d7bca;
    }

    fieldset label span{
        color:#EF3159;
        font-weight: bold;
    }



</style>
<div class="pagina">

    <div class="row" style="font-family: arial; font-size: 13px;"> 
        <div class="col-md-1">
            <div class="text-left">
                <a href="#" id="voltar" title="Voltar"><i class="fa fa-angle-double-left"></i></a>
            </div>
        </div>  

        <div class="col-md-10">
            <div class="text-righ">
                Curso: <?php echo $_SESSION['cursoM']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                Classe: <?php echo $_SESSION['classeM']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                Turma: <?php echo $_SESSION['turmaM']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                Disciplina: <?php echo $_SESSION['siglaM']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                Ano Lectivo: <?php echo $objGlobals->getAno_lectivo(); ?>
            </div>
        </div>

        <div class="col-md-1">
            <div class="text-right">
            <a href="LOAD_MINIPAUTAS/MINI_PAUTA/mini_Pri_Bas_789_export.php" id="exportar" title="Exportar"><i class="fa fa-file-excel"></i></a>
            &nbsp;&nbsp;
            <a href="#" id="estatistic" title="Estatística"><i class="fa fa-chart-line"></i></a>
            </div>
        </div>

    </div>
    <hr style="padding:0 auto;"/>


    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="3" style="text-align:center;">Dados Pessoais</th>
                            <th colspan="3" style="text-align:center;">1º Trimestre</th>
                            <th colspan="3" style="text-align:center;">2º Trimestre</th>
                            <th colspan="3" style="text-align:center;">3º Trimestre</th>
                            <th colspan="3" style="text-align:center;">Dados Finais</th>
                        </tr>
                        <tr>

                            <th scope="col" style="width: 8%;">Proc</th>
                            <th scope="col">Nome estudante</th>
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
                        $resEs = $objEstudanteDAO->buscarEstudantes_turma($objEstudante, $objTurma);
                        while ($viewEs = $resEs->fetch(PDO::FETCH_OBJ)):
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

                                <td><?php echo $viewEs->id_estudante; ?></td>
                                <td>
                                    <?php echo $viewEs->nome; ?>
                                </td>
                                <td>
                                    <?php echo $viewEs->genero; ?>
                                </td>
                                <!-- 1 trimestre-->
                                <td class="<?php if ($res1->rowCount() >= 1): echo $objEstilos->nota20($view1->mac);
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
                                <td class="<?php if ($res1->rowCount() >= 1): echo $objEstilos->nota20($view1->cpp);
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
                                <td class="<?php if ($res1->rowCount() >= 1): echo $objEstilos->nota20($view1->ct);
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
                                <td class="<?php if ($res2->rowCount() >= 1): echo $objEstilos->nota20($view2->mac);
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
                                <td class="<?php if ($res2->rowCount() >= 1): echo $objEstilos->nota20($view2->cpp);
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
                                <td class="<?php if ($res2->rowCount() >= 1): echo $objEstilos->nota20($view2->ct);
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
                                <td class="<?php if ($res3->rowCount() >= 1): echo $objEstilos->nota20($view3->mac);
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
                                <td class="<?php if ($res3->rowCount() >= 1): echo $objEstilos->nota20($view3->cpp);
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
                                <td class="<?php if ($res3->rowCount() >= 1): echo $objEstilos->nota20($view3->ct);
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
                                <td class="<?php if ($resFi->rowCount() >= 1): echo $objEstilos->nota20($viewFi->cap);
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
                                <td class="<?php if ($resFi->rowCount() >= 1): echo $objEstilos->nota20($viewFi->cpe);
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
                                <td class="<?php if ($resFi->rowCount() >= 1): echo $objEstilos->nota20($viewFi->cf);
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
        </div>
    </div>



</div>






















































