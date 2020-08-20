<?php

class FaltasPROFESSOR extends Funcionario{
private $id_faltaPr;
private $estado;
private $data_marcacao;
private $ano_lectivo;

function getId_faltaPr() {
    return $this->id_faltaPr;
}

function getEstado() {
    return $this->estado;
}

function getData_marcacao() {
    return $this->data_marcacao;
}

function getAno_lectivo() {
    return $this->ano_lectivo;
}

function setId_faltaPr($id_faltaPr) {
    $this->id_faltaPr = $id_faltaPr;
}

function setEstado($estado) {
    $this->estado = $estado;
}

function setData_marcacao($data_marcacao) {
    $this->data_marcacao = $data_marcacao;
}

function setAno_lectivo($ano_lectivo) {
    $this->ano_lectivo = $ano_lectivo;
}


}





