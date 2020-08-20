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

$objEnsinoDAO = new EnsinoDAO($_SESSION['dbname']);
$objCursoDAO = new CursoDAO($_SESSION['dbname']);
$res1 = $objEnsinoDAO->buscarEnsinos();
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
        
        

        jQuery("#form_cadCurso").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_INSTITUCIONAL/Controller_curso.php",
                data: dados,
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    if (data == 1) {
                        $("#modal-alertaSucesso").modal("show");
                        $("#resultado_sucesso").text("Feito com sucesso!");
                        jQuery("#form_cadCurso")[0].reset();
                    } else {
                        $("#modal-alertaErro").modal("show");
                        $(".resultado_erro").html(data);
                    }


                }
            });
            return false;
        });
        
        $("#txtPesq").keydown(function(){
             var $nome_curso = $("#txtPesq").val();
            jQuery.ajax({
                type: "GET",
                url: "LOAD_INSTITUCIONAL/busca_cursos.php",
                data: "nome_curso=" + $nome_curso,
                dataType: "html",
                success: function (dados) {
                    $("#carrega_dados").text('')
                            .append(dados);
                }, });
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

<div class="tabs-container">

    <ul class="tabs">
        <li class="tab-link current" data-tab="tab-1"><i class="fa fa-search"></i> CURSOS</li>
        <li class="tab-link" data-tab="tab-2"><i class="fa fa-plus-circle"></i> NOVO</li>
        <li class="tab-link" data-tab="tab-3"><i class="fa fa-paperclip"></i> DETALHES</li>
    </ul>

    <div id="tab-1" class="tab-content current">
        <div class="float-right">
            <form name="formPesq" method="POST" id="formPesq">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                                </div>

                                <input type="text" name="txtPesq" class="form-control" placeholder="Pesquisar por nome" id="txtPesq"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive" id="carrega_dados">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Nome curso</th>
                        <th scope="col">Ensino</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res2 = $objCursoDAO->buscarCursos();
                    while ($view3 = $res2->fetch(PDO::FETCH_OBJ)):
                        ?>
                        <tr>
                            <th scope="row">
                    <div class="media align-items-center">
                        <div class="media-body">
                            <span class="mb-0 text-sm"><?php echo $view3->nome_curso ?></span>
                        </div>
                    </div>
                    </th>
                    <td>
                        <?php echo $view3->ensino; ?>
                    </td>

                    <td class="text-right">
                        <a href="#" class="bt_editar" title="Editar"><i class="fa fa-edit fa-2x"></i></a>&nbsp;&nbsp;
                        <a href="#" class="bt_horario" title="Horário de trabalho"><i class="fa fa-clock fa-2x"></i></a>

                    </td>
                    </tr>
                    <?php
                endwhile;
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="tab-2" class="tab-content">
        <form name="form_cadCurso" action="" method="POST" id="form_cadCurso">
            <div class="row">
                <fieldset class="col-md-12">
                    <legend><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Dados do curso </legend>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><span>*</span> Ensino</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-clone"></i></span>
                                    </div>
                                    <select class="form-control" required="" name="ensino">
                                        <option value="">Ensino</option>
                                        <?php
                                        while ($view1 = $res1->fetch(PDO::FETCH_OBJ)):
                                            ?>
                                            <option value="<?php echo $view1->id_ensino; ?>"><?php echo $view1->ensino; ?></option>
                                            <?php
                                        endwhile;
                                        ?>
                                    </select> 
                                </div>
                            </div>
                        </div> 

                        <div class="col-md-5">
                            <div class="form-group">
                                <label><span>*</span> Nome do curso</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-bars"></i></span>
                                    </div>
                                    <input type="text" required="" name="nome_curso" placeholder="Nome do curso" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </fieldset>

                <fieldset class="col-md-12">
                    <legend><i class="ni ni-settings"></i>&nbsp;&nbsp;Operações</legend>
                    <div class="row">   
                        <div class="col-md-2">
                            <button type="submit" name="bt_salvarCurso" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
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


