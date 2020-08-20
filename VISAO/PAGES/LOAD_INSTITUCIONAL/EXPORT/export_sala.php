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
include_once '../../../../DAO/SalaDAO.php';

$objGlobals = new Globals();
$objSalaDAO = new SalaDAO($_SESSION['dbname']);

$res2 = $objSalaDAO->buscarsalas();

$arquivo_saida = "salas_". $objGlobals->getAno_lectivo() . ".xls";

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
    <thead class="thead-light">
    <tr>
        <th scope="col">Designação</th>
        <th scope="col">Quant. estudantes</th>
        <th scope="col">Tipo de sala</th>
    </tr>
    </thead>
    <tbody>
    <?php

    while ($view2 = $res2->fetch(PDO::FETCH_OBJ)):
        ?>
        <tr>
            <td>
                <?php echo $view2->designacao; ?>
            </td>
            <td>
                <?php echo $view2->quant_estudantes; ?>
            </td>

            <td>
                <?php echo $view2->tipo; ?>
            </td>

        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</div>