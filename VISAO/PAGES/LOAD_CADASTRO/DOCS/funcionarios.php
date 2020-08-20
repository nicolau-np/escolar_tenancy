<?php

ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;
include_once '../../../../CONTROLO/Conexao.php';
include_once '../../../../DAO/FuncionarioDAO.php';

$objFuncionarioDAO = new FuncionarioDAO($_SESSION['dbname']);
$valor = addslashes(htmlspecialchars($_GET['valor']));

if ($valor == "") {
$res1 = $objFuncionarioDAO->buscar_funcionarios();
} elseif ($valor != "") {
$res1 = $objFuncionarioDAO->search($valor);
}

$html = "<style>"
        . "</style>";

$html .= "<body>"
        . "<h1>Pesquisa por funcionários de: $valor</h1>"
        . "<div class='tabela_dados'>"
        . "<table border='1' style='font-size: 13px; font-family:arial;'>"
        . "<theady>"
        . "<tr>"
        . "<th>Nº</th>"
        . "<th>Agente</th>"
        . "<th>Nome do funcionário</th>"
        . "<th>Gênero</th>"
        . "<th>Cargo</th>"
        . "<th>Escalão</th>"
        . "</tr>"
        . "</thead>"
        . "<tbody>";
$conta = 0;
while ($view = $res1->fetch(PDO::FETCH_OBJ)):
$conta ++;
$html .= "<tr>"
        . "<td>{$conta}</td>"
        . "<td>{$view->agente}</td>"
        . "<td>{$view->nome}</td>"
        . "<td>{$view->genero}</td>"
        . "<td>{$view->cargo}</td>"
        . "<td>{$view->nome_escalao}</td>"
        . "</tr>";
endwhile;

$html .= "</tbody>"
        . "</table>"
        . "</div>";

$html .= "</body>";

include_once "../../../../ACTIVOS/mpdf/mpdf.php";
$mpdf = new mPDF();
$mpdf->WriteHTML($html);
$mpdf->Output();

exit;









