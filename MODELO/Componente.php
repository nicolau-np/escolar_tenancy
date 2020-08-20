<?php

class Componente {

    private $id_componente;
    private $componente;

    function getId_componente() {
        return $this->id_componente;
    }

    function getComponente() {
        return $this->componente;
    }

    function setId_componente($id_componente) {
        $this->id_componente = $id_componente;
    }

    function setComponente($componente) {
        $this->componente = $componente;
    }

}
