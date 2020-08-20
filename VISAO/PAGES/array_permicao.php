<?php

include_once '../../CONTROLO/Conexao.php';
include_once '../../MODELO/Usuario.php';
include_once '../../DAO/PERUsuarioDAO.php';

$objUsuario = new Usuario();
$objPERUsuarioDAO = new PERUsuarioDAO($_SESSION['dbname']);

$objUsuario->setId_usuario($_SESSION['id_usuarioLOG']);

$res_permicao = $objPERUsuarioDAO->buscar_permicoesUsuario($objUsuario);

/*variaveis de permicao*/
$data_permicao['all'] = "no";
$data_permicao['restrit1'] = "no";
$data_permicao['restrit2'] = "no";
$data_permicao['super_restrit'] = "no";
/*variaveis de permicao*/


while($view_permicao = $res_permicao->fetch(PDO::FETCH_OBJ)):
if($view_permicao->tipo == "all"):
    $data_permicao['all'] = "sim";
elseif($view_permicao->tipo == "restrit 1"):
    $data_permicao['restrit1'] = "sim";
elseif($view_permicao->tipo == "restrit 2"):
    $data_permicao['restrit2'] = "sim";
elseif($view_permicao->tipo == "super-restrit"):
    $data_permicao['super_restrit'] = "sim";
endif;
endwhile;
