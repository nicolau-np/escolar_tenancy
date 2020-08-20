<?php

include_once 'Funcionario.php';

class Usuario extends Funcionario {

    private $id_usuario;
    private $nome_usuario;
    private $estado;

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getNome_usuario() {
        return $this->nome_usuario;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setNome_usuario($nome_usuario) {
        $this->nome_usuario = $nome_usuario;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

}
