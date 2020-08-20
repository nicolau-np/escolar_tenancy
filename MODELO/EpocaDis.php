<?php

class EpocaDis {

    private $id_epocaDis;
    private $tipo;

    function getId_epocaDis() {
        return $this->id_epocaDis;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setId_epocaDis($id_epocaDis) {
        $this->id_epocaDis = $id_epocaDis;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

}
