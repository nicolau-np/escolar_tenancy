<?php

include_once 'Pessoa.php';

class Funcionario extends Pessoa {

    private $id_funcionario;
    private $agente;
    private $data_cadastro;
    private $data_modificacao;

    function getId_funcionario() {
        return $this->id_funcionario;
    }

    function getAgente() {
        return $this->agente;
    }

    function getData_cadastro() {
        return $this->data_cadastro;
    }

    function getData_modificacao() {
        return $this->data_modificacao;
    }

    function setId_funcionario($id_funcionario) {
        $this->id_funcionario = $id_funcionario;
    }

    function setAgente($agente) {
        $this->agente = $agente;
    }

    function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

    function setData_modificacao($data_modificacao) {
        $this->data_modificacao = $data_modificacao;
    }

}
