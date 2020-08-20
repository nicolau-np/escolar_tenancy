<?php

include_once 'Disciplinas.php';

class Avaliacao extends Disciplinas {

    private $id_avaliacao;
    private $epoca;
    private $valor1;
    private $data_valor1;
    private $valor2;
    private $data_valor2;
    private $valor3;
    private $data_valor3;
    private $ano_lectivoA;

    function getId_avaliacao() {
        return $this->id_avaliacao;
    }

    function getEpoca() {
        return $this->epoca;
    }

    function getValor1() {
        return $this->valor1;
    }

    function getData_valor1() {
        return $this->data_valor1;
    }

    function getValor2() {
        return $this->valor2;
    }

    function getData_valor2() {
        return $this->data_valor2;
    }

    function getValor3() {
        return $this->valor3;
    }

    function getData_valor3() {
        return $this->data_valor3;
    }

    function getAno_lectivoA() {
        return $this->ano_lectivoA;
    }

    function setId_avaliacao($id_avaliacao) {
        $this->id_avaliacao = $id_avaliacao;
    }

    function setEpoca($epoca) {
        $this->epoca = $epoca;
    }

    function setValor1($valor1) {
        $this->valor1 = $valor1;
    }

    function setData_valor1($data_valor1) {
        $this->data_valor1 = $data_valor1;
    }

    function setValor2($valor2) {
        $this->valor2 = $valor2;
    }

    function setData_valor2($data_valor2) {
        $this->data_valor2 = $data_valor2;
    }

    function setValor3($valor3) {
        $this->valor3 = $valor3;
    }

    function setData_valor3($data_valor3) {
        $this->data_valor3 = $data_valor3;
    }

    function setAno_lectivoA($ano_lectivoA) {
        $this->ano_lectivoA = $ano_lectivoA;
    }

}

