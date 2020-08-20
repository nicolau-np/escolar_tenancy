<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
        . 'window.location.href="login.php";'
        . '</script>';
endif;
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

        //importar horario
        $("#form_import").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = new FormData();
            dados.append('arquivo', $('input.arquivo').prop('files')[0]);
            console.log(dados);

            jQuery.ajax({
                url: 'LOAD_CADASTRO/Controller_importhorarios.php',
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
        <li class="tab-link current" data-tab="tab-1"><i class="fa fa-upload"></i> IMPORTAR</li>
    </ul>

    <div id="tab-1" class="tab-content current">
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

