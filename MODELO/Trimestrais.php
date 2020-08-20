<?php

include_once 'Disciplinas.php';

class Trimestrais extends Disciplinas {

    private $id_notastrimestrais;
    private $epoca;
    private $mac;
    private $cpp;
    private $ct;
    private $data_lancamento;
    private $ano_lectivoT;

    function getId_notastrimestrais() {
        return $this->id_notastrimestrais;
    }

    function getEpoca() {
        return $this->epoca;
    }

    function getMac() {
        return $this->mac;
    }

    function getCpp() {
        return $this->cpp;
    }

    function getCt() {
        return $this->ct;
    }

    function getData_lancamento() {
        return $this->data_lancamento;
    }

    function getAno_lectivoT() {
        return $this->ano_lectivoT;
    }

    function setId_notastrimestrais($id_notastrimestrais) {
        $this->id_notastrimestrais = $id_notastrimestrais;
    }

    function setEpoca($epoca) {
        $this->epoca = $epoca;
    }

    function setMac($mac) {
        $this->mac = $mac;
    }

    function setCpp($cpp) {
        $this->cpp = $cpp;
    }

    function setCt($ct) {
        $this->ct = $ct;
    }

    function setData_lancamento($data_lancamento) {
        $this->data_lancamento = $data_lancamento;
    }

    function setAno_lectivoT($ano_lectivoT) {
        $this->ano_lectivoT = $ano_lectivoT;
    }

}

