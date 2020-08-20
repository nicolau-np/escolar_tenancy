<?php
ob_start();
session_start();
if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../CONTROLO/Globals.php';
include_once '../../../DAO/TurmaDAO.php';

$objGlobals = new Globals();
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);
$res1 = $objTurmaDAO->buscaTurmas();
?>
<div class="row" style="font-family: arial; font-size: 13px;"> 
    <div class="col-md-1">
        <div class="text-left">
            <a href="#" id="voltar" title="Voltar"><i class="fa fa-angle-double-left"></i></a>
        </div>
    </div>  

    <div class="col-md-10">
        <div class="text-righ">
            BOLETIM DE NOTAS
        </div>
    </div>
    <div class="col-md-1">
        <div class="text-right">
            <a href="#" id="export" title="Exportar"><i class="fa fa-file-excel"></i></a>
        </div>
    </div>
</div>
<hr/>

<div class="row">
    <div class="col-md-12">

        <form name="form_boletim" id="form_boletim" action="" method="POST">
            <fieldset class="col-md-12">
                <legend> Informe dados da turma</legend>
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
                                    while ($view1 = $res1->fetch(PDO::FETCH_OBJ)):
                                        ?>
                                        <option value="<?php echo $view1->id_turma; ?>"><?php echo $view1->turma; ?></option>  
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
                                <input type="text" name="ano_lectivo" id="ano_lectivo" class="form-control" required="" value="<?php echo $objGlobals->getAno_lectivo(); ?>" placeholder="Ano lectivo"/>
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

<div id="carrega_disciplinas">

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#voltar").click(function (e) {
            $("#modal-carregamento").modal("show");
            $("#carregar_relatorio").load("LOAD_RELATORIOS/relatorios_estu.php", function () {
                $("#modal-carregamento").modal("hide");
            });
        });
        
        $("#form_boletim").submit(function(e){
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = $(this).serialize();
            $.ajax({
                method:"POST",
                url:"LOAD_RELATORIOS/buscar_disciplinasR.php",
                data: dados,
                success: function(resp){
                    $("#modal-carregamento").modal("hide");
                    $("#carrega_disciplinas").text('').append(resp);
                }
            });
            
        });
    });
</script>








