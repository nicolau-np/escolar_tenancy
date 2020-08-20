<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
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

        $(".form_boletim").submit(function () {
            var dados = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "LOAD_MINHAS/buscar_disciplinas.php",
                data: dados,
                success: function(resposta){
                    $("#modal-carregamento").modal("hide");
                    $("#carregar_disciplinas").text('').append(resposta);
                },
                beforeSend: function(){
                    $("#modal-carregamento").modal("show");
                }
            });
            return false;
        });


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
        <li class="tab-link current" data-tab="tab-1"><i class="fa fa-search"></i> CONSULTAR</li>
    </ul>

    <div id="tab-1" class="tab-content current">
        <div class="row">
            <div class="col-md-12">
                <form class="form_boletim" name="form_boletim" method="POST" action="#">
                    <fieldset class="col-md-12">
                        <legend>Informe os Dados</legend>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <select name="epoca" class="form-control" required="">
                                            <option value="">Trimestre</option>  
                                            <option value="1">1º Tri.</option>
                                            <option value="2">2º Tri.</option>
                                            <option value="3">3º Tri.</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-building"></i></span>
                                        </div>
                                        <input type="text" name="ano_lectivo" id="ano_lectivo" class="form-control" required="" value="<?php echo date('Y');?>" placeholder="Ano lectivo">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <button type="submit" name="busca_dis" id="busca_dis" class="btn btn-success"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                        </div>
                    </fieldset>
                </form>
            </div> 

        </div>
        <div id="carregar_disciplinas">
           
        </div>
    </div>


</div>























