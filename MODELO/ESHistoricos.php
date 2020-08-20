<?php

include_once 'Estudante.php';

class ESHistoricos extends Estudante {

    private $id_eshistorico;
    private $estado;
    private $ano_lectivo2;

    function getId_eshistorico() {
        return $this->id_eshistorico;
    }

    function getEstado() {
        return $this->estado;
    }

    function getAno_lectivo2() {
        return $this->ano_lectivo2;
    }

    function setId_eshistorico($id_eshistorico) {
        $this->id_eshistorico = $id_eshistorico;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setAno_lectivo2($ano_lectivo2) {
        $this->ano_lectivo2 = $ano_lectivo2;
    }


}
