<?php
ob_start();
session_start();

include_once '../../../CONTROLO/Conexao.php';
include_once '../../../DAO/DisciplinasDAO.php';

$objConexao = new Conexao();
$objDisciplinasDAO = new DisciplinasDAO($_SESSION['dbname']);


$disciplina = addslashes(htmlspecialchars($_GET['disciplina']));

$res = $objDisciplinasDAO->search($disciplina);
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery(".adicionar_carrinho").click(function () {
            var $item = $(this).closest("tr").find(".nr").text();
            var $acao = "add";
            $.ajax({
                type: "POST",
                url: "LOAD_INSTITUCIONAL/session.php",
                data: {'acao': $acao, 'id_disciplina': $item},
                success: function () {
                    $("#carrega44").load("LOAD_INSTITUCIONAL/carrinho.php");
                }
            });
            return false;
        });
    });
</script>
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
            while ($view4 = $res->fetch(PDO::FETCH_OBJ)):
                ?>
                <tr>
                    <th class="nr"><?php echo $view4->id_disciplina; ?></th>
                    <th scope="row">
            <div class="media align-items-center">
                <div class="media-body">
                    <span class="mb-0 text-sm"><?php echo $view4->nome_disciplina; ?></span>
                </div>
            </div>
            </th>
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
