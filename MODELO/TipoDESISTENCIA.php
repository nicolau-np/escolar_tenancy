<?php

class TipoDESISTENCIA {

    private $id_tipo_desistencia;
    private $tipo;

    function getId_tipo_desistencia() {
        return $this->id_tipo_desistencia;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setId_tipo_desistencia($id_tipo_desistencia) {
        $this->id_tipo_desistencia = $id_tipo_desistencia;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

}

