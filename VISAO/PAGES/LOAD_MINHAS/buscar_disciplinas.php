<?php
ob_start();
session_start();
if (isset($_SESSION['favoritosBO']) && ($_SESSION['favoritosBO'] != null)):
    unset($_SESSION["favoritosBO"]);
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
$pagina_export = null;

if (addslashes(htmlspecialchars(isset($_POST['epoca'])))):
    $ano_lectivo = addslashes(htmlspecialchars($_POST['ano_lectivo']));
    $epoca = addslashes(htmlspecialchars($_POST['epoca']));

    $_SESSION['ano_lectivoBO'] = $ano_lectivo;
    $_SESSION['epocaBO'] = $epoca;

else:
    $ano_lectivo = $_SESSION['ano_lectivoBO'];
    $epoca = $_SESSION['epocaBO'];
endif;

if($_SESSION['id_turmaMINHA']!=null){
    
$objTurma->setId_turma($_SESSION['id_turmaMINHA']);

$res1 = $objTurmaDAO->buscarTurma_ID2($objTurma);
$view1 = $res1->fetch(PDO::FETCH_OBJ);

$res2 = $objDISCursoDAO->conta_disciplinas($view1->nome_curso, $view1->classe);

if (($view1->ensino == "Primário & I Cíclo (ini . 9)") && (($view1->classe== "7ª") || ($view1->classe == "8ª") || ($view1->classe== "9ª"))) {
    $pagina_export = "bolet_nota20.php";
} else if (($view1->ensino == "Primário & I Cíclo (ini . 9)") && (($view1->classe == "Iniciação") || ($view1->classe == "1ª") || ($view1->classe == "3ª") || ($view1->classe== "5ª"))) {
    $pagina_export = "bolet_nota102.php";
} else if (($view1->ensino == "Primário & I Cíclo (ini . 9)") && (($view1->classe == "2ª") || ($view1->classe == "4ª") || ($view1->classe == "6ª"))) {
    $pagina_export = "bolet_nota10.php";
} else if (($view1->ensino == "Formação Técnico Profissional(10 . 13)") && (($view1->classe == "10ª") || ($view1->classe == "11ª") || ($view1->classe == "12ª") || ($view1->classe == "13ª"))) {
    $pagina_export = "bolet_nota20.php";
}else if (($view1->ensino == "Secundário & II Cíclo (10 . 13)") && (($view1->classe === "10ª") || ($view1->classe == "11ª") || ($view1->classe == "12ª") || ($view1->classe == "13ª"))) { 
$pagina_export = "bolet_nota20.php";
} else if (($view1->ensino == "Superior") && (($view1->classe == "1 ano") || ($view1->classe == "2 ano") || ($view1->classe == "3 ano") || ($view1->classe == "4 ano") || ($view1->classe== "5 ano") || ($view1->classe== "6 ano"))) {
    $pagina_export = "bolet_nota20.php";
}
?>

<hr/>
<div class="row">
    <div class="col-md-11"></div>
    <div class="col-md-1"><a href="LOAD_MINHAS/EXPORTAR/<?php echo $pagina_export;?>" id="download" title="Download Boletins"><i class="fas fa-file-excel"></i></a></div>
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

<?php 
}else{
    echo "nenhuma turma encontrada";
}
?>
<script type="text/javascript">
    $(document).ready(function () {


        $(".adicionar_carrinho").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            var $acao = "add";
            $.ajax({
                type: "POST",
                url: "LOAD_MINHAS/session.php",
                data: {'acao': $acao, 'id_disciplina': $item},
                success: function () {
                    $("#carrega44").load("LOAD_MINHAS/carrinho.php");
                }
            });
            return false;
        });

    });
</script>


























