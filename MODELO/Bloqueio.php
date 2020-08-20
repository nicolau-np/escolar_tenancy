<?php

class Bloqueio {

    private $epoca;
    private $estado;
    private $data_modificacao;

    function getEpoca() {
        return $this->epoca;
    }

    function getEstado() {
        return $this->estado;
    }

    function getData_modificacao() {
        return $this->data_modificacao;
    }

    function setEpoca($epoca) {
        $this->epoca = $epoca;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setData_modificacao($data_modificacao) {
        $this->data_modificacao = $data_modificacao;
    }

}

