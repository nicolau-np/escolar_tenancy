<?php
include_once 'Municipio.php';
class Pessoa extends Municipio{

    private $id_pessoa;
    private $nome;
    private $data_nascimento;
    private $genero;
    private $estado_civil;
    private $naturalidade;
    private $telefone;
    private $bilhete;
    private $data_emissao;
    private $local_emissao;
    private $pai;
    private $mae;
    private $idade;
    private $comuna;

    function getId_pessoa() {
        return $this->id_pessoa;
    }

    function getNome() {
        return $this->nome;
    }

    function getData_nascimento() {
        return $this->data_nascimento;
    }

    function getGenero() {
        return $this->genero;
    }

    function getEstado_civil() {
        return $this->estado_civil;
    }

    function getNaturalidade() {
        return $this->naturalidade;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getBilhete() {
        return $this->bilhete;
    }

    function getData_emissao() {
        return $this->data_emissao;
    }

    function getLocal_emissao() {
        return $this->local_emissao;
    }

    function getPai() {
        return $this->pai;
    }

    function getMae() {
        return $this->mae;
    }

    function getIdade() {
        return $this->idade;
    }

    function getComuna() {
        return $this->comuna;
    }

    function setId_pessoa($id_pessoa) {
        $this->id_pessoa = $id_pessoa;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setData_nascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setEstado_civil($estado_civil) {
        $this->estado_civil = $estado_civil;
    }

    function setNaturalidade($naturalidade) {
        $this->naturalidade = $naturalidade;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setBilhete($bilhete) {
        $this->bilhete = $bilhete;
    }

    function setData_emissao($data_emissao) {
        $this->data_emissao = $data_emissao;
    }

    function setLocal_emissao($local_emissao) {
        $this->local_emissao = $local_emissao;
    }

    function setPai($pai) {
        $this->pai = $pai;
    }

    function setMae($mae) {
        $this->mae = $mae;
    }

    function setIdade($idade) {
        $this->idade = $idade;
    }

    function setComuna($comuna) {
        $this->comuna = $comuna;
    }


}



