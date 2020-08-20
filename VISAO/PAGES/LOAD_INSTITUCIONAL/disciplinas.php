<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/ComponenteDAO.php';
include_once '../../../DAO/DisciplinasDAO.php';
include_once '../../../DAO/CursoDAO.php';
include_once '../../../DAO/EpocaDisDAO.php';
include_once '../../../DAO/DISCursoDAO.php';


$objComponeteDAO = new ComponenteDAO($_SESSION['dbname']);
$res1 = $objComponeteDAO->buscarComponentes();

$objDisciplinasDAO = new DisciplinasDAO($_SESSION['dbname']);
$res2 = $objDisciplinasDAO->buscarDisciplinas();

$objCursoDAO = new CursoDAO($_SESSION['dbname']);
$res3 = $objCursoDAO->buscarCursos();

$objEpocaDisDAO = new EpocaDisDAO($_SESSION['dbname']);
$res4 = $objEpocaDisDAO->buscarEpocas();

$objDISCursoDAO = new DISCursoDAO($_SESSION['dbname']);
$res6 = $objDISCursoDAO->busca();
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

//carregar carrinho de disciplinas escolhidas
        jQuery("#carrega44").load("LOAD_INSTITUCIONAL/carrinho.php");
//fim

//cadastrar disciplinas
        jQuery("#form_cadDisciplina").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_INSTITUCIONAL/Controller_disciplina.php",
                data: dados,
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    if (data == 1) {
                        $("#modal-alertaSucesso").modal("show");
                        $("#resultado_sucesso").text("Feito com sucesso!");
                        jQuery("#form_cadDisciplina")[0].reset();
                    } else {
                        $("#modal-alertaErro").modal("show");
                        $(".resultado_erro").html(data);
                    }
                }
            });
            return false;
        });
//fim

//cadastrar disciplina por curso
        jQuery("#form_cadDisCurso").submit(function (es) {
            es.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados1 = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_INSTITUCIONAL/Controller_disCurso.php",
                data: dados1,
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    if (data == 1) {
                        $("#modal-alertaSucesso").modal("show");
                        $("#resultado_sucesso").text("Feito com sucesso!");
                        jQuery("#form_cadDisCurso")[0].reset();
                        $("#carrega44").load("LOAD_INSTITUCIONAL/carrinho.php");
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

//pesquizar disciplinas
        jQuery("#txtSearch").keyup(function () {
            var disciplina = jQuery("#txtSearch").val();

            jQuery.ajax({
                type: "GET",
                url: "LOAD_INSTITUCIONAL/carrega_disciplina.php",
                data: "disciplina=" + disciplina,
                dataType: "html",
                success: function (dados) {
                    $("#carrega").text('')
                            .append(dados);
                }, });

        });
//fim

//adicionar no carrinho
        jQuery(".adicionar_carrinho").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            var $acao = "add";
            $.ajax({
                type: "POST",
                url: "LOAD_INSTITUCIONAL/session.php",
                data: {'acao': $acao, 'id_disciplina': $item},
                success: function () {
                    $("#carrega44").load("LOAD_INSTITUCIONAL/carrinho.php");
                }
            });
            return false;
        });
//fim

//pesquizar disciplina 2
        $("#txtPesq1").keydown(function () {
            var $nome_disciplina = $("#txtPesq1").val();
            jQuery.ajax({
                type: "GET",
                url: "LOAD_INSTITUCIONAL/busca_disciplina.php",
                data: "nome_disciplina=" + $nome_disciplina,
                dataType: "html",
                success: function (dados) {
                    $("#carrega_dados1").text('')
                            .append(dados);
                }, });
        });
// fim

        //pesquizar dicCurso
        $("#txtPesq2").keydown(function () {
            var $nome_curso = $("#txtPesq2").val();
            jQuery.ajax({
                type: "GET",
                url: "LOAD_INSTITUCIONAL/busca_disCurso.php",
                data: "nome_curso=" + $nome_curso,
                dataType: "html",
                success: function (dados) {
                    $("#carrega_dados2").text('')
                        .append(dados);
                }, });
        });
// fim

//carregar disciplinas
        $("#modal-carregamento").modal("show");
        $("#carrega_dados1").load("LOAD_INSTITUCIONAL/PAGINACAO/load_disciplina.php", function () {
            $("#modal-carregamento").modal("hide");
        });
//fim

        //carregar disCurso
        $("#modal-carregamento").modal("show");
        $("#carrega_dados2").load("LOAD_INSTITUCIONAL/PAGINACAO/load_disCurso.php", function () {
            $("#modal-carregamento").modal("hide");
        });
//fim

//comandos da paginacao discCurso

        $("#registro_anterior1").click(function (e) {
            $("#modal-carregamento").modal("show");
            var c = $("#txtna3").val();
            var i = parseInt(c) - 1;

            $("#carrega_dados2").load("LOAD_INSTITUCIONAL/PAGINACAO/load_disCurso.php?pagina=" + i, function () {
                $("#modal-carregamento").modal("hide");
            });
        });

        $("#registro_seguinte1").click(function (e) {
            $("#modal-carregamento").modal("show");
            var c = $("#txtna3").val();
            var o = parseInt(c) + 1;

            $("#carrega_dados2").load("LOAD_INSTITUCIONAL/PAGINACAO/load_disCurso.php?pagina=" + o, function () {
                $("#modal-carregamento").modal("hide");
            });
        });
        //fim


        //comandos da paginacao

        $("#registro_anterior").click(function (e) {
            $("#modal-carregamento").modal("show");
            var c = $("#txtna").val();
            var i = parseInt(c) - 1;

            $("#carrega_dados1").load("LOAD_INSTITUCIONAL/PAGINACAO/load_disciplina.php?pagina=" + i, function () {
                $("#modal-carregamento").modal("hide");
            });
        });

        $("#registro_seguinte").click(function (e) {
            $("#modal-carregamento").modal("show");
            var c = $("#txtna").val();
            var o = parseInt(c) + 1;

            $("#carrega_dados1").load("LOAD_INSTITUCIONAL/PAGINACAO/load_disciplina.php?pagina=" + o, function () {
                $("#modal-carregamento").modal("hide");
            });
        });
        //fim


        //importar disciplinas
        $("#form_import").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = new FormData();
            dados.append('arquivo', $('input.arquivo').prop('files')[0]);
            console.log(dados);

            jQuery.ajax({
                url: 'LOAD_INSTITUCIONAL/Controller_importdisciplina.php',
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
        border: 1px inset #ffd600;
        width: 100%;
    } 
    fieldset legend{
        font-size: 13px;
        border: 1px solid #ccc;
        width: 30%;
        border-radius: 5px;
        background: #ffd600;
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
        <li class="tab-link current" data-tab="tab-1"><i class="fa fa-search"></i> DISCIPLINAS</li>
        <li class="tab-link" data-tab="tab-2"><i class="fa fa-plus-circle"></i> NOVO</li>
        <li class="tab-link" data-tab="tab-3"><i class="fa fa-upload"></i> IMPORTAR</li>
        <li class="tab-link" data-tab="tab-4"><i class="fa fa-search-plus"></i> GRADE (DISCIPLINA X CLASSES)</li>
        <li class="tab-link" data-tab="tab-5"><i class="fa fa-plus-circle"></i> NOVO</li>
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

                                        <input type="text" name="txtPesq1" class="form-control" placeholder="Pesquisar por nome" id="txtPesq1"/>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="registro_seguinte" title="Seguinte"><i class="fa fa-angle-right"></i></a>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div></div><br/>

        <div class="row">   
            <div class="col-md-12">
                <div class="table-responsive" id="carrega_dados1">

                </div>
            </div></div>
    </div>
    <div id="tab-2" class="tab-content">
        <form name="form_cadDisciplina" action="" method="POST" id="form_cadDisciplina">
            <div class="row">

                <fieldset class="col-md-12">
                    <legend><i class="fa fa-book"></i>&nbsp;&nbsp;Dados da disciplina</legend>
                    <div class="row">   
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Componete</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-building"></i></span>
                                    </div>
                                    <select class="form-control" required="" name="componente">
                                        <option value="">Componente</option>
                                        <?php
                                        while ($view1 = $res1->fetch(PDO::FETCH_OBJ)):
                                            ?>
                                            <option value="<?php echo $view1->id_componente; ?>"><?php echo $view1->componente; ?></option>
                                            <?php
                                        endwhile;
                                        ?>
                                    </select>  
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label><span>*</span> Nome da disciplina</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-bars"></i></span>
                                    </div>
                                    <input type="text" required="" name="nome_disciplina" placeholder="Nome da disciplina" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label><span>*</span> Sígla</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-bookmark"></i></span>
                                    </div>
                                    <input type="text" required="" name="sigla" placeholder="Sígla" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>

                </fieldset>

                <fieldset class="col-md-12">
                    <legend><i class="ni ni-settings"></i>&nbsp;&nbsp;Operações</legend>
                    <div class="row">   
                        <div class="col-md-2">
                            <button type="submit" name="bt_salvarDisciplinas" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
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
            <div class="col-md-12">
                <div class="float-right">
                    <form name="formPesq" method="POST" id="formPesq">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-inline">
                                    <input type="hidden" id="txtna3"/>
                                    <input type="hidden" id="txtna4"/>

                                    <a href="#" id="registro_anterior1" title="Anterior"><i class="fa fa-angle-left"></i></a>&nbsp;

                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        </div>

                                        <input type="text" name="txtPesq2" class="form-control" placeholder="Pesquisar por nome" id="txtPesq2"/>
                                    </div>
                                    &nbsp;&nbsp;<a href="#" id="registro_seguinte1" title="Seguinte"><i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><br/>


        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" id="carrega_dados2">

                </div>
            </div>
        </div>

    </div>
    <div id="tab-5" class="tab-content">
        <form name="form_cadDisCurso" action="" method="POST" id="form_cadDisCurso">

            <div class="row">

                <fieldset class="col-md-12">
                    <legend><i class="fa fa-folder"></i>&nbsp;&nbsp;Dados da grade</legend>
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
                                        while ($view3 = $res3->fetch(PDO::FETCH_OBJ)):
                                            ?>
                                            <option value="<?php echo $view3->id_curso; ?>"><?php echo $view3->nome_curso; ?></option>
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
                                <label><span>*</span> Epoca</label>
                                <div class="input-group input-group-alternative" id="epocaDis">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-inbox"></i></span>
                                    </div>
                                    <select class="form-control" required="" name="epocaDis">
                                        <option value="">Epoca</option>
                                        <?php
                                        while ($view4 = $res4->fetch(PDO::FETCH_OBJ)):
                                            ?>
                                            <option value="<?php echo $view4->id_epocaDis; ?>"><?php echo $view4->tipo; ?></option>
                                        <?php endwhile; ?>
                                    </select>  
                                </div>
                            </div>
                        </div>    

                    </div>

                </fieldset>


                <fieldset class="col-md-12">
                    <legend><i class="ni ni-settings"></i>&nbsp;&nbsp;Operações</legend>
                    <div class="row">   
                        <div class="col-md-2">
                            <button type="submit" name="bt_salvarDisciplinasCurso" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
                        </div>

                        <div class="col-md-2">
                            <button type="reset" class="btn btn-danger"><i class="fa fa-recycle"></i> Cancelar</button>  

                        </div>

                    </div>
                    <br/>
                </fieldset>

                <fieldset class="col-md-12">
                    <legend><i class="fa fa-check"></i>&nbsp;&nbsp;Selecionar disciplinas</legend>
                    <div class="row">   
                        <div class="col-md-12">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" name="txtSearch" id="txtSearch" placeholder="Pesquisar por disciplina"/>
                            </div> 
                        </div>
                        <hr/>
                        <div class="col-md-6">
                            <div class="table-responsive" id="carrega">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Nome disciplina</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-6" id="carrega44">

                        </div>

                    </div>
                    <br/>
                </fieldset>









            </div>



        </form> 
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












