<?php 
ob_start();
session_start();
$id_disciplina = addslashes(htmlspecialchars($_POST['id_disciplina']));
if(addslashes(htmlspecialchars(isset($_POST['acao']))) && addslashes(htmlspecialchars($_POST['acao']))== "add"){
$_SESSION["favoritos"][$id_disciplina] = addslashes(htmlspecialchars($_POST['id_disciplina']));
}
else if(addslashes(htmlspecialchars(isset($_POST['acao']))) && addslashes (htmlspecialchars ($_POST['acao'])) == "del"){
unset($_SESSION["favoritos"][$id_disciplina]);
}
?>
