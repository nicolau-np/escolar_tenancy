<?php

class TipoFALTA {
    private $id_tipo_falta;
    private $descricao_falta;
    
    function getId_tipo_falta() {
        return $this->id_tipo_falta;
    }

    function getDescricao_falta() {
        return $this->descricao_falta;
    }

    function setId_tipo_falta($id_tipo_falta) {
        $this->id_tipo_falta = $id_tipo_falta;
    }

    function setDescricao_falta($descricao_falta) {
        $this->descricao_falta = $descricao_falta;
    }


}
