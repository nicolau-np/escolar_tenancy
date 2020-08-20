<?php

include_once 'TipoPER.php';

class PERUsuario extends TipoPER {

    private $id_perusuario;

    function getId_perusuario() {
        return $this->id_perusuario;
    }

    function setId_perusuario($id_perusuario) {
        $this->id_perusuario = $id_perusuario;
    }

}

