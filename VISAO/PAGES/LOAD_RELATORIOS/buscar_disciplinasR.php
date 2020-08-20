<?php
ob_start();
session_start();
if (isset($_SESSION['favoritosRE']) && ($_SESSION['favoritosRE'] != null)):
    unset($_SESSION["favoritosRE"]);
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

if(addslashes(htmlspecialchars(isset($_POST['id_turma'])))):
$id_turma = addslashes(htmlspecialchars($_POST['id_turma']));
$ano_lectivo = addslashes(htmlspecialchars($_POST['ano_lectivo']));
$epoca = addslashes(htmlspecialchars($_POST['epoca']));

else:
$id_turma = $_SESSION['id_turmaR'];
$ano_lectivo = $_SESSION['ano_lectivoR'];
$epoca = $_SESSION['epocaR'];
endif;

$objTurma->setId_turma($id_turma);

$res1 = $objTurmaDAO->buscarTurma_ID2($objTurma);
$view1 = $res1->fetch(PDO::FETCH_OBJ);

$res2 = $objDISCursoDAO->conta_disciplinas($view1->nome_curso, $view1->classe);
?>
<br/>
<div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2"><button id="avancar" name="avancar" class="btn btn-primary"><i class="fa fa-drum"></i></button></div>
</div>
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
        
        $(".adicionar_carrinho").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            var $acao = "add";
            $.ajax({
                type: "POST",
                url: "LOAD_RELATORIOS/session.php",
                data: {'acao': $acao, 'id_disciplina': $item},
                success: function () {
                    $("#carrega44").load("LOAD_RELATORIOS/carrinho.php");
                }
            });
            return false;
        });

        $("#avancar").click(function (e) {
            e.preventDefault();
            //$("#modal-carregamento").modal("show");
            var dados = jQuery("#form_pautas").serialize();
            jQuery.ajax({
                type: "POST",
                url: "LOAD_RELATORIOS/session_relatorio.php",
                data: dados,
                success: function (data) {
                    //$("#modal-carregamento").modal("hide");
                   
                }
            });
            return false;
        });

    });
</script>
