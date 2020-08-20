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
include_once '../../../MODELO/Funcionario.php';
include_once '../../../DAO/HorarioDAO.php';

$objFuncionario = new Funcionario();
$objGlobals = new Globals();
$objHorarioDAO = new HorarioDAO($_SESSION['dbname']);

$objFuncionario->setId_funcionario($_SESSION['id_funcionarioLOG']);
$res = $objHorarioDAO->buscaHora_pro($objFuncionario, $objGlobals);
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
        
       
        jQuery(".form_lancamento").submit(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");
            var dados = jQuery(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_LANCAMENTO/session_notas.php",
                data: dados,
                success: function (data) {
                            $("#modal-carregamento").modal("hide");
                    var resposta = $.parseJSON(data);
                    if((resposta.ensinoS=="Primário & I Cíclo (ini . 9)")&&((resposta.classeS=="7ª")||(resposta.classeS=="8ª")||(resposta.classeS=="9ª"))){
                       $("#carrega_lancamento").load("LOAD_LANCAMENTO/CADERNETAS/cader_Pri_Bas_789.php");
                    }
                     else if((resposta.ensinoS=="Primário & I Cíclo (ini . 9)")&&((resposta.classeS=="Iniciação")||(resposta.classeS=="1ª")||(resposta.classeS=="3ª")||(resposta.classeS=="5ª"))){
                       $("#carrega_lancamento").load("LOAD_LANCAMENTO/CADERNETAS/cader_Pri_Bas_ini3.php");
                    }
                    else if((resposta.ensinoS=="Primário & I Cíclo (ini . 9)")&&((resposta.classeS=="2ª")||(resposta.classeS=="4ª")||(resposta.classeS=="6ª"))){
                       $("#carrega_lancamento").load("LOAD_LANCAMENTO/CADERNETAS/cader_Pri_Bas_24.php");
                    }
                     else if((resposta.ensinoS=="Formação Técnico Profissional(10 . 13)")&&((resposta.classeS=="10ª")||(resposta.classeS=="11ª")||(resposta.classeS=="12ª")||(resposta.classeS=="13ª"))){
                       $("#carrega_lancamento").load("LOAD_LANCAMENTO/CADERNETAS/cader_Tec_1013.php");
                    }
                     else if((resposta.ensinoS=="Secundário & II Cíclo (10 . 13)")&&((resposta.classeS=="10ª")||(resposta.classeS=="11ª")||(resposta.classeS=="12ª")||(resposta.classeS=="13ª"))){
                       $("#carrega_lancamento").load("LOAD_LANCAMENTO/CADERNETAS/cader_Sec_1013.php");
                    }
                     else if((resposta.ensinoS=="Superior")&&((resposta.classeS=="1 ano")||(resposta.classeS=="2 ano")||(resposta.classeS=="3 ano")||(resposta.classeS=="4 ano")||(resposta.classeS=="5 ano")||(resposta.classeS=="6 ano"))){
                       $("#carrega_lancamento").load("LOAD_LANCAMENTO/CADERNETAS/cader_Sup_123456.php");
                    }
                }
            });
            return false;
        });

    });
</script>

<div class="tabs-container">

    <ul class="tabs">
        <li class="tab-link current" data-tab="tab-1"><i class="fa fa-search"></i> CONSULTAR</li>
    </ul>

    <div id="tab-1" class="tab-content current">
        <br/>
        <div class="row">
              <?php
                    while ($view = $res->fetch(PDO::FETCH_OBJ)):
                    ?>
            <div class="col-lg-3 col-md-6" id="team">
                <div class="card">
                  
                    <!-- cards -->
                    <div class="card-body">
                        <form name="form_lancamento" method="POST" class="form_lancamento">
                        <img src="../../ACTIVOS/img/theme/face.png" alt="" class="img-fluid rounded-circle w-50 mb-3">
                        <h3>Turma: <?php echo $view->turma;?></h3>
                        <p>Disciplina: <?php echo strtoupper($view->sigla);?></p>
                        <input type="hidden" name="id_disciplina" class="id_disciplina" value="<?php echo $view->id_disciplina;?>"/>
                        <input type="hidden" name="id_turma" class="id_turma" value="<?php echo $view->id_turma;?>"/>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="p-4">
                                <h3>::</h3>
                            </div>
                            
                              <div class="p-4">
                                   <button type="submit" class="leva">
                                      <i class="fa fa-book"></i>
                                  </button>
                            </div>
                              <div class="p-4">
                                <h3>::</h3>
                            </div>
                        </div>
                        </form>
                    </div>
                   <!-- fim --> 
                   
                </div>
            </div>
            <?php endwhile;?>
        
        </div>
    </div>


</div>
