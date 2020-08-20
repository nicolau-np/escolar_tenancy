<?php
include_once 'Turma.php';

class Director extends Turma{
    
    private $id_director;
    private $ano_lectivo;
    
    function getId_director() {
        return $this->id_director;
    }

    function getAno_lectivo() {
        return $this->ano_lectivo;
    }

    function setId_director($id_director) {
        $this->id_director = $id_director;
    }

    function setAno_lectivo($ano_lectivo) {
        $this->ano_lectivo = $ano_lectivo;
    }

}



