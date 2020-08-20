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


<style>
            fieldset{
                border: 1px inset #fb6340;
            } 
            fieldset legend{
                font-size: 13px;
                border: 1px solid #ccc;
                width: 30%;
                border-radius: 5px;
                background: #fb6340;
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
<script type="text/javascript">
            $(document).ready(function () {

                $("#form_pautas").submit(function (e) {
                    e.preventDefault();
                    $("#modal-carregamento").modal("show");
                    var dados = $(this).serialize();
                    $.ajax({
                        method: "POST",
                        url: "LOAD_PAUTAS/buscar_disciplinas.php",
                        data: dados,
                        success: function (resposta) {
                            $("#modal-carregamento").modal("hide");
                            $("#carrega_pauta").text('').append(resposta);
                        }
                    });

                });

            });
        </script>


<div class="row">
    <div class="col">
        <form name="form_pautas" id="form_pautas" action="" method="POST">
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
                                    <span class="input-group-text"><i class="fa fa-building"></i></span>
                                </div>
                                <input type="hidden" name="pagina" value="complexa.php">
                                <input type="text" name="ano_lectivo" id="ano_lectivo" class="form-control" required="" value="<?php echo $objGlobals->getAno_lectivo(); ?>" placeholder="Ano lectivo"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <button type="submit" name="pautaB" id="pautaB" class="btn btn-success"><i class="fa fa-search"></i></button>

                        </div>
                    </div>

                </div>
            </fieldset>
        </form>
    </div>

</div>





