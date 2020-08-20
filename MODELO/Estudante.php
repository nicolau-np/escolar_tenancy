<?php
include_once 'Pessoa.php';
class Estudante extends Pessoa {

    private $id_estudante;
    private $data_cadastro;
    private $data_modificacao;
    private $ano_lectivo;

    function getId_estudante() {
        return $this->id_estudante;
    }

    function getData_cadastro() {
        return $this->data_cadastro;
    }

    function getData_modificacao() {
        return $this->data_modificacao;
    }

    function getAno_lectivo() {
        return $this->ano_lectivo;
    }

    function setId_estudante($id_estudante) {
        $this->id_estudante = $id_estudante;
    }

    function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

    function setData_modificacao($data_modificacao) {
        $this->data_modificacao = $data_modificacao;
    }

    function setAno_lectivo($ano_lectivo) {
        $this->ano_lectivo = $ano_lectivo;
    }

}
