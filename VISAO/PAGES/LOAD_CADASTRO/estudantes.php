<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/ProvinciaDAO.php';
include_once '../../../DAO/CursoDAO.php';
include_once '../../../DAO/EscalaoDAO.php';
include_once '../../../DAO/EstudanteDAO.php';

$objProvinciaDAO = new ProvinciaDAO($_SESSION['dbname']);
$res = $objProvinciaDAO->buscarProvincias();
$objCursoDAO = new CursoDAO($_SESSION['dbname']);
$res1 = $objCursoDAO->buscarCursos();
$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);
$res2 = $objEstudanteDAO->buscar_estudante();

?>
<script>
    $(document).ready(function () {
        // componente tabs
        $('ul.tabs li').click(function () {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        });
//fim

//carregar estudantes
        $("#modal-carregamento").modal("show");
        $("#carregar_dados").load("LOAD_CADASTRO/PAGINACAO/load_estudante.php", function () {
            $("#modal-carregamento").modal("hide");
        });
//fim

//salvar estudante
        jQuery("#form_cadEstudante").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_CADASTRO/Controller_estudante.php",
                data: dados,
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    if (data == 1) {
                        $("#modal-alertaSucesso").modal("show");
                        $("#resultado_sucesso").text("Feito com sucesso!");
                        jQuery("#form_cadEstudante")[0].reset();
                    } else {
                        $("#modal-alertaErro").modal("show");
                        $(".resultado_erro").html(data);
                    }
                }
            });
            return false;
        });
//fim

//buscar municipio atraves da provincia
        $("#id_provincia").change(function () {
            var id_provincia = $("#id_provincia").val();
            $("#carrega_muni").load("LOAD_CADASTRO/carrega_muni.php?id_provincia=" + id_provincia);
        });
//fim

//buscar classes atravez do curso
        jQuery("#curso").change(function () {
            var id_curso = jQuery("#curso").val();
            jQuery("#classe").load("LOAD_CADASTRO/carrega_classe.php?id_curso=" + id_curso);
        });



        jQuery("#curso2").change(function () {
            var id_curso = jQuery("#curso2").val();
            jQuery("#classe2").load("LOAD_CADASTRO/carrega_classe.php?id_curso=" + id_curso);
        });
//fim

//pesquisar na tabela
        $("#txtPesq").keydown(function () {
            var $nome_estudante = $("#txtPesq").val();
            jQuery.ajax({
                type: "GET",
                url: "LOAD_CADASTRO/carrega_estudante.php",
                data: "nome_estudante=" + $nome_estudante,
                dataType: "html",
                success: function (dados) {
                    $("#carregar_dados").text('')
                            .append(dados);
                }, });
        });

//fim

//buscar estudantes por curso
        $("#formPesqEstudantes").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_CADASTRO/estudanteCurso.php",
                data: dados,
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    $("#estudantesCurso").text('')
                            .append(data);
                }
            });
            return false;
        });
// fim

//importar estudantes
        $("#form_import").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = new FormData();
            dados.append('arquivo', $('input.arquivo').prop('files')[0]);
            console.log(dados);

            jQuery.ajax({
                url: 'LOAD_CADASTRO/Controller_importestudante.php',
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

//comandos da paginacao

        $("#registro_anterior").click(function (e) {
            $("#modal-carregamento").modal("show");
            var c = $("#txtna").val();
            var i = parseInt(c) - 1;

            $("#carregar_dados").load("LOAD_CADASTRO/PAGINACAO/load_estudante.php?pagina=" + i, function () {
                $("#modal-carregamento").modal("hide");
            });
        });

        $("#registro_seguinte").click(function (e) {
            $("#modal-carregamento").modal("show");
            var c = $("#txtna").val();
            var o = parseInt(c) + 1;

            $("#carregar_dados").load("LOAD_CADASTRO/PAGINACAO/load_estudante.php?pagina=" + o, function () {
                $("#modal-carregamento").modal("hide");
            });
        });
        //fim

        //gerar pdf
        $("#gerar_pdf").click(function () {
            var dados = $("#txtPesq").val();
            window.location.href = "LOAD_CADASTRO/DOCS/estudantes.php?valor=" + dados;
        });
        //fim

        //salvar confirmacao
        $(".fr_confirm").submit(function () {
            alert("olamundo");
            return false;
        });
        //

    });
</script>
<style>
    fieldset{
        border: 1px inset #ffd600;
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
        <li class="tab-link current" data-tab="tab-1"><i class="fa fa-search"></i> ESTUDANTES</li>
        <li class="tab-link" data-tab="tab-2"><i class="fa fa-plus-circle"></i> NOVO</li>
        <li class="tab-link" data-tab="tab-3"><i class="fa fa-address-book"></i> DETALHES</li>
        <li class="tab-link" data-tab="tab-4"><i class="fa fa-upload"></i> IMPORTAR</li>
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
                                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="gerar_pdf" title="Exportar PDF"><i class="fas fas fa-file-pdf"></i></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" id="carregar_dados">

                </div>
            </div>
        </div>
    </div>

    <div id="tab-2" class="tab-content">
        <form name="form_cadEstudante" action="" method="POST" id="form_cadEstudante">

            <div class="row">
                <fieldset class="col-md-12">
                    <legend><i class="fa fa-user"></i>&nbsp;&nbsp;Dados Pessoais </legend>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Nome Completo </label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-atom"></i></span>
                                    </div>

                                    <input type="text" name="nome" class="form-control" placeholder="Nome completo" required=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Data de Nascimento </label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>

                                    <input type="date" name="data_nascimento" class="form-control" required="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Genero </label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-clone"></i></span>
                                    </div>

                                    <select name="genero" class="form-control" required="">
                                        <option value="">Genero</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Estado civíl </label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-satisfied"></i></span>
                                    </div>

                                    <select name="estado_civil" class="form-control" required="">
                                        <option value="">Estado civíl</option>
                                        <option value="Solteiro(a)">Solteiro(a)</option>
                                        <option value="Casado(a)">Casado(a)</option>
                                        <option value="Viúvo(a)">Viúvo(a)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Província </label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-home"></i></span>
                                    </div>

                                    <select name="id_provincia" class="form-control" required="" id="id_provincia">
                                        <option value="">Província</option>
                                        <?php
                                        while ($view = $res->fetch(PDO::FETCH_OBJ)):
                                            ?>
                                            <option value="<?php echo $view->id_provincia; ?>"><?php echo $view->provincia; ?></option>
                                            <?php
                                        endwhile;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label><span>*</span> Município</label>
                            <div class="input-group input-group-alternative" id="carrega_muni">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-city"></i></span>
                                </div>

                                <select name="id_municipio" id="municipio" class="form-control" required="">
                                    <option value="">Município</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <label><span></span> Comuna</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-compass"></i></span>
                                </div>

                                <input type="text" name="comuna" class="form-control" placeholder="Comuna"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label><span></span> Telefone</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>

                                <input type="tel" name="telefone" class="form-control" placeholder="Telefone"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Nº B.I ou Certidão</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-passport"></i></span>
                                </div>

                                <input type="text" name="bilhete" class="form-control" placeholder="Nº B.I ou Certidão"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label><span></span>Data de Emissão</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>

                                <input type="date" name="data_emissao" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label><span></span>Local de Emissão</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                                </div>

                                <input type="text" name="local_emissao" class="form-control" placeholder="Local de Emissão"/>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <label><span></span>Nome do Pai</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-male"></i></span>
                                </div>

                                <input type="text" name="pai" class="form-control" placeholder="Nome do Pai"/>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <label><span></span>Nome da Mãe</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-female"></i></span>
                                </div>

                                <input type="text" name="mae" class="form-control" placeholder="Nome da Mãe"/>

                            </div>
                            <br/>
                        </div>
                    </div>
                </fieldset>


                <fieldset class="col-md-12">
                    <legend><i class="fa fa-graduation-cap"></i>&nbsp;&nbsp;Dados Acadêmicos </legend>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Curso </label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                    </div>
                                    <select name="id_curso" class="form-control" required="" id="curso">
                                        <option value="">Curso</option>
                                        <?php
                                        while ($view1 = $res1->fetch(PDO::FETCH_OBJ)):
                                            ?>
                                            <option value="<?php echo $view1->id_curso; ?>"><?php echo $view1->nome_curso; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Classe </label>
                                <div class="input-group input-group-alternative" id="classe">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-building"></i></span>
                                    </div>

                                    <select name="id_classe" class="form-control" required="">
                                        <option value="">Classe</option>

                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label><span>*</span> Ano lectivo</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                                </div>
                                <input type="text" name="ano_lectivo" class="form-control" placeholder="Ano lectivo" required=""/>
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
            </div>

        </form>
    </div>

    <div id="tab-3" class="tab-content">
        <form name="formPesqEstudantes" method="POST" id="formPesqEstudantes">
            <div class="row">
                <fieldset class="col-md-12">

                    <legend><i class="fa fa-graduation-cap"></i>&nbsp;&nbsp;Buscar estudantes </legend>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">

                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                    </div>
                                    <select name="id_curso" class="form-control" required="" id="curso2">
                                        <option value="">Curso</option>
                                        <?php
                                        $res3 = $objCursoDAO->buscarCursos();
                                        while ($view2 = $res3->fetch(PDO::FETCH_OBJ)):
                                            ?>
                                            <option value="<?php echo $view2->id_curso; ?>"><?php echo $view2->nome_curso; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">

                                <div class="input-group input-group-alternative" id="classe2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-building"></i></span>
                                    </div>

                                    <select name="id_classe" class="form-control" required="">
                                        <option value="">Classe</option>

                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>

                                    <input type="number" name="i_inicio" class="form-control" placeholder="I. Inicio" required=""/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>

                                    <input type="number" name="i_fim" class="form-control" placeholder="I. Fim" required=""/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                                    </div>

                                    <input type="text" name="ano_lectivo" class="form-control" placeholder="Ano lectivo" required=""/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <div class="form-group">
                                <button type="submit" name="btBusc" class="btn btn-success"><i class="fa fa-search"></i></button>

                            </div>
                        </div>
                    </div>
                </fieldset>

            </div>
        </form>

        <form id="form_modifiEstudante" method="POST">
            <div class="row">
                <fieldset class="col-md-12">
                    <legend><i class="fa fa-list"></i>&nbsp;&nbsp;Estudantes </legend> 
                    <div class="row" id="estudantesCurso">

                    </div>
                </fieldset>
            </div>
        </form>
    </div>

    <div id="tab-4" class="tab-content">
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


<!-- Modal -->
<!-- modal permicao-->
<div class="modal fade" id="modal_detalhes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <form class="fr_confirm" name="fr_confirm" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmar Matrícula:: <span id="carrega_nomeD"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <fieldset class="col-md-12">
                            <legend><i class="fa fa-graduation-cap"></i>&nbsp;&nbsp;Dados Acadêmicos </legend>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><span>*</span> Curso </label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                            </div>
                                            <select name="id_curso2" class="form-control" required="" id="id_curso2">
                                                <option value="">Curso</option>
                                                <?php
                                                $res4 = $objCursoDAO->buscarCursos();
                                                while ($view2 = $res4->fetch(PDO::FETCH_OBJ)):
                                                    ?>
                                                    <option value="<?php echo $view2->id_curso; ?>"><?php echo $view2->nome_curso; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><span>*</span> Turma </label>
                                        <div class="input-group input-group-alternative" id="turma2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-building"></i></span>
                                            </div>

                                            <select name="id_turma2" class="form-control" required="">
                                                <option value="">Turma</option>

                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label><span>*</span> Ano lectivo</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                                        </div>
                                        <input type="text" name="ano_lectivo2" class="form-control" placeholder="Ano lectivo" required=""/>
                                    </div>
                                </div>


                            </div>
                        </fieldset>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" name="bt_saveConfirmacao" id="bt_saveConfirmacao">Salvar mudanças</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--fim-->

<!-- modal editar-->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Estudante :: <span id="carrega_nomeE"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ola mundo
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar mudanças</button>
            </div>
        </div>
    </div>
</div>
<!--fim-->
<!-- fim-->















