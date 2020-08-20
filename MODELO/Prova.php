<?php

include_once 'Disciplinas.php';

class Prova extends Disciplinas {

    private $id_prova;
    private $epoca;
    private $valor1;
    private $data_valor1;
    private $valor2;
    private $data_valor2;
    private $ano_lectivoP;

    function getId_prova() {
        return $this->id_prova;
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

    function getAno_lectivoP() {
        return $this->ano_lectivoP;
    }

    function setId_prova($id_prova) {
        $this->id_prova = $id_prova;
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

    function setAno_lectivoP($ano_lectivoP) {
        $this->ano_lectivoP = $ano_lectivoP;
    }

}

