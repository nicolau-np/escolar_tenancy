<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../MODELO/Bloqueio.php';
include_once '../../../DAO/BloqueioDAO.php';

$objBloqueio = new Bloqueio();
$objBloqueioDAO = new BloqueioDAO($_SESSION['dbname']);
$res = $objBloqueioDAO->buscar();
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

        $(".form_bloqueio").submit(function (e) {

            var dados = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'LOAD_EXTRAS/Controller_bloqueio.php',
                data: dados,
                success: function (resposta) {
                    $("#modal-carregamento").modal("hide");
                     if (resposta == 1) {
                      $("#modal-alertaSucesso").modal("show");
                        $("#resultado_sucesso").text("Feito com sucesso!");
                        jQuery(".form_bloqueio")[0].reset();
                    } else {
                        $("#modal-alertaErro").modal("show");
                        $(".resultado_erro").html(resposta);
                }
            },beforeSend: function () {
                    $("#modal-carregamento").modal("show");
                }

            });
            return false;
        });

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
<div class="tabs-container">

    <ul class="tabs">
        <li class="tab-link current" data-tab="tab-1"><i class="fas fa-key"></i> BLOQUEIO</li>
    </ul>

    <div id="tab-1" class="tab-content current">
        <form name="form_bloqueio" class="form_bloqueio" method="POST">
            <fieldset class="col-md-12">
                <legend><i class="fas fa-key"></i> Epocas</legend>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <th style="width: 50px;"></th>
                            <th>Epocas</th>
                            <th>Estado</th>
                            <th>Data Modificação</th>
                            </thead>
                            <tbody>
                                <?php
                                while ($view = $res->fetch(PDO::FETCH_OBJ)):
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="tipos_bloqueios[]" value="<?php echo $view->epoca; ?>"/></td>
                                        <td><?php echo $view->epoca; ?></td>
                                        <td><?php echo $view->estado; ?></td>
                                        <td><?php echo $view->data_modificacao; ?></td>
                                    </tr>
                                    <?php
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                        <br/>
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














































