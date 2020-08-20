<?php

ob_start();
session_start();

if ((!isset($_SESSION['dbname'])) || (!isset($_SESSION['nome_usuarioLOG']))):
    echo '<script>'
    . 'window.location.href="login.php";'
    . '</script>';
endif;
include_once '../../../../CONTROLO/Conexao.php';
include_once '../../../../DAO/EstudanteDAO.php';

$objEstudanteDAO = new EstudanteDAO($_SESSION['dbname']);
$valor = addslashes(htmlspecialchars($_GET['valor']));

if ($valor == "") {
$res1 = $objEstudanteDAO->buscar_estudante();
} elseif ($valor != "") {
$res1 = $objEstudanteDAO->search($valor);
}

$html = "<style>"
        . "</style>";

$html .= "<body>"
        . "<h1>Pesquisa por estudantes de: $valor</h1>"
        . "<div class='tabela_dados'>"
        . "<table border='1' style='font-size: 13px; font-family:arial;'>"
        . "<theady>"
        . "<tr>"
        . "<th>Nº</th>"
        . "<th>Nome do estudante</th>"
        . "<th>Gênero</th>"
        . "<th>Curso</th>"
        . "<th>Classe</th>"
        . "<th>Turma</th>"
        . "</tr>"
        . "</thead>"
        . "<tbody>";
$conta = 0;
while ($view = $res1->fetch(PDO::FETCH_OBJ)):
$conta ++;
$html .= "<tr>"
        . "<td>{$conta}</td>"
        . "<td>{$view->nome}</td>"
        . "<td>{$view->genero}</td>"
        . "<td>{$view->nome_curso}</td>"
        . "<td>{$view->classe}</td>"
        . "<td>{$view->turma}</td>"
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
