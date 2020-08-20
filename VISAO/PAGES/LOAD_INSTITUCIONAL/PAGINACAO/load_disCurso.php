<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
        . 'window.location.href="login.php";'
        . '</script>';
endif;
include_once '../../../../CONTROLO/Conexao.php';
include_once '../../../../DAO/DISCursoDAO.php';

$pagina = addslashes(htmlspecialchars(isset($_GET['pagina']))) ? addslashes(htmlspecialchars($_GET['pagina'])) : 1;
$objDISCursoDAO = new DISCursoDAO($_SESSION['dbname']);
$res6 = $objDISCursoDAO->busca();

$total = $res6->rowCount();
$registros = 2;
$numpaginas = ceil($total / $registros);
$inicio = ($registros * $pagina) - $registros;

$res2 = $objDISCursoDAO->Discurso_paginacao($inicio, $registros);
$total2 = $res2->rowCount();

?>
<table class="table align-items-center table-flush">
    <thead class="thead-light">
    <tr>
        <th scope="col">Curso</th>
        <th scope="col">Classe</th>
        <th scope="col">Disciplinas</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($view = $res2->fetch(PDO::FETCH_OBJ)):
        $res7 = $objDISCursoDAO->conta_disciplinas($view->nome_curso, $view->classe);

    ?>
    <tr>
        <th><?php echo $view->nome_curso;?></th>
        <td><?php echo $view->classe;?></td>
        <td>
            <?php
            $a = 0;
            while ($view7 = $res7->fetch(PDO::FETCH_OBJ)):
                $a++;
            ?>
            <?php echo $a.". ".strtoupper($view7->nome_disciplina)."<br/>";?>
            <?php endwhile;?>
        </td>
    </tr>
    <?php endwhile;?>
    </tbody>

</table>
<script>
    $("document").ready(function (e) {
        //paginacao
        $("#registro_anterior1").hide();
        $("#registro_seguinte1").hide();
        $("#txtna3").val(<?php echo $pagina; ?>);
        $("#txtna4").val(<?php echo $numpaginas; ?>);
        var a = $("#txtna3").val();
        var b = $("#txtna4").val();
        if (a != 1)
        {
            $("#registro_anterior1").show();
        }
        if (a != b)
        {
            $("#registro_seguinte1").show();
        }
        //fim

    });
</script>