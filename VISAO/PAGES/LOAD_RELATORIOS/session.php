<?php 
ob_start();
session_start();
$id_disciplinaRE = addslashes(htmlspecialchars($_POST['id_disciplina']));
if(addslashes(htmlspecialchars(isset($_POST['acao']))) && addslashes(htmlspecialchars($_POST['acao']))== "add"){
$_SESSION["favoritosRE"][$id_disciplinaRE] = addslashes(htmlspecialchars($_POST['id_disciplina']));
}
else if(addslashes(htmlspecialchars(isset($_POST['acao']))) && addslashes (htmlspecialchars ($_POST['acao'])) == "del"){
unset($_SESSION["favoritosRE"][$id_disciplinaRE]);
}
?>



