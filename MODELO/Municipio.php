<?php

include_once 'Provincia.php';

class Municipio extends Provincia {

    private $id_municipio;
    private $municipio;

    function getId_municipio() {
        return $this->id_municipio;
    }

    function getMunicipio() {
        return $this->municipio;
    }

    function setId_municipio($id_municipio) {
        $this->id_municipio = $id_municipio;
    }

    function setMunicipio($municipio) {
        $this->municipio = $municipio;
    }

}
