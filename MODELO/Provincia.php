<?php

class Provincia {

    private $id_provincia;
    private $provincia;

    function getId_provincia() {
        return $this->id_provincia;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function setId_provincia($id_provincia) {
        $this->id_provincia = $id_provincia;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

}
