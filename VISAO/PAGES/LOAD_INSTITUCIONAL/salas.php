<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
        . 'window.location.href="login.php";'
        . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/TurnoDAO.php';
include_once '../../../DAO/TIPSalaDAO.php';
include_once '../../../DAO/SalaDAO.php';

$objTurnoDAO = new TurnoDAO($_SESSION['dbname']);
$objTIPSalaDAO = new TIPSalaDAO($_SESSION['dbname']);
$objSalaDAO = new SalaDAO($_SESSION['dbname']);
?>
<script type="text/javascript">
    jQuery(document).ready(function () {

        $('ul.tabs li').click(function () {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        });

        jQuery("#form_cadSala").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_INSTITUCIONAL/Controller_sala.php",
                data: dados,
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    if (data == 1) {
                        $("#modal-alertaSucesso").modal("show");
                        $("#resultado_sucesso").text("Feito com sucesso!");
                        jQuery("#form_cadSala")[0].reset();
                    } else {
                        $("#modal-alertaErro").modal("show");
                        $(".resultado_erro").html(data);
                    }
                }
            });
            return false;
        });


        $("#txtPesq2").keydown(function () {
            var $sala = $("#txtPesq2").val();
            jQuery.ajax({
                type: "GET",
                url: "LOAD_INSTITUCIONAL/busca_sala.php",
                data: "sala=" + $sala,
                dataType: "html",
                success: function (dados) {
                    $("#carrega_dados2").text('')
                        .append(dados);
                },
            });
        });

        //importar sala
        $("#form_import").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = new FormData();
            dados.append('arquivo', $('input.arquivo').prop('files')[0]);
            console.log(dados);

            jQuery.ajax({
                url: 'LOAD_INSTITUCIONAL/Controller_importsala.php',
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
        border: 1px inset #11cdef;
        width: 100%;
    }

    fieldset legend {
        font-size: 13px;
        border: 1px solid #ccc;
        width: 30%;
        border-radius: 5px;
        background: #11cdef;
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
        <li class="tab-link current" data-tab="tab-3"><i class="fa fa-search"></i> SALAS</li>
        <li class="tab-link" data-tab="tab-4"><i class="fa fa-plus-circle"></i> NOVO</li>
        <li class="tab-link" data-tab="tab-5"><i class="fa fa-upload"></i> IMPORTAR</li>
    </ul>


    <div id="tab-3" class="tab-content current">
        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <form name="formPesq" method="POST" id="formPesq">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-inline">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        </div>

                                        <input type="text" name="txtPesq2" class="form-control"
                                               placeholder="Pesquisar por nome" id="txtPesq2"/>
                                    </div>
                                    &nbsp;&nbsp;<a href="LOAD_INSTITUCIONAL/EXPORT/export_sala.php" id="gerar_excel"
                                                   title="Exportar EXCEL"><i class="fas fas fa-file-excel"></i></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br/>
        <div class="table-responsive" id="carrega_dados2">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Designação</th>
                    <th scope="col">Quant. estudantes</th>
                    <th scope="col">Tipo de sala</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $res2 = $objSalaDAO->buscarsalas();
                while ($view2 = $res2->fetch(PDO::FETCH_OBJ)):
                    ?>
                    <tr>
                        <td class="nr">
                            <?php echo $view2->id_sala; ?>
                        </td>
                        <th scope="row">
                            <?php echo $view2->designacao; ?>
                        </th>
                        <td>
                            <?php echo $view2->quant_estudantes; ?>
                        </td>

                        <td>
                            <?php echo $view2->tipo; ?>
                        </td>

                        <td class="text-right">
                            <a href="#" class="bt_editar" title="Editar"><i class="fa fa-edit fa-2x"></i></a>&nbsp;&nbsp;
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="tab-4" class="tab-content">
        <form name="form_cadSala" action="" method="POST" id="form_cadSala">

            <div class="row">

                <fieldset class="col-md-12">
                    <legend><i class="fa fa-home"></i>&nbsp;&nbsp;Dados da sala</legend>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Tipo de Sala</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-home"></i></span>
                                    </div>
                                    <select class="form-control" required="" name="id_tipoSala" id="id_tipoSala">
                                        <option value="">Tipo de Sala</option>
                                        <?php
                                        $res1 = $objTIPSalaDAO->buscar_tiposSalas();
                                        while ($view1 = $res1->fetch(PDO::FETCH_OBJ)):
                                            ?>
                                            <option value="<?php echo $view1->id_tiposala; ?>"><?php echo $view1->tipo; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label><span>*</span> Quant. Estudantes</label>
                                <div class="input-group input-group-alternative" id="entrada">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="number" name="quant_estudantes" placeholder="Quant. Estudantes"
                                           class="form-control" required=""/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Designação da sala</label>
                                <div class="input-group input-group-alternative" id="designacao">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-text-height"></i></span>
                                    </div>
                                    <input type="text" name="designacao" placeholder="Designação da sala"
                                           class="form-control" required=""/>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>

                <fieldset class="col-md-12">
                    <legend><i class="ni ni-settings"></i>&nbsp;&nbsp;Operações</legend>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="submit" name="bt_salvarSala" class="btn btn-primary"><i
                                        class="fa fa-save"></i> Salvar
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

    <div id="tab-5" class="tab-content">
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



