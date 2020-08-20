<?php

class Desistencia extends TipoDESISTENCIA{

    private $id_desistencia;
    private $motivo;
    private $data_desistencia;
    private $ano_lectivo;

    function getId_desistencia() {
        return $this->id_desistencia;
    }

    function getMotivo() {
        return $this->motivo;
    }

    function getData_desistencia() {
        return $this->data_desistencia;
    }

    function getAno_lectivo() {
        return $this->ano_lectivo;
    }

    function setId_desistencia($id_desistencia) {
        $this->id_desistencia = $id_desistencia;
    }

    function setMotivo($motivo) {
        $this->motivo = $motivo;
    }

    function setData_desistencia($data_desistencia) {
        $this->data_desistencia = $data_desistencia;
    }

    function setAno_lectivo($ano_lectivo) {
        $this->ano_lectivo = $ano_lectivo;
    }

}





