<?php
ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
        . 'window.location.href="login.php";'
        . '</script>';
endif;

include_once '../../../../CONTROLO/Conexao.php';
include_once '../../../../CONTROLO/Globals.php';
include_once '../../../../DAO/TurmaDAO.php';

$objGlobals = new Globals();
$objTurmaDAO = new TurmaDAO($_SESSION['dbname']);

$res1 = $objTurmaDAO->buscaTurmas();

$arquivo_saida = "turmas_". $objGlobals->getAno_lectivo() . ".xls";

// configuracao header para forcar download
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified:" . gmdate("D,d M YH:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/x-msexcel");
header("Content-Disposition: attachment; filename=\"{$arquivo_saida}\"");
header("Content-Description: PHP Generated Data");
//fim
?>
<meta charset="utf-8"/>

<div class="pagina">

    <table class="table align-items-center table-flush" border="1" style="font-family:arial; font-size: 13px;">
        <thead>
        <tr>
            <th>Curso</th>
            <th>Classe</th>
            <th>Turno</th>
            <th>Turma</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($view1 = $res1->fetch(PDO::FETCH_OBJ)):
            if($view1->nome_curso!="nenhum"):
        ?>
        <tr>
            <td><?php echo $view1->nome_curso;?></td>
            <td><?php echo $view1->classe;?></td>
            <td><?php echo $view1->turno;?></td>
            <td><?php echo $view1->turma;?></td>
        </tr>
        <?php
        endif;
        endwhile;
        ?>
        </tbody>
    </table>
</div>
<?php exit; ?>
