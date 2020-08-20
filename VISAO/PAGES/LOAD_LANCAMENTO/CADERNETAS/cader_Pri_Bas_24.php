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
include_once '../../../../MODELO/Trimestrais.php';
include_once '../../../../DAO/TrimestraisDAO.php';
include_once '../../../../MODELO/Finais.php';
include_once '../../../../DAO/FinaisDAO.php';
include_once '../../../../MODELO/Avaliacao.php';
include_once '../../../../DAO/AvaliacaoDAO.php';
include_once '../../../../MODELO/Prova.php';
include_once '../../../../DAO/ProvaDAO.php';
include_once '../../../../MODELO/Bloqueio.php';
include_once '../../../../DAO/BloqueioDAO.php';
include_once '../../array_bloqueios.php';

$objGlobals = new Globals();
$objTrimestrais = new Trimestrais();
$objTrimestraisDAO = new TrimestraisDAO($_SESSION['dbname']);
$objFinais = new Finais();
$objFinaisDAO = new FinaisDAO($_SESSION['dbname']);
$objAvaliacao = new Avaliacao();
$objAvaliacaoDAO = new AvaliacaoDAO($_SESSION['dbname']);
$objProva = new Prova();
$objProvaDAO = new ProvaDAO($_SESSION['dbname']);

$objTrimestrais->setAno_lectivoT($objGlobals->getAno_lectivo());
$objTrimestrais->setNome_disciplina($_SESSION['nome_disciplinaS']);

$objFinais->setAno_lectivoF($objGlobals->getAno_lectivo());
$objFinais->setNome_disciplina($_SESSION['nome_disciplinaS']);

$objAvaliacao->setAno_lectivoA($objGlobals->getAno_lectivo());
$objAvaliacao->setNome_disciplina($_SESSION['nome_disciplinaS']);

$objProva->setAno_lectivoP($objGlobals->getAno_lectivo());
$objProva->setNome_disciplina($_SESSION['nome_disciplinaS']);
?>
<script>
    $(document).ready(function () {
        $('ul.tabs li').click(function () {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        });

        $("#voltar").click(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            jQuery.ajax({
                type: "POST",
                url: "LOAD_LANCAMENTO/notas.php",
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    $("#carrega_lancamento").text('')
                            .append(data);
                }
            });
            return false;

        });


        $("#cader_1").click(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            jQuery.ajax({
                type: "POST",
                url: "LOAD_LANCAMENTO/CADERNETAS/Controller_cader1.php",
                data: {
                    epoca: "1"
                },
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    $("#carregar_trimestres1").load("LOAD_LANCAMENTO/CADERNETAS/carrega_notas110.php");
                }
            });
            return false;
        });

        $("#cader_2").click(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            jQuery.ajax({
                type: "POST",
                url: "LOAD_LANCAMENTO/CADERNETAS/Controller_cader1.php",
                data: {
                    epoca: "2"
                },
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    $("#carregar_trimestres2").load("LOAD_LANCAMENTO/CADERNETAS/carrega_notas210.php");
                }
            });
            return false;
        });

        $("#cader_3").click(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            jQuery.ajax({
                type: "POST",
                url: "LOAD_LANCAMENTO/CADERNETAS/Controller_cader1.php",
                data: {
                    epoca: "3"
                },
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    $("#carregar_trimestres3").load("LOAD_LANCAMENTO/CADERNETAS/carrega_notas310.php");
                }
            });
            return false;
        });




        $('.avaliacao').on("keypress", function (e) {
            if (e.which == 13) {
                var valor = $(this).val();
                var id_avaliacao = $(this).data('id_avaliacao');
                var coluna = $(this).data('coluna');
                if (valor != "" && valor >= 0 && valor <= 10) {
                    var pagina = "LOAD_LANCAMENTO/CADERNETAS/Controller_Ava.php";
                    var campo = "valor" + coluna;
                    var retorno = update_nota(pagina, id_avaliacao, campo, valor);
                    if (retorno == true) {
                        $(this).css({'background': 'green', 'color': 'white', 'font-weight': 'bold'});
                    }
                } else {
                    $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                }

            }
        });

        $('.prova').on("keypress", function (e) {
            if (e.which == 13) {
                var valor = $(this).val();
                var id_prova = $(this).data('id_prova');
                var coluna = $(this).data('coluna');
                if (valor != "" && valor >= 0 && valor <= 10) {
                    var pagina = "LOAD_LANCAMENTO/CADERNETAS/Controller_Pro.php";
                    var campo = "valor" + coluna;
                    var retorno = update_nota(pagina, id_prova, campo, valor);
                    if (retorno == true) {
                        $(this).css({'background': 'green', 'color': 'white', 'font-weight': 'bold'});
                    }
                } else {
                    $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                }
            }
        });

        $('.cpe').on("keypress", function (e) {
            if (e.which == 13) {
                var valor = $(this).val();
                var id_cpe = $(this).data('id_cpe');
                var coluna = $(this).data('coluna');
                if (valor != "" && valor >= 0 && valor <= 10) {
                    var pagina = "LOAD_LANCAMENTO/CADERNETAS/Controller_finais.php";
                    var campo = "cpe";
                    var retorno = update_nota(pagina, id_cpe, campo, valor);
                    if (retorno == true) {
                        $(this).css({'background': 'green', 'color': 'white', 'font-weight': 'bold'});
                    }
                } else {
                    $(this).css({'background': 'red', 'color': 'white', 'font-weight': 'bold'});
                }
            }
        });

        function update_nota(pagina, id, campo, valor) {
            $.ajax({
                type: "POST",
                url: pagina,
                data: {
                    id: id,
                    campo: campo,
                    valor: valor
                },
                beforeSend: function () {
                },
                success: function (result) {
                }

            });
            return true;
        }

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
                Curso: <?php echo $_SESSION['cursoS']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                Classe: <?php echo $_SESSION['classeS']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                Turma: <?php echo $_SESSION['turmaS']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                Disciplina: <?php echo $_SESSION['siglaS']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
                Ano Lectivo: <?php echo $objGlobals->getAno_lectivo(); ?>
            </div>
        </div>
        <div class="col-md-1">
            <div class="text-right">
                <a href="#" id="caderneta_plus" title="Criar caderneta"><i class="fa fa-reply-all"></i> </a>   
            </div>
        </div>
    </div>
    <hr style="padding:0 auto;"/>
    <div class="tabs-container">

        <ul class="tabs">
            <?php if ($data_bloqueio['trimestre1'] != "off"): ?>
                <li class="tab-link current" data-tab="tab-1"><i class="fa fa-table"></i> 1º TRIMESTRE</li>
            <?php endif; ?>
            <?php if ($data_bloqueio['trimestre2'] != "off"): ?>
                <li class="tab-link" data-tab="tab-2"><i class="fa fa-table"></i> 2º TRIMESTRE</li>
            <?php endif; ?>
            <?php if ($data_bloqueio['trimestre3'] != "off"): ?>
                <li class="tab-link" data-tab="tab-3"><i class="fa fa-table"></i> 3º TRIMESTRE</li>
            <?php endif; ?>
            <?php if ($data_bloqueio['final'] != "off"): ?>
                <li class="tab-link" data-tab="tab-4"><i class="fa fa-table"></i> FINAIS</li>
            <?php endif; ?>
        </ul>
        <?php if ($data_bloqueio['trimestre1'] != "off"): ?>
            <div id="tab-1" class="tab-content current">
                <div class="row">
                    <div class="col-md-12"><div class="text-right"><a href='#' id="cader_1"><i class="fa fa-plus-square" style="cursor:pointer;"></i></a></div></div>
                </div>
                <div class="row" id="carregar_trimestres1">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tblEditavel1A">
                                <thead class="thead-light">
                                    <tr>
                                        <th title="id_avaliacao" scope="col" style="width: 4%;" rowspan="2">Nº</th>
                                        <th title="nome_estudante" scope="col" rowspan="2">Nome estudante</th>
                                        <th colspan="3" style="text-align:center;">Avaliações</th>
                                    </tr>
                                    <tr>
                                        <th title="ava1" scope="col">FEV</th>
                                        <th title="ava2" scope="col">MAR</th>
                                        <th title="ava3" scope="col">ABR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $a1 = 0;
                                    $objAvaliacao->setEpoca(1);
                                    $res1A = $objAvaliacaoDAO->buscarNotas($objAvaliacao, $_SESSION['turmaS']);
                                    while ($view1A = $res1A->fetch(PDO::FETCH_OBJ)):
                                        $a1++;
                                        ?>
                                        <tr>
                                            <td
                                                    title="id_avaliacao"><?php echo $a1; ?></td>
                                            <th title="nome_estudante" scope="row">
                                                <?php echo $view1A->nome; ?>
                                            </th>

                                            <td title="valor1">
                                                <input type="number"
                                                       data-id_avaliacao="<?php echo $view1A->id_avaliacao; ?>"
                                                       style="width: 50px;"
                                                       value="<?php if ($view1A->valor1 != ""): echo $view1A->valor1; else: echo "---"; endif; ?>"
                                                       data-coluna="1" class="avaliacao"/>
                                            </td>
                                            <td title="valor2">
                                                <input type="number"
                                                       data-id_avaliacao="<?php echo $view1A->id_avaliacao; ?>"
                                                       style="width: 50px;"
                                                       value="<?php if ($view1A->valor2 != ""): echo $view1A->valor2; else: echo "---"; endif; ?>"
                                                       data-coluna="2" class="avaliacao"/>
                                            </td>
                                            <td title="valor3">

                                                <input type="number"
                                                       data-id_avaliacao="<?php echo $view1A->id_avaliacao; ?>"
                                                       style="width: 50px;"
                                                       value="<?php if ($view1A->valor3 != ""): echo $view1A->valor3; else: echo "---"; endif; ?>"
                                                       data-coluna="3" class="avaliacao"/>
                                            </td>

                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tblEditavel1P">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="visibility: hidden;" title="id_prova" scope="col" style="width: 4%;" rowspan="2">---</th>
                                        <th title="prova" scope="col">Prova</th>
                                    </tr>
                                    <tr>
                                        <th title="id_prova" scope="col">CPP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $objProva->setEpoca(1);
                                    $res1P = $objProvaDAO->buscarNotas($objProva, $_SESSION['turmaS']);
                                    while ($view1P = $res1P->fetch(PDO::FETCH_OBJ)):
                                        ?>
                                        <tr>
                                            <td style="visibility: hidden;"
                                                title="id_prova"><?php echo $view1P->id_prova; ?></td>
                                            <td title="valor1">
                                                <input type="number"
                                                       data-id_avaliacao="<?php echo $view1P->id_prova; ?>"
                                                       style="width: 50px;"
                                                       value="<?php if ($view1P->valor1 != ""): echo $view1P->valor1; else: echo "---"; endif; ?>"
                                                       data-coluna="1" data-id_prova="<?php echo $view1P->id_prova; ?>"
                                                       class="prova"/>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($data_bloqueio['trimestre2'] != "off"): ?>
            <div id="tab-2" class="tab-content">
                <div class="row">
                    <div class="col-md-12"><div class="text-right"><a href='#' id="cader_2"><i class="fa fa-plus-square" style="cursor:pointer;"></i></a></div></div>
                </div>
                <div class="row" id="carregar_trimestres2">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tblEditavel2A">
                                <thead class="thead-light">
                                    <tr>
                                        <th title="id_avaliacao" scope="col" style="width: 4%;" rowspan="2">Nº</th>
                                        <th title="nome_estudante" scope="col" rowspan="2">Nome estudante</th>
                                        <th colspan="3" style="text-align:center;">Avaliações</th>
                                    </tr>
                                    <tr>
                                        <th title="ava1" scope="col">MAI</th>
                                        <th title="ava2" scope="col">JUN</th>
                                        <th title="ava3" scope="col">JUL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $a2=0;
                                    $objAvaliacao->setEpoca(2);
                                    $res2A = $objAvaliacaoDAO->buscarNotas($objAvaliacao, $_SESSION['turmaS']);
                                    while ($view2A = $res2A->fetch(PDO::FETCH_OBJ)):
                                        $a2++;
                                        ?>
                                        <tr>
                                            <td title="id_avaliacao"><?php echo $a2; ?></td>
                                            <th title="nome_estudante" scope="row">
                                                <?php echo $view2A->nome; ?>
                                            </th>

                                            <td title="valor1">
                                                <input type="number"
                                                       data-id_avaliacao="<?php echo $view2A->id_avaliacao; ?>"
                                                       style="width: 50px;"
                                                       value="<?php if ($view2A->valor1 != ""): echo $view2A->valor1; else: echo "---"; endif; ?>"
                                                       data-coluna="1" class="avaliacao"/>
                                            </td>
                                            <td title="valor2">
                                                <input type="number"
                                                       data-id_avaliacao="<?php echo $view2A->id_avaliacao; ?>"
                                                       style="width: 50px;"
                                                       value="<?php if ($view2A->valor2 != ""): echo $view2A->valor2; else: echo "---"; endif; ?>"
                                                       data-coluna="2" class="avaliacao"/>
                                            </td>
                                            <td title="valor3">
                                                <input type="number"
                                                       data-id_avaliacao="<?php echo $view2A->id_avaliacao; ?>"
                                                       style="width: 50px;"
                                                       value="<?php if ($view2A->valor3 != ""): echo $view2A->valor3; else: echo "---"; endif; ?>"
                                                       data-coluna="3" class="avaliacao"/>
                                            </td>

                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tblEditavel2P">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="visibility: hidden;" title="id_prova" scope="col" style="width: 4%;" rowspan="2">---</th>
                                        <th title="prova" scope="col">Prova</th>
                                    </tr>
                                    <tr>
                                        <th title="id_prova" scope="col">CPP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $objProva->setEpoca(2);
                                    $res2P = $objProvaDAO->buscarNotas($objProva, $_SESSION['turmaS']);
                                    while ($view2P = $res2P->fetch(PDO::FETCH_OBJ)):
                                        ?>
                                        <tr>
                                            <td style="visibility: hidden;"
                                                title="id_prova"><?php echo $view2P->id_prova; ?></td>
                                            <td title="valor1">
                                                <input type="number"
                                                       data-id_prova="<?php echo $view2P->id_prova; ?>"
                                                       style="width: 50px;"
                                                       value="<?php if ($view2P->valor1 != ""): echo $view2P->valor1; else: echo "---"; endif; ?>"
                                                       data-coluna="1" class="prova"/>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($data_bloqueio['trimestre3'] != "off"): ?>
            <div id="tab-3" class="tab-content">
                <div class="row">
                    <div class="col-md-12"><div class="text-right"><a href='#' id="cader_3"><i class="fa fa-plus-square" style="cursor:pointer;"></i></a></div></div>
                </div>
                <div class="row" id="carregar_trimestres3">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tblEditavel3A">
                                <thead class="thead-light">
                                    <tr>
                                        <th title="id_avaliacao" scope="col" style="width: 4%;" rowspan="2">Nº</th>
                                        <th title="nome_estudante" scope="col" rowspan="2">Nome estudante</th>
                                        <th colspan="3" style="text-align:center;">Avaliações</th>
                                    </tr>
                                    <tr>
                                        <th title="ava1" scope="col">AGO</th>
                                        <th title="ava2" scope="col">SET</th>
                                        <th title="ava3" scope="col">OUT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $a3 = 0;
                                    $objAvaliacao->setEpoca(3);
                                    $res3A = $objAvaliacaoDAO->buscarNotas($objAvaliacao, $_SESSION['turmaS']);
                                    while ($view3A = $res3A->fetch(PDO::FETCH_OBJ)):
                                        $a3++;
                                        ?>
                                        <tr>
                                            <td title="id_avaliacao"><?php echo $a3; ?></td>
                                            <th title="nome_estudante" scope="row">
                                                <?php echo $view3A->nome; ?>
                                            </th>

                                            <td title="valor1">
                                                <input type="number"
                                                       data-id_avaliacao="<?php echo $view3A->id_avaliacao; ?>"
                                                       style="width: 50px;"
                                                       value="<?php if ($view3A->valor1 != ""): echo $view3A->valor1; else: echo "---"; endif; ?>"
                                                       data-coluna="1" class="avaliacao"/>
                                            </td>
                                            <td title="valor2">
                                                <input type="number"
                                                       data-id_avaliacao="<?php echo $view3A->id_avaliacao; ?>"
                                                       style="width: 50px;"
                                                       value="<?php if ($view3A->valor2 != ""): echo $view3A->valor2; else: echo "---"; endif; ?>"
                                                       data-coluna="2" class="avaliacao"/>
                                            </td>
                                            <td title="valor3">
                                                <input type="number"
                                                       data-id_avaliacao="<?php echo $view3A->id_avaliacao; ?>"
                                                       style="width: 50px;"
                                                       value="<?php if ($view3A->valor3 != ""): echo $view3A->valor3; else: echo "---"; endif; ?>"
                                                       data-coluna="3" class="avaliacao"/>
                                            </td>

                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tblEditavel3P">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="visibility: hidden;" title="id_prova" scope="col" style="width: 4%;" rowspan="2">---</th>
                                        <th title="prova" scope="col">Prova</th>
                                    </tr>
                                    <tr>
                                        <th title="id_prova" scope="col">CPP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $objProva->setEpoca(3);
                                    $res3P = $objProvaDAO->buscarNotas($objProva, $_SESSION['turmaS']);
                                    while ($view3P = $res3P->fetch(PDO::FETCH_OBJ)):
                                        ?>
                                        <tr>
                                            <td style="visibility: hidden;"
                                                title="id_prova"><?php echo $view3P->id_prova; ?></td>
                                            <td title="valor1">
                                                <input type="number"
                                                       data-id_prova="<?php echo $view3P->id_prova; ?>"
                                                       style="width: 50px;"
                                                       value="<?php if ($view3P->valor1 != ""): echo $view3P->valor1; else: echo "---"; endif; ?>"
                                                       data-coluna="1" class="prova"/>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($data_bloqueio['final'] != "off"): ?>        
            <div id="tab-4" class="tab-content">
                <div class="row">
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tblEditavelCPE">
                                <thead class="thead-light">
                                    <tr>
                                        <th title="id_notasfinais" scope="col" style="width: 4%;">Nº</th>
                                        <th title="nome_estudante" scope="col">Nome estudante</th>
                                        <th title="cpe" scope="col">CPE</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $a4 = 0;
                                    $res4 = $objFinaisDAO->buscarNotas($objFinais, $_SESSION['turmaS']);
                                    while ($view4 = $res4->fetch(PDO::FETCH_OBJ)):
                                        $a4++;
                                        ?>
                                        <tr>
                                            <td title="id_notasfinais"><?php echo $a4; ?></td>
                                            <th title="nome_estudante" scope="row">
                                                <?php echo $view4->nome; ?>
                                            </th>

                                            <td title="cpe">

                                                <input type="number"
                                                       data-id_cpe="<?php echo $view4->id_notasfinais; ?>"
                                                       style="width: 50px;"
                                                       value="<?php if ($view4->data_lancamento != ""): echo $view4->cpe; else: echo "---"; endif; ?>"
                                                       data-coluna="1" class="cpe"/>
                                            </td>
                                        </tr>
                                        <?php
                                    endwhile;
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>


</div>
