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
include_once '../../../../MODELO/Trimestrais.php';
include_once '../../../../DAO/TrimestraisDAO.php';
include_once '../../../../MODELO/Finais.php';
include_once '../../../../DAO/FinaisDAO.php';

$objGlobals = new Globals();
$objEstilos = new Estilos();
$objTrimestrais = new Trimestrais();
$objTrimestraisDAO = new TrimestraisDAO($_SESSION['dbname']);
$objFinais = new Finais();
$objFinaisDAO = new FinaisDAO($_SESSION['dbname']);

$objTrimestrais->setAno_lectivoT($objGlobals->getAno_lectivo());
$objTrimestrais->setNome_disciplina($_SESSION['nome_disciplinaM']);

$objFinais->setAno_lectivoF($objGlobals->getAno_lectivo());
$objFinais->setNome_disciplina($_SESSION['nome_disciplinaM']);

$pagina_volta = addslashes(htmlspecialchars($_POST['pagina']));


//primeiro trimestre Estatistica Geral
$contador_negativas1T = 0;
$contador_positivas1T = 0;
$contador_negativas1TF = 0;
$contador_positivas1TF = 0;
$contador_negativas1TM = 0;
$contador_positivas1TM = 0;
$contador_lancados1T = 0;
$contador_lancados1TF = 0;
$contador_lancados1TM = 0;
$objTrimestrais->setEpoca(1);

//geral
$res1T = $objTrimestraisDAO->buscarNotas($objTrimestrais, $_SESSION['turmaM']);
while ($view1T = $res1T->fetch(PDO::FETCH_OBJ)):
    if ($view1T->data_lancamento != ""):
        $res21T = $objEstilos->nota10($view1T->ct);
        if ($res21T == "muito_bom"):
            $contador_positivas1T ++;
        elseif ($res21T == "mau"):
            $contador_negativas1T ++;
        endif;
        $contador_lancados1T ++;
    endif;
endwhile;

// genero femenino
$res1TF = $objTrimestraisDAO->buscarNotas_femenino($objTrimestrais, $_SESSION['turmaM']);
while ($view1TF = $res1TF->fetch(PDO::FETCH_OBJ)):
    if ($view1TF->data_lancamento != ""):
        $res21TF = $objEstilos->nota10($view1TF->ct);
        if ($res21TF == "muito_bom"):
            $contador_positivas1TF ++;
        elseif ($res21TF == "mau"):
            $contador_negativas1TF ++;
        endif;
        $contador_lancados1TF ++;
    endif;
endwhile;

// genero masculino
$res1TM = $objTrimestraisDAO->buscarNotas_masculino($objTrimestrais, $_SESSION['turmaM']);
while ($view1TM = $res1TM->fetch(PDO::FETCH_OBJ)):
    if ($view1TM->data_lancamento != ""):
        $res21TM = $objEstilos->nota10($view1TM->ct);
        if ($res21TM == "muito_bom"):
            $contador_positivas1TM ++;
        elseif ($res21TM == "mau"):
            $contador_negativas1TM ++;
        endif;
        $contador_lancados1TM ++;
    endif;
endwhile;
//fim primeiro trimestre Estatistica geral

//segundo trimestre Estatistica Geral
$contador_negativas2T = 0;
$contador_positivas2T = 0;
$contador_negativas2TF = 0;
$contador_positivas2TF = 0;
$contador_negativas2TM = 0;
$contador_positivas2TM = 0;
$contador_lancados2T = 0;
$contador_lancados2TF = 0;
$contador_lancados2TM = 0;
$objTrimestrais->setEpoca(2);
//geral
$res2T = $objTrimestraisDAO->buscarNotas($objTrimestrais, $_SESSION['turmaM']);
while ($view2T = $res2T->fetch(PDO::FETCH_OBJ)):
    if ($view2T->data_lancamento != ""):
        $res22T = $objEstilos->nota10($view2T->ct);
        if ($res22T == "muito_bom"):
            $contador_positivas2T ++;
        elseif ($res22T == "mau"):
            $contador_negativas2T ++;
        endif;
        $contador_lancados2T ++;
    endif;
endwhile;

//genero femenino
$res2TF = $objTrimestraisDAO->buscarNotas_femenino($objTrimestrais, $_SESSION['turmaM']);
while ($view2TF = $res2TF->fetch(PDO::FETCH_OBJ)):
    if ($view2TF->data_lancamento != ""):
        $res22TF = $objEstilos->nota10($view2TF->ct);
        if ($res22TF == "muito_bom"):
            $contador_positivas2TF ++;
        elseif ($res22TF == "mau"):
            $contador_negativas2TF ++;
        endif;
        $contador_lancados2TF ++;
    endif;
endwhile;

//genero masculino
$res2TM = $objTrimestraisDAO->buscarNotas_masculino($objTrimestrais, $_SESSION['turmaM']);
while ($view2TM = $res2TM->fetch(PDO::FETCH_OBJ)):
    if ($view2TM->data_lancamento != ""):
        $res22TM = $objEstilos->nota10($view2TM->ct);
        if ($res22TM == "muito_bom"):
            $contador_positivas2TM ++;
        elseif ($res22TM == "mau"):
            $contador_negativas2TM ++;
        endif;
        $contador_lancados2TM ++;
    endif;
endwhile;

//fim segundo trimestre Estatistica geral

//terceiro trimestre Estatistica Geral
$contador_negativas3T = 0;
$contador_positivas3T = 0;
$contador_negativas3TF = 0;
$contador_positivas3TF = 0;
$contador_negativas3TM = 0;
$contador_positivas3TM = 0;
$contador_lancados3T = 0;
$contador_lancados3TF = 0;
$contador_lancados3TM = 0;
$objTrimestrais->setEpoca(3);
//geral
$res3T = $objTrimestraisDAO->buscarNotas($objTrimestrais, $_SESSION['turmaM']);
while ($view3T = $res3T->fetch(PDO::FETCH_OBJ)):
    if ($view3T->data_lancamento != ""):
        $res23T = $objEstilos->nota10($view3T->ct);
        if ($res23T == "muito_bom"):
            $contador_positivas3T ++;
        elseif ($res23T == "mau"):
            $contador_negativas3T ++;
        endif;
        $contador_lancados3T ++;
    endif;
endwhile;
//genero femenino
$res3TF = $objTrimestraisDAO->buscarNotas_femenino($objTrimestrais, $_SESSION['turmaM']);
while ($view3TF = $res3TF->fetch(PDO::FETCH_OBJ)):
    if ($view3TF->data_lancamento != ""):
        $res23TF = $objEstilos->nota10($view3TF->ct);
        if ($res23TF == "muito_bom"):
            $contador_positivas3TF ++;
        elseif ($res23TF == "mau"):
            $contador_negativas3TF ++;
        endif;
        $contador_lancados3TF ++;
    endif;
endwhile;
//genero masculino
$res3TM = $objTrimestraisDAO->buscarNotas_masculino($objTrimestrais, $_SESSION['turmaM']);
while ($view3TM = $res3TM->fetch(PDO::FETCH_OBJ)):
    if ($view3TM->data_lancamento != ""):
        $res23TM = $objEstilos->nota10($view3TM->ct);
        if ($res23TM == "muito_bom"):
            $contador_positivas3TM ++;
        elseif ($res23TM == "mau"):
            $contador_negativas3TM ++;
        endif;
        $contador_lancados3TM ++;
    endif;
endwhile;
//fim terceiro trimestre Estatistica geral


?>
<script>
    $(document).ready(function () {

        $("#voltar").click(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var $pagina_volta = $("#pagina_volta").val();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_MINIPAUTAS/MINI_PAUTA/"+$pagina_volta,
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    $("#carrega_mini").text('')
                            .append(data);
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
       

    </div>
    <hr style="padding:0 auto;"/>
    <input type="hidden" name="pagina_volta" id="pagina_volta"  value="<?php echo $pagina_volta; ?>" />

    <div class="row">
        <div class="col-md-12">
         <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th rowspan="2" style="text-align:center;">Tipo</th>
                            <th colspan="3" style="text-align:center;">1º Trimestre</th>
                            <th colspan="3" style="text-align:center;">2º Trimestre</th>
                            <th colspan="3" style="text-align:center;">3º Trimestre</th>
                        </tr>
                        <tr>

                            <th scope="col">M</th>
                            <th scope="col">F</th>
                            <th>Geral</th>

                            <th scope="col">M</th>
                            <th scope="col">F</th>
                            <th>Geral</th>

                            <th scope="col">M</th>
                            <th scope="col">F</th>
                            <th>Geral</th>

                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="badge badge-dot"><i class="bg-blue"></i> <span class="mb-0 text-sm">POSITIVAS (+)</span>
                                    </div>
                                </div>
                            </td>

                            <td><?php echo $contador_positivas1TM;?></td>
                            <td><?php echo $contador_positivas1TF;?></td>
                            <td><?php echo $contador_positivas1T;?></td>

                            <td><?php echo $contador_positivas2TM;?></td>
                            <td><?php echo $contador_positivas2TF;?></td>
                            <td><?php echo $contador_positivas2T;?></td>

                            <td><?php echo $contador_positivas3TM;?></td>
                            <td><?php echo $contador_positivas3TF;?></td>
                            <td><?php echo $contador_positivas3T;?></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="badge badge-dot"><i class="bg-danger"></i> <span class="mb-0 text-sm">NEGATIVAS (-)</span>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $contador_negativas1TM;?></td>
                            <td><?php echo $contador_negativas1TF;?></td>
                            <td><?php echo $contador_negativas1T;?></td>

                            <td><?php echo $contador_negativas2TM;?></td>
                            <td><?php echo $contador_negativas2TF;?></td>
                            <td><?php echo $contador_negativas2T;?></td>

                            <td><?php echo $contador_negativas3TM;?></td>
                            <td><?php echo $contador_negativas3TF;?></td>
                            <td><?php echo $contador_negativas3T;?></td>
                        </tr> 
                        
                               <tr>
                            <td>
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="badge badge-dot"><i class="bg-success"></i> <span class="mb-0 text-sm">LANÇAMENTOS</span>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $contador_lancados1TM;?></td>
                            <td><?php echo $contador_lancados1TF;?></td>
                            <td><?php echo $contador_lancados1T;?></td>

                            <td><?php echo $contador_lancados2TM;?></td>
                            <td><?php echo $contador_lancados2TF;?></td>
                            <td><?php echo $contador_lancados2T;?></td>

                            <td><?php echo $contador_lancados3TM;?></td>
                            <td><?php echo $contador_lancados3TF;?></td>
                            <td><?php echo $contador_lancados3T;?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        
        <hr/>
        <div class="col-md-12">
            <!-- grafico -->
            <script type="text/javascript">
                $(function () {
                    $('#exibir_grafico').highcharts({
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Disciplina: <?php echo $_SESSION['nome_disciplinaM'];?> | Turma: <?php echo $_SESSION['turmaM'];?> | Ano lectivo: <?php echo $objGlobals->getAno_lectivo();?> '
                        },
                        subtitle: {
                            text: 'Data: <?php echo date("d-m-Y");?>'
                        },
                        xAxis: {
                            categories: ['Masculino', 'Femenino', 'Geral'],
                            title: {
                                text: null
                            }
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Nº (quantidade)',
                                align: 'high'
                            },
                            labels: {
                                overflow: 'justify'
                            }
                        },
                        tooltip: {
                            valueSuffix: ' '
                        },
                        plotOptions: {
                            bar: {
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -40,
                            y: 100,
                            floating: true,
                            borderWidth: 1,
                            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                            shadow: true
                        },
                        credits: {
                            enabled: false
                        },
                        series: [{
                                name: 'Positivas',
                                data: [<?php echo ($contador_positivas1TM + $contador_positivas2TM + $contador_positivas3TM); ?>, 
                                    <?php echo ($contador_positivas1TF + $contador_positivas2TF + $contador_positivas3TF); ?>, 
                                <?php echo ($contador_positivas1T + $contador_positivas2T + $contador_positivas3T); ?>],
                                 color: '#5e72e4'
                            }, {
                                name: 'Negativas',
                                data: [<?php echo ($contador_negativas1TM + $contador_negativas2TM + $contador_negativas3TM); ?>, 
                                    <?php echo ($contador_negativas1TF + $contador_negativas2TF + $contador_negativas3TF); ?>, 
                                <?php echo ($contador_negativas1T + $contador_negativas2T + $contador_negativas3T); ?>],
                                 color: '#f5365c'
                            }, {
                                name: 'Lançamentos',
                                data: [
                                    <?php echo ($contador_lancados1TM + $contador_lancados2TM + $contador_lancados3TM); ?>, 
                                    <?php echo ($contador_lancados1TF + $contador_lancados2TF + $contador_lancados3TF); ?>, 
                                <?php echo ($contador_lancados1T + $contador_lancados2T + $contador_lancados3T); ?>],
                                 color: '#2dce89'
                            }]
                    });
                });
            </script>
            
            
            <!-- grafico -->
            <div id="exibir_grafico" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
        </div>
        
    </div>



</div>





