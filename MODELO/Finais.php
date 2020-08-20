<?php

include_once 'Disciplinas.php';

class Finais extends Disciplinas {

    private $id_notasfinais;
    private $cap;
    private $cpe;
    private $cf;
    private $estado;
    private $data_lancamento;
    private $ano_lectivoF;

    function getId_notasfinais() {
        return $this->id_notasfinais;
    }

    function getCap() {
        return $this->cap;
    }

    function getCpe() {
        return $this->cpe;
    }

    function getCf() {
        return $this->cf;
    }

    function getEstado() {
        return $this->estado;
    }

    function getData_lancamento() {
        return $this->data_lancamento;
    }

    function getAno_lectivoF() {
        return $this->ano_lectivoF;
    }

    function setId_notasfinais($id_notasfinais) {
        $this->id_notasfinais = $id_notasfinais;
    }

    function setCap($cap) {
        $this->cap = $cap;
    }

    function setCpe($cpe) {
        $this->cpe = $cpe;
    }

    function setCf($cf) {
        $this->cf = $cf;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setData_lancamento($data_lancamento) {
        $this->data_lancamento = $data_lancamento;
    }

    function setAno_lectivoF($ano_lectivoF) {
        $this->ano_lectivoF = $ano_lectivoF;
    }

}

