<?php

include_once 'TIPSala.php';

class Sala extends TIPSala {

    private $id_sala;
    private $quant_estudantes;
    private $designacao;

    function getId_sala() {
        return $this->id_sala;
    }

    function getQuant_estudantes() {
        return $this->quant_estudantes;
    }

    function getDesignacao() {
        return $this->designacao;
    }

    function setId_sala($id_sala) {
        $this->id_sala = $id_sala;
    }

    function setQuant_estudantes($quant_estudantes) {
        $this->quant_estudantes = $quant_estudantes;
    }

    function setDesignacao($designacao) {
        $this->designacao = $designacao;
    }

}
