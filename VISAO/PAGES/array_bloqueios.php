<?php


$objBloqueio = new Bloqueio();
$objBloqueioDAO = new BloqueioDAO($_SESSION['dbname']);

$data_bloqueio['trimestre1'] = "off";
$data_bloqueio['trimestre2'] = "off";
$data_bloqueio['trimestre3'] = "off";
$data_bloqueio['final'] = "off";

$res = $objBloqueioDAO->buscar();
while ($view_bloqueio = $res->fetch(PDO::FETCH_OBJ)):
    if($view_bloqueio->epoca == "1 trimestre"){
        if($view_bloqueio->estado == "on"):
            $data_bloqueio['trimestre1'] = "on";
        endif;
    }elseif($view_bloqueio->epoca == "2 trimestre"){
        if($view_bloqueio->estado == "on"):
            $data_bloqueio['trimestre2'] = "on";
        endif;
    }elseif($view_bloqueio->epoca == "3 trimestre"){
        if($view_bloqueio->estado == "on"):
            $data_bloqueio['trimestre3'] = "on";
        endif;
    }elseif($view_bloqueio->epoca == "final"){
        if($view_bloqueio->estado == "on"):
            $data_bloqueio['final'] = "on";
        endif;
    }
endwhile;
