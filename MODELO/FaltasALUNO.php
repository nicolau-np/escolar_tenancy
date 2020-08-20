<?php

class FaltasALUNO extends Estudante{
private $id_faltaAl;
private $data_marcacao;
private $estado;
private $ano_lectivo;

function getId_faltaAl() {
    return $this->id_faltaAl;
}

function getData_marcacao() {
    return $this->data_marcacao;
}

function getEstado() {
    return $this->estado;
}

function getAno_lectivo() {
    return $this->ano_lectivo;
}

function setId_faltaAl($id_faltaAl) {
    $this->id_faltaAl = $id_faltaAl;
}

function setData_marcacao($data_marcacao) {
    $this->data_marcacao = $data_marcacao;
}

function setEstado($estado) {
    $this->estado = $estado;
}

function setAno_lectivo($ano_lectivo) {
    $this->ano_lectivo = $ano_lectivo;
}


}



