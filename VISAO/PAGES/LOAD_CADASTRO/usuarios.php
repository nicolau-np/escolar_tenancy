<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/UsuarioDAO.php';
include_once '../../../DAO/TipoPERDAO.php';

$objUsuarioDAO = new UsuarioDAO($_SESSION['dbname']);
$objTipoPERDAO = new TipoPERDAO($_SESSION['dbname']);

$res1 = $objUsuarioDAO->buscar_usuarios();
$res2 = $objTipoPERDAO->buscar_tiposPermicao();
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

//pesquisar usuario
        $("#txtPesq").keydown(function () {
            var $nome_usuario = $("#txtPesq").val();
            jQuery.ajax({
                type: "GET",
                url: "LOAD_CADASTRO/carrega_usuarios.php",
                data: "nome_usuario=" + $nome_usuario,
                dataType: "html",
                success: function (dados) {
                    $("#carregar_dados").text('')
                            .append(dados);
                }, });
        });
//fim

//modal permicao
        $(".bt_permicao").click(function () {
            var item = $(this).closest("tr").find(".nr").text();
            $("#modal_permicao").modal("show");

            $.ajax({
                type: "POST",
                url: "LOAD_CADASTRO/load_permit.php",
                data: {id_usuario: item},
                success: function (dados) {
                    $("#my_group").text('').append(dados);
                }
            });
        });
//fim

//modal editar
        $(".bt_editar").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            $("#modal_editar").modal("show");
            $("#carrega_nomeE").text($item);
        });
//fim

//cadastrar permicao
        jQuery("#btCad_permicao").click(function (e) {
            var dados = jQuery("#form_permicao").serialize();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_CADASTRO/Controller_permit.php",
                data: dados,
                success: function (resposta) {
                    if (resposta == 1) {
                        alert("Feito com sucesso");
                        jQuery("#form_permicao")[0].reset();
                    } else if (resposta == 2) {
                        alert("Deve selecionar a permição");
                    }
                }
            });
            return false;
        });
//fim

//carregar usuarios
        $("#modal-carregamento").modal("show");
        $("#carregar_dados").load("LOAD_CADASTRO/PAGINACAO/load_usuario.php", function () {
            $("#modal-carregamento").modal("hide");
        });
//fim

//comandos da paginacao

        $("#registro_anterior").click(function (e) {
            $("#modal-carregamento").modal("show");
            var c = $("#txtna").val();
            var i = parseInt(c) - 1;

            $("#carregar_dados").load("LOAD_CADASTRO/PAGINACAO/load_usuario.php?pagina=" + i, function () {
                $("#modal-carregamento").modal("hide");
            });
        });

        $("#registro_seguinte").click(function (e) {
            $("#modal-carregamento").modal("show");
            var c = $("#txtna").val();
            var o = parseInt(c) + 1;

            $("#carregar_dados").load("LOAD_CADASTRO/PAGINACAO/load_usuario.php?pagina=" + o, function () {
                $("#modal-carregamento").modal("hide");
            });
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
        <li class="tab-link current" data-tab="tab-1"><i class="fa fa-search"></i> USUÁRIOS</li>
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
                                </div>
                            </div>
                        </div>
                    </form>
                </div></div></div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" id="carregar_dados">

                </div>
            </div>

        </div>

    </div>


</div>



<!-- Modal -->
<!-- modal permicao-->
<div class="modal fade" id="modal_permicao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form name="form_permicao" id="form_permicao" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Permições de Usuário<span id="carrega_nomeP"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <fieldset class="col-md-12">
                        <legend>permições</legend>

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                while ($view2 = $res2->fetch(PDO::FETCH_OBJ)):
                                    if ($view2->tipo != "restrit 2"):
                                        ?>
                                        <input type="checkbox" name="permicao[]" value="<?php echo $view2->id_tipopermicao; ?>"/> <?php echo $view2->tipo; ?><br/>
                                        <?php
                                    endif;
                                endwhile;
                                ?>
                            </div>
                        </div>

                    </fieldset>
                    <div id="my_group">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="btCad_permicao">Adicionar ou Remover</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!--fim-->

<!-- modal editar-->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuário :: <span id="carrega_nomeE"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
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













































