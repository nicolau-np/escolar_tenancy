<?php

include_once 'Ensino.php';

class Curso extends Ensino {

    private $id_curso;
    private $nome_curso;

    function getId_curso() {
        return $this->id_curso;
    }

    function getNome_curso() {
        return $this->nome_curso;
    }

    function setId_curso($id_curso) {
        $this->id_curso = $id_curso;
    }

    function setNome_curso($nome_curso) {
        $this->nome_curso = $nome_curso;
    }

}
