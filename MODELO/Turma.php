<?php
include_once 'Classes.php';
class Turma extends Classes {

    private $id_turma;
    private $turma;

    function getId_turma() {
        return $this->id_turma;
    }

    function getTurma() {
        return $this->turma;
    }

    function setId_turma($id_turma) {
        $this->id_turma = $id_turma;
    }

    function setTurma($turma) {
        $this->turma = $turma;
    }

}
