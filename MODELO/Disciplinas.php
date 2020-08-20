<?php

include_once 'Componente.php';

class Disciplinas extends Componente {

    private $id_disciplina;
    private $nome_disciplina;
    private $sigla;

    function getId_disciplina() {
        return $this->id_disciplina;
    }

    function getNome_disciplina() {
        return $this->nome_disciplina;
    }

    function getSigla() {
        return $this->sigla;
    }

    function setId_disciplina($id_disciplina) {
        $this->id_disciplina = $id_disciplina;
    }

    function setNome_disciplina($nome_disciplina) {
        $this->nome_disciplina = $nome_disciplina;
    }

    function setSigla($sigla) {
        $this->sigla = $sigla;
    }

}
