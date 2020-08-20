<?php
ob_start();
session_start();
if (isset($_SESSION['favoritosPA']) && ($_SESSION['favoritosPA'] != null)):
    unset($_SESSION["favoritosPA"]);
endif;

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../CONTROLO/Globals.php';
include_once '../../../MODELO/Turma.php';
include_once '../../../DAO/DISCursoDAO.php';
include_once '../../../DAO/TurmaDAO.php';

$objConexao = new Conexao();
$objGlobals = new Globals();
$objTurma = new Turma();
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);
$objDISCursoDAO = new DISCursoDAO($_SESSION['dbname']);

if (addslashes(htmlspecialchars(isset($_POST['id_turma'])))):
    $id_turma = addslashes(htmlspecialchars($_POST['id_turma']));
    $ano_lectivo = addslashes(htmlspecialchars($_POST['ano_lectivo']));
    $pagina_volta = addslashes(htmlspecialchars($_POST['pagina']));

    $_SESSION['id_turmaP'] = $id_turma;
    $_SESSION['ano_lectivoP'] = $ano_lectivo;
    $_SESSION['paginaP'] = $pagina_volta;

else:
    $id_turma = $_SESSION['id_turmaP'];
    $ano_lectivo = $_SESSION['ano_lectivoP'];
    $pagina_volta = $_SESSION['paginaP'];
endif;

$objTurma->setId_turma($id_turma);

$res1 = $objTurmaDAO->buscarTurma_ID2($objTurma);
$view1 = $res1->fetch(PDO::FETCH_OBJ);

$res2 = $objDISCursoDAO->conta_disciplinas($view1->nome_curso, $view1->classe);
?>
<div class="row">
    <div class="col-md-1">
        <div class="text-left">
            <a href="#" id="voltar" title="Voltar"><i class="fa fa-angle-double-left"></i></a>
        </div>
    </div> 
    <div class="col-md-9"><span style="font-family: arial; font-size: 12px;">ORDENAR DISCIPLINAS PARA PAUTA</span></div>
    <div class="col-md-2"><button id="avancar" name="avancar" class="btn btn-success"><i class="fa fa-drum"></i> Avançar</button></div>

    <input type="hidden" name="pagina_volta" id="pagina_volta"  value="<?php echo $pagina_volta; ?>">

</div>
<hr/>
<div class="row">
    <div class="col-md-8">
        <div class="table-responsive" id="carrega">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome disciplina</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($view2 = $res2->fetch(PDO::FETCH_OBJ)):
                        ?>
                        <tr>
                            <td class="nr"><?php echo $view2->id_disciplina; ?></td>
                            <td scope="row">
                                <?php echo $view2->nome_disciplina; ?>
                            </td>
                            <td class="text-right">
                                <button class="adicionar_carrinho" type="button"><i class="fas fa-plus"></i></button>  

                            </td>
                        </tr>
                        <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4" id="carrega44">

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        var pagina_volta = $("#pagina_volta").val();


        $(".adicionar_carrinho").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            var $acao = "add";
            $.ajax({
                type: "POST",
                url: "LOAD_PAUTAS/session.php",
                data: {'acao': $acao, 'id_disciplina': $item},
                success: function () {
                    $("#carrega44").load("LOAD_PAUTAS/carrinho.php");
                }
            });
            return false;
        });

        $("#avancar").click(function () {
           $.ajax({
                type: "POST",
                url: "LOAD_PAUTAS/session_pautas.php",
                data: {
                    'pagina_volta': pagina_volta
                },
                success: function (dados_resposta) {
                    var resposta = $.parseJSON(dados_resposta);
                    if(pagina_volta == "simples.php"){
                    if ((resposta.ensinoP == "Primário & I Cíclo (ini . 9)") && ((resposta.classeP == "7ª") || (resposta.classeP == "8ª") || (resposta.classeP == "9ª"))) {
                            $("#carrega_pauta").load("LOAD_PAUTAS/PAUTAS/simples/paut_Pri_Bas_789.php");
                        } else if ((resposta.ensinoP == "Primário & I Cíclo (ini . 9)") && ((resposta.classeP == "Iniciação") || (resposta.classeP == "1ª") || (resposta.classeP == "3ª") || (resposta.classeP == "5ª"))) {
                            $("#carrega_pauta").load("LOAD_PAUTAS/PAUTAS/simples/paut_Pri_Bas_ini3.php");
                        } else if ((resposta.ensinoP === "Primário & I Cíclo (ini . 9)") && ((resposta.classeP === "2ª") || (resposta.classeP === "4ª") || (resposta.classeP === "6ª"))) {
                            $("#carrega_pauta").load("LOAD_PAUTAS/PAUTAS/simples/paut_Pri_Bas_24.php");
                        } else if ((resposta.ensinoP === "Formação Técnico Profissional(10 . 13)") && ((resposta.classeP === "10ª") || (resposta.classeP === "11ª") || (resposta.classeP === "12ª") || (resposta.classeP === "13ª"))) {
                            $("#carrega_pauta").load("LOAD_PAUTAS/PAUTAS/simples/paut_Tec_1013.php");
                        } else if ((resposta.ensinoP === "Secundário & II Cíclo (10 . 13)") && ((resposta.classeP === "10ª") || (resposta.classeP === "11ª") || (resposta.classeP === "12ª") || (resposta.classeP === "13ª"))) {
                            $("#carrega_pauta").load("LOAD_PAUTAS/PAUTAS/simples/paut_Sec_1013.php");
                        } else if ((resposta.ensinoP === "Superior") && ((resposta.classeP === "1 ano") || (resposta.classeP === "2 ano") || (resposta.classeP === "3 ano") || (resposta.classeP === "4 ano") || (resposta.classeP === "5 ano") || (resposta.classeP === "6 ano"))) {
                            $("#carrega_pauta").load("LOAD_PAUTAS/PAUTAS/simples/paut_Sup_123456.php");
                        }
                    }else{
                        if ((resposta.ensinoP == "Primário & I Cíclo (ini . 9)") && ((resposta.classeP == "7ª") || (resposta.classeP == "8ª") || (resposta.classeP == "9ª"))) {
                            $("#carrega_pauta").load("LOAD_PAUTAS/PAUTAS/complexas/paut_Pri_Bas_789.php");
                        } else if ((resposta.ensinoP == "Primário & I Cíclo (ini . 9)") && ((resposta.classeP == "Iniciação") || (resposta.classeP == "1ª") || (resposta.classeP == "3ª") || (resposta.classeP == "5ª"))) {
                            $("#carrega_pauta").load("LOAD_PAUTAS/PAUTAS/complexas/paut_Pri_Bas_ini3.php");
                        } else if ((resposta.ensinoP === "Primário & I Cíclo (ini . 9)") && ((resposta.classeP === "2ª") || (resposta.classeP === "4ª") || (resposta.classeP === "6ª"))) {
                            $("#carrega_pauta").load("LOAD_PAUTAS/PAUTAS/complexas/paut_Pri_Bas_24.php");
                        } else if ((resposta.ensinoP === "Formação Técnico Profissional(10 . 13)") && ((resposta.classeP === "10ª") || (resposta.classeP === "11ª") || (resposta.classeP === "12ª") || (resposta.classeP === "13ª"))) {
                            $("#carrega_pauta").load("LOAD_PAUTAS/PAUTAS/complexas/paut_Tec_1013.php");
                        } else if ((resposta.ensinoP === "Secundário & II Cíclo (10 . 13)") && ((resposta.classeP === "10ª") || (resposta.classeP === "11ª") || (resposta.classeP === "12ª") || (resposta.classeP === "13ª"))) {
                            $("#carrega_pauta").load("LOAD_PAUTAS/PAUTAS/complexas/paut_Sec_1013.php");
                        } else if ((resposta.ensinoP === "Superior") && ((resposta.classeP === "1 ano") || (resposta.classeP === "2 ano") || (resposta.classeP === "3 ano") || (resposta.classeP === "4 ano") || (resposta.classeP === "5 ano") || (resposta.classeP === "6 ano"))) {
                            $("#carrega_pauta").load("LOAD_PAUTAS/PAUTAS/complexas/paut_Sup_123456.php");
                        }
                    }
                  $("#modal-carregamento").modal("hide");  
                }, beforeSend: function(){
                 $("#modal-carregamento").modal("show");   
                }
            });
            return false;
        });

        $("#voltar").click(function (e) {
            e.preventDefault();
            $("#modal-carregamento").modal("show");

            jQuery.ajax({
                type: "POST",
                url: "LOAD_PAUTAS/" + pagina_volta,
                success: function (data) {
                    $("#modal-carregamento").modal("hide");
                    $("#carrega_pauta").text('')
                            .append(data);
                }
            });
            return false;

        });

    });
</script>
