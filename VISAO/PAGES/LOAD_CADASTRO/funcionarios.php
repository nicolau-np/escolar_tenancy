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
include_once '../../../DAO/CargoDAO.php';
include_once '../../../DAO/EscalaoDAO.php';
include_once '../../../DAO/FuncionarioDAO.php';
include_once '../../../DAO/TurmaDAO.php';
include_once '../../../DAO/SalaDAO.php';
include_once '../../../DAO/DirectorDAO.php';


$objProvinciaDAO = new ProvinciaDAO($_SESSION['dbname']);
$res = $objProvinciaDAO->buscarProvincias();
$objCargoDAO = new CargoDAO($_SESSION['dbname']);
$res1 = $objCargoDAO->buscarCargos();
$objEscalaoDAO = new EscalaoDAO($_SESSION['dbname']);
$res2 = $objEscalaoDAO->buscarEscaloes();
$objFuncionarioDAO = new FuncionarioDAO($_SESSION['dbname']);
$res3 = $objFuncionarioDAO->buscar_funcionarios();
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);
$res4 = $objTurmaDAO->buscaTurmas();
$objSalaDAO = new SalaDAO($_SESSION["dbname"]);
$res6 = $objSalaDAO->buscarsalas();
$objDirectorDAO = new DirectorDAO($_SESSION['dbname']);
$res7 = $objDirectorDAO->buscar_directores();
?>

<script>
    $(document).ready(function () {
        //carregar tabs
        $('ul.tabs li').click(function () {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        });
//fim

//cadastrar funcionario
        jQuery("#form_cadFuncionario").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_CADASTRO/Controller_funcionario.php",
                data: dados,
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    if (data == 1) {
                        $("#modal-alertaSucesso").modal("show");
                        $("#resultado_sucesso").text("Feito com sucesso!");
                        jQuery("#form_cadFuncionario")[0].reset();
                    } else {
                        $("#modal-alertaErro").modal("show");
                        $(".resultado_erro").html(data);
                    }
                }
            });
            return false;
        });
//fim
//buscar municipio com a provincia
        $("#id_provincia").change(function () {
            var id_provincia = $("#id_provincia").val();
            $("#carrega_muni").load("LOAD_CADASTRO/carrega_muni.php?id_provincia=" + id_provincia);
        });
//fim

//pesquisar funcionario
        $("#txtPesq").keydown(function () {
            var $nome_funcionario = $("#txtPesq").val();
            jQuery.ajax({
                type: "GET",
                url: "LOAD_CADASTRO/carrega_funcionario.php",
                data: "nome_funcionario=" + $nome_funcionario,
                dataType: "html",
                success: function (dados) {
                    $("#carregar_dados").text('')
                        .append(dados);
                },
            });
        });
//fim

//modal de horario
        $(".bt_horario").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            $("#modal_horario").modal("show");
            $("#ID_funcionario").val($item);
            jQuery.ajax({
                type: "POST",
                url: "LOAD_CADASTRO/buscar_nomeFunc.php",
                data: "id_funcionario=" + $item,
                success: function (data) {
                    $("#carrega_nomeH").text(data);
                    $("#iu").hide("fast");
                    $(".iu").hide("fast");
                }
            });
            return false;
        });
//fim

//modal editar
        $(".bt_editar").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            $("#modal_editar").modal("show");
            $("#carrega_nomeE").text($item);
        });
//fim

//modal director
        $(".bt_director").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            $("#modal_director").modal("show");
            $("#id_funcionarioDir").val($item);
            $("#carrega_nomeD").text($item);
        });
//fim

//carregar horas apartir da turma
        $("#id_turma").change(function () {
            var id_turma = $("#id_turma").val();
            $("#id_disciplina").load("LOAD_CADASTRO/carrega_disciplina.php?id_turma=" + id_turma);
        });
//fim

//cadastrar horario
        $("#bt_Cadhorario").click(function (e) {
            var dados = jQuery("#form_cadHorario").serialize();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_CADASTRO/Controller_horario.php",
                data: dados,
                success: function (data) {
                    if (data == 1) {
                        $(".iu").hide("fast");
                        $("#iu").hide("fast");
                        $("#iu").show("fast");
                        $("#iu").text("Feito com sucesso!");
                        jQuery("#form_cadHorario")[0].reset();
                    } else {
                        $("#iu").hide("fast");
                        $(".iu").hide("fast");
                        $(".iu").show("fast");
                        $(".iu").html(data);
                    }
                }
            });
            return false;

        });
//fim

//cadastrar director
        $("#btcad_director").click(function (e) {
            //cadastrar director de turma
            var dados = $("#form_director").serialize();
            $.ajax({
                type: "POST",
                url: "LOAD_CADASTRO/Controller_director.php",
                data: dados,
                success: function (resposta) {
                    if (resposta == 1) {
                        alert("Feito com successo");
                        jQuery("#form_director")[0].reset();
                    } else if (resposta == 0) {
                        alert("Erro ao cadastrar");
                    } else if (resposta == 2) {
                        alert("Este professor já é director de uma turma");
                    } else if (resposta == 3) {
                        alert("Esta turma já tem um director");
                    } else if (resposta == 4) {
                        alert("Já realizou o cadastro");
                    }
                }
            });
            return false;
        });
//fim

//carregar funcionarios
        $("#modal-carregamento").modal("show");
        $("#carregar_dados").load("LOAD_CADASTRO/PAGINACAO/load_funcionario.php", function () {
            $("#modal-carregamento").modal("hide");
        });
//fim

//comandos da paginacao

        $("#registro_anterior").click(function (e) {
            $("#modal-carregamento").modal("show");
            var c = $("#txtna").val();
            var i = parseInt(c) - 1;

            $("#carregar_dados").load("LOAD_CADASTRO/PAGINACAO/load_funcionario.php?pagina=" + i, function () {
                $("#modal-carregamento").modal("hide");
            });
        });

        $("#registro_seguinte").click(function (e) {
            $("#modal-carregamento").modal("show");
            var c = $("#txtna").val();
            var o = parseInt(c) + 1;

            $("#carregar_dados").load("LOAD_CADASTRO/PAGINACAO/load_funcionario.php?pagina=" + o, function () {
                $("#modal-carregamento").modal("hide");
            });
        });
        //fim

        //gerar pdf
        $("#gerar_pdf").click(function () {
            var dados = $("#txtPesq").val();
            window.location.href = "LOAD_CADASTRO/DOCS/funcionarios.php?valor=" + dados;
        });
        //fim


        //importar funcionarios
        $("#form_import").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = new FormData();
            dados.append('arquivo', $('input.arquivo').prop('files')[0]);
            console.log(dados);

            jQuery.ajax({
                url: 'LOAD_CADASTRO/Controller_importfuncionarios.php',
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
    fieldset {

        border: 1px inset #fb6340;
        width: 100%;
    }

    fieldset legend {
        font-size: 13px;
        border: 1px solid #ccc;
        width: 30%;
        border-radius: 5px;
        background: #fb6340;
        color: #fff;

        padding: 6px;
        -webkit-box-shadow: 3px 3px 2px #ccc;
        -moz-box-shadow: 3px 3px 2px #ccc;
        box-shadow: 3px 3px 2px #ccc;
    }

    fieldset label {
        font-size: 12px;
        color: #4d7bca;
    }

    fieldset label span {
        color: #EF3159;
        font-weight: bold;
    }


</style>
<div class="tabs-container">

    <ul class="tabs">
        <li class="tab-link current" data-tab="tab-1"><i class="fa fa-search"></i> FUNCIONÁRIOS</li>
        <li class="tab-link" data-tab="tab-2"><i class="fa fa-plus-circle"></i> NOVO</li>
        <li class="tab-link" data-tab="tab-3"><i class="fa fa-upload"></i> IMPORTAR</li>
        <li class="tab-link" data-tab="tab-4"><i class="fa fa-search"></i> DIRECTORES DE TURMA</li>
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

                                        <input type="text" name="txtPesq" class="form-control"
                                               placeholder="Pesquisar por nome" id="txtPesq"/>
                                    </div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="registro_seguinte" title="Seguinte"><i
                                                class="fa fa-angle-right"></i></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="gerar_pdf" title="Exportar PDF"><i
                                                class="fas fas fa-file-pdf"></i></a>

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
        <form name="form_cadFuncionario" action="" method="POST" id="form_cadFuncionario">

            <div class="row">
                <fieldset class="col-md-12">
                    <legend><i class="fa fa-user"></i>&nbsp;&nbsp;Dados Pessoais</legend>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Nome Completo </label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-atom"></i></span>
                                    </div>

                                    <input type="text" name="nome" class="form-control" placeholder="Nome completo"
                                           required=""/>
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

                                    <input type="date" name="data_nascimento" class="form-control" required=""/>
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
                            <label><span>*</span> Nº B.I ou Certidão</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-passport"></i></span>
                                </div>

                                <input type="text" name="bilhete" class="form-control" placeholder="Nº B.I ou Certidão"
                                       required/>
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

                                <input type="text" name="local_emissao" class="form-control"
                                       placeholder="Local de Emissão"/>

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
                    <legend><i class="ni ni-badge"></i>&nbsp;&nbsp;Dados Profissionais</legend>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Cargo </label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-briefcase"></i></span>
                                    </div>
                                    <select name="cargo" class="form-control" required="">
                                        <option value="">Cargo</option>
                                        <?php
                                        while ($view1 = $res1->fetch(PDO::FETCH_OBJ)):
                                            ?>
                                            <option value="<?php echo $view1->id_cargo; ?>"><?php echo $view1->cargo; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span></span> Escalão </label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-building"></i></span>
                                    </div>
                                    <select name="escalao" class="form-control">
                                        <option value="">Escalão</option>
                                        <?php
                                        while ($view2 = $res2->fetch(PDO::FETCH_OBJ)):
                                            ?>
                                            <option value="<?php echo $view2->id_escalao; ?>"><?php echo $view2->nome_escalao; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Agente</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                                </div>
                                <input type="text" name="agente" class="form-control" placeholder="Nº de Agente"/>
                            </div>
                        </div>


                    </div>
                </fieldset>

                <fieldset class="col-md-12">
                    <legend><i class="ni ni-settings"></i>&nbsp;&nbsp;Operações</legend>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="submit" name="salvar" class="btn btn-primary"><i class="fa fa-save"></i>
                                Salvar
                            </button>
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
                        <button type="submit" name="salvar" class="btn btn-primary"><i class="fa fa-save"></i> Salvar
                        </button>
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
        <div class="float-right">
            <form name="formPesqDir" method="POST" id="formPesq">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>

                                <input type="text" name="txtPesqdir" class="form-control"
                                       placeholder="Pesquisar por nome" id="txtPesq"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive" id="carregar_dados2">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome funcionário</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Classe</th>
                    <th scope="col">Turma</th>
                    <th scope="col">Turno</th>
                    <th scope="col">Ano</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($view7 = $res7->fetch(PDO::FETCH_OBJ)):
                    ?>
                    <tr>
                        <td class="nr"><?php echo $view7->id_funcionario; ?></td>

                        <th scope="row">
                            <?php echo $view7->nome; ?>
                        </th>
                        <td>
                            <?php echo $view7->nome_curso; ?>
                        </td>
                        <td>
                            <?php echo $view7->classe; ?>
                        </td>
                        <td>
                            <?php echo $view7->turma; ?>
                        </td>

                        <td>
                            <?php echo $view7->turno; ?>
                        </td>

                        <td>
                            <?php echo $view7->ano_lectivo; ?>
                        </td>

                        <td class="text-right">
                            <a href="#" class="bt_eliminar" title="Eliminar"><i class="fa fa-trash fa-2x"></i></a>&nbsp;&nbsp;

                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>


</div>


<!-- modal-->
<!-- modal erro-->
<div class="modal" id="modal-alertaErro" data-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header">
                <div class="resultado_erro" style="width:100%;"></div>
            </div>
            <!-- Corpo do Modal -->
            <div class="modal-body">
                <img src="../../ACTIVOS/img/theme/error.png"
                     style="width: 150px; height: 150px; margin: auto;position: absolute; top: 0; left: 0; bottom: 0; right: 0;"/>

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
<div class="modal" id="modal-alertaSucesso" data-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <!-- Cabeçalho do Modal -->
            <div class="modal-header">
                <div id="resultado_sucesso" class="alert alert-success" style="width:100%"></div>
            </div>
            <!-- Corpo do Modal -->
            <div class="modal-body">
                <img src="../../ACTIVOS/img/theme/success.png"
                     style="width: 130px; height: 130px; margin: auto;position: absolute; top: 0; left: 0; bottom: 0; right: 0;"/>

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
<div class="modal fade" id="modal_horario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form name="form_cadHorario" id="form_cadHorario" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Horário de trabalho:: <span
                                id="carrega_nomeH"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="iu"></div>
                    <div class="alert alert-success" id="iu"></div>
                    <div class="row">

                        <fieldset class="col-md-12">
                            <legend><i class="fa fa-clock"></i>&nbsp;&nbsp;Horário</legend>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="ID_funcionario" id="ID_funcionario"/>
                                    <label><span>*</span> Turma </label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-building"></i></span>
                                        </div>
                                        <select name="id_turma" class="form-control" required="" id="id_turma">
                                            <option value="">Turma</option>
                                            <?php
                                            while ($view4 = $res4->fetch(PDO::FETCH_OBJ)):
                                                ?>
                                                <option value="<?php echo $view4->id_turma; ?>"><?php echo $view4->turma; ?>
                                                    ( <?php echo $view4->nome_curso; ?> )
                                                </option>
                                            <?php
                                            endwhile;
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <label><span>*</span> Disciplina </label>
                                    <div class="input-group input-group-alternative" id="id_disciplina">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-file"></i></span>
                                        </div>
                                        <select name="id_disciplina" class="form-control" required="">
                                            <option value="">Disciplina</option>
                                        </select>
                                    </div>

                                </div>


                                <div class="col-md-6">
                                    <label><span>*</span> Sala </label>
                                    <div class="input-group input-group-alternative" id="id_sala">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-home"></i></span>
                                        </div>
                                        <select name="id_sala" class="form-control" required="">
                                            <option value="">Sala</option>
                                            <?php
                                            while ($view6 = $res6->fetch(PDO::FETCH_OBJ)):
                                                ?>
                                                <option value="<?php echo $view6->id_sala; ?>"><?php echo $view6->designacao; ?></option>
                                            <?php
                                            endwhile;
                                            ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <label><span>*</span> Ano lectivo </label>
                                    <div class="input-group input-group-alternative" id="ano_lectivo">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                                        </div>
                                        <input type="text" name="ano_lectivo" class="form-control"
                                               placeholder="Ano lectivo">
                                    </div>

                                </div>

                            </div>
                            <br/>
                        </fieldset>
                    </div>
                </div>
                <div class="modal-footer">
                    <fieldset class="col-md-12">
                        <legend><i class="ni ni-settings"></i>&nbsp;&nbsp;Operações</legend>
                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary" id="bt_Cadhorario"><i
                                            class="fa fa-save"></i> Salvar
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button type="reset" class="btn btn-danger"><i class="fa fa-recycle"></i> Cancelar
                                </button>
                            </div>
                        </div>
                        <br/>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>
<!--fim-->

<!-- modal editar-->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Funcionário :: <span id="carrega_nomeE"></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar mudanças</button>
            </div>
        </div>
    </div>
</div>
<!--fim-->

<!-- modal director-->
<div class="modal fade" id="modal_director" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form name="form_director" id="form_director" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Director de Turma:: <span id="carrega_nomeD"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset class="col-md-12">
                        <legend><i class="fa fa-clock"></i>&nbsp;&nbsp;Dir. de turma</legend>
                        <div class="row">
                            <div class="resp_cad"></div>
                            <div class="col-md-6">
                                <label><span>*</span> Turma </label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-building"></i></span>
                                    </div>
                                    <input type="hidden" name="id_funcionarioDir" id="id_funcionarioDir">
                                    <select name="id_turma" class="form-control" required="" id="id_turma">
                                        <option value="">Turma</option>
                                        <?php
                                        $res7 = $objTurmaDAO->buscaTurmas();
                                        while ($view7 = $res7->fetch(PDO::FETCH_OBJ)):
                                            ?>
                                            <option value="<?php echo $view7->id_turma; ?>"><?php echo $view7->turma; ?></option>
                                        <?php
                                        endwhile;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label><span>*</span> Ano lectivo </label>
                                <div class="input-group input-group-alternative" id="ano_lectivo">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-address-book"></i></span>
                                    </div>
                                    <input type="text" name="ano_lectivo" class="form-control" placeholder="Ano lectivo"
                                           required=""/>
                                </div>

                            </div>

                        </div>
                        <br/>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="btcad_director">Salvar mudanças</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--fim-->
<!-- fim-->