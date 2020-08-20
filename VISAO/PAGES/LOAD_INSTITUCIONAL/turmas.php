<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/EnsinoDAO.php';
include_once '../../../DAO/CursoDAO.php';
include_once '../../../DAO/TurmaDAO.php';
include_once '../../../DAO/TurnoDAO.php';

$objCursoDAO = new CursoDAO($_SESSION['dbname']);
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);
$objTurnoDAO = new TurnoDAO($_SESSION['dbname']);

$res1 = $objCursoDAO->buscarCursos();
$res2 = $objTurnoDAO->buscarTurnos();
$res3 = $objTurmaDAO->buscaTurmas();
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        //carregar tabs
        $('ul.tabs li').click(function () {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        });
        //fim

        //cadastrar turma
        jQuery("#form_cadTurma").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_INSTITUCIONAL/Controller_turma.php",
                data: dados,
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    if (data == 1) {
                        $("#modal-alertaSucesso").modal("show");
                        $("#resultado_sucesso").text("Feito com sucesso!");
                        jQuery("#form_cadTurma")[0].reset();
                    } else {
                        $("#modal-alertaErro").modal("show");
                        $(".resultado_erro").html(data);
                    }
                }
            });
            return false;
        });
//fim

//buscar classe atravez do curso
        jQuery("#curso").change(function () {
            var id_curso = jQuery("#curso").val();
            jQuery("#classe").load("LOAD_INSTITUCIONAL/carrega_classe.php?id_curso=" + id_curso);
        });
//fim


//pesquisar curso
        $("#txtPesq").keydown(function () {
            var $nome_turma = $("#txtPesq").val();
            jQuery.ajax({
                type: "GET",
                url: "LOAD_INSTITUCIONAL/busca_turmas.php",
                data: "nome_turma=" + $nome_turma,
                dataType: "html",
                success: function (dados) {
                    $("#carrega_dados").text('')
                            .append(dados);
                }, });
        });
//fim

//carregar turmas
        $("#modal-carregamento").modal("show");
        $("#carrega_dados").load("LOAD_INSTITUCIONAL/PAGINACAO/load_turma.php", function () {
            $("#modal-carregamento").modal("hide");
        });
//fim

//comandos da paginacao

        $("#registro_anterior").click(function (e) {
            $("#modal-carregamento").modal("show");
            var c = $("#txtna").val();
            var i = parseInt(c) - 1;

            $("#carrega_dados").load("LOAD_INSTITUCIONAL/PAGINACAO/load_turma.php?pagina=" + i, function () {
                $("#modal-carregamento").modal("hide");
            });
        });

        $("#registro_seguinte").click(function (e) {
            $("#modal-carregamento").modal("show");
            var c = $("#txtna").val();
            var o = parseInt(c) + 1;

            $("#carrega_dados").load("LOAD_INSTITUCIONAL/PAGINACAO/load_turma.php?pagina=" + o, function () {
                $("#modal-carregamento").modal("hide");
            });
        });
        //fim

        //gerar pdf
        $("#gerar_pdf").click(function () {
            var dados = $("#txtPesq").val();
            window.location.href = "LOAD_INSTITUCIONAL/DOCS/turmas.php?valor=" + dados;
        });
        //fim


        //localizar turma
        $("#form_localizar").submit(function () {
            var dados = $(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_INSTITUCIONAL/localizar_turma.php",
                data: dados,
                dataType: "html",
                success: function (resposta) {
                    $("#modal-carregamento").modal("hide");
                    $("#carregar_estudantes").text('').append(dados);
                    
                }, beforeSend: function(){
                    $("#modal-carregamento").modal("show");
                }
            });
            return false;
        });
//fim


        //importar turmas
        $("#form_import").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = new FormData();
            dados.append('arquivo', $('input.arquivo').prop('files')[0]);
            console.log(dados);

            jQuery.ajax({
                url: 'LOAD_INSTITUCIONAL/Controller_importturmas.php',
                type: 'POST',
                data: dados,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    if (data == 1) {
                        $("#modal-alertaSucesso").modal("show");
                        $("#resultado_sucesso").text("Feito com sucesso!");
                        jQuery("#form_import")[0].reset();
                    } else {
                        $("#modal-alertaErro").modal("show");
                        $(".resultado_erro").html(data);
                    }
                }
            });
            return false;
        });
//fim

    });
</script>
<style>
    fieldset{
        border: 1px inset #fb6340;
        width: 100%;
    } 
    fieldset legend{
        font-size: 13px;
        border: 1px solid #ccc;
        width: 30%;
        border-radius: 5px;
        background: #fb6340;
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

<div class="tabs-container">

    <ul class="tabs">
        <li class="tab-link current" data-tab="tab-1"><i class="fa fa-search"></i> TURMAS</li>
        <li class="tab-link" data-tab="tab-2"><i class="fa fa-plus-circle"></i> NOVO</li>
        <li class="tab-link" data-tab="tab-3"><i class="fa fa-upload"></i> IMPORTAR</li>
        <li class="tab-link" data-tab="tab-4"><i class="fa fa-paperclip"></i> DETALHES</li>
    </ul>

    <div id="tab-1" class="tab-content current">
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <form name="formPesq" method="POST" id="formPesq">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-inline">
                                    <input type="hidden" id="txtna"/>
                                    <input type="hidden" id="txtna2"/>

                                    <a href="#" id="registro_anterior" title="Anterior"><i class="fa fa-angle-left"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;

                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        </div>

                                        <input type="text" name="txtPesq" class="form-control" placeholder="Pesquisar por nome" id="txtPesq"/>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="registro_seguinte" title="Seguinte"><i class="fa fa-angle-right"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="gerar_pdf" title="Exportar PDF"><i class="fas fas fa-file-pdf"></i></a>&nbsp;&nbsp;
                                    <a href="LOAD_INSTITUCIONAL/EXPORT/export_turma.php" id="gerar_excel" title="Exportar EXCEL"><i class="fas fas fa-file-excel"></i></a>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div></div><br/>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" id="carrega_dados">

                </div>
            </div></div>
    </div>
    <div id="tab-2" class="tab-content">
        <form name="form_cadTurma" action="" method="POST" id="form_cadTurma">
            <div class="row">

                <fieldset class="col-md-12">
                    <legend><i class="fa fa-archive"></i>&nbsp;&nbsp;Dados da turma</legend>
                    <div class="row">   
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Curso</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                    </div>
                                    <select class="form-control" required="" name="curso" id="curso">
                                        <option value="">Curso</option>
                                        <?php
                                        while ($view1 = $res1->fetch(PDO::FETCH_OBJ)):
                                            ?>
                                            <option value="<?php echo $view1->id_curso; ?>"><?php echo $view1->nome_curso; ?></option>
                                            <?php
                                        endwhile;
                                        ?>
                                    </select>  
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Classe</label>
                                <div class="input-group input-group-alternative" id="classe">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-building"></i></span>
                                    </div>
                                    <select class="form-control" required="" name="classe">
                                        <option value="">Classe</option>

                                    </select>  
                                </div>
                            </div>
                        </div>  

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Turno</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-adjust"></i></span>
                                    </div>
                                    <select class="form-control" required="" name="turno">
                                        <option value="">Turno</option>
                                        <?php
                                        while ($view2 = $res2->fetch(PDO::FETCH_OBJ)):
                                            ?>
                                            <option value="<?php echo $view2->id_turno; ?>"><?php echo $view2->turno; ?></option>
                                            <?php
                                        endwhile;
                                        ?>
                                    </select>  
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label><span>*</span> Nome da turma</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-bars"></i></span>
                                    </div>
                                    <input type="text" required="" name="nome_turma" placeholder="Nome da turma" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>  

                <fieldset class="col-md-12">
                    <legend><i class="ni ni-settings"></i>&nbsp;&nbsp;Operações</legend>
                    <div class="row">   
                        <div class="col-md-2">
                            <button type="submit" name="bt_salvarTurma" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
                        </div>

                        <div class="col-md-2">
                            <button type="reset" class="btn btn-danger"><i class="fa fa-recycle"></i> Cancelar</button>  

                        </div>

                    </div>
                    <br/>
                </fieldset>  

            </div>
        </form>
    </div>

    <div id="tab-3" class="tab-content">
        <form name="form_import" id="form_import" method="POST" enctype="multipart/form-data">
            <fieldset class="col-md-12">
                <legend><i class="fa fa-upload"></i> Ficheiros *xml</legend>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-file-import"></i></span>
                            </div>

                            <input type="file" name="arquivo" class="arquivo" required=""/>
                        </div>
                    </div>
                </div>

            </fieldset>

            <fieldset class="col-md-12">
                <legend><i class="ni ni-settings"></i>&nbsp;&nbsp;Operações</legend>
                <div class="row">
                    <div class="col-md-2">
                        <button type="submit" name="salvar" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
                    </div>

                    <div class="col-md-2">
                        <button type="reset" class="btn btn-danger"><i class="fa fa-recycle"></i> Cancelar</button>

                    </div>

                </div>
                <br/>
            </fieldset>

        </form>
    </div>

    <div id="tab-4" class="tab-content">
        <div class="row">
            <div class="col">
                <form name="form_localizar" id="form_localizar" action="#" method="POST">
                    <fieldset class="col-md-12">
                        <legend><i class="fa fa-search"></i>&nbsp;&nbsp; Localizar turma</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-building"></i></span>
                                        </div>
                                        <select name="id_turma" class="form-control" required="" id="id_turma">
                                            <option value="">Turma</option>  
                                            <?php
                                            while ($view3 = $res3->fetch(PDO::FETCH_OBJ)):
                                                ?>
                                                <option value="<?php echo $view3->id_turma; ?>"><?php echo $view3->turma; ?></option>
                                                <?php
                                            endwhile;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                                        </div>
                                        <input type="text" name="ano_lectivo" id="ano_lectivo" class="form-control" required="" value="<?php echo date("Y"); ?>" placeholder="Ano lectivo">

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <button type="submit" name="b_turma" id="b_turma" class="btn btn-success"><i class="fa fa-search"></i></button>

                                </div>
                            </div>

                        </div>
                    </fieldset>
                </form>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12" id="carregar_estudantes">

            </div>
        </div>
    </div>


</div>


<!-- modal-->
<!-- modal erro-->
<div class="modal" id="modal-alertaErro" data-backdrop="static" >
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header">
                <div class="resultado_erro" style="width:100%;"></div>
            </div>
            <!-- Corpo do Modal -->
            <div class="modal-body">
                <img src="../../ACTIVOS/img/theme/error.png" style="width: 150px; height: 150px; margin: auto;position: absolute; top: 0; left: 0; bottom: 0; right: 0;"/>

            </div>
            <!-- Rodapé do Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- fim-->

<!-- modal sucesso--> 
<div class="modal" id="modal-alertaSucesso" data-backdrop="static" >
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header">
                <div id="resultado_sucesso" class="alert alert-success" style="width:100%"></div>
            </div>
            <!-- Corpo do Modal -->
            <div class="modal-body">
                <img src="../../ACTIVOS/img/theme/success.png" style="width: 130px; height: 130px; margin: auto;position: absolute; top: 0; left: 0; bottom: 0; right: 0;"/>

            </div>
            <!-- Rodapé do Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- fim--> 
<!-- fim-->











































