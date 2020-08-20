<?php

class Licenca {

    private $id_licence;
    private $licence_cod;
    private $status;
    private $validade;

    function getId_licence() {
        return $this->id_licence;
    }

    function getLicence_cod() {
        return $this->licence_cod;
    }

    function getStatus() {
        return $this->status;
    }

    function getValidade() {
        return $this->validade;
    }

    function setId_licence($id_licence) {
        $this->id_licence = $id_licence;
    }

    function setLicence_cod($licence_cod) {
        $this->licence_cod = $licence_cod;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setValidade($validade) {
        $this->validade = $validade;
    }

}
