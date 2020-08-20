<?php
include_once 'Turma.php';
class Turno extends Turma{

    private $id_turno;
    private $turno;

    function getId_turno() {
        return $this->id_turno;
    }

    function getTurno() {
        return $this->turno;
    }

    function setId_turno($id_turno) {
        $this->id_turno = $id_turno;
    }

    function setTurno($turno) {
        $this->turno = $turno;
    }

}
