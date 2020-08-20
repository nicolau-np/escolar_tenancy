<?php

include_once 'Usuario.php';

class Senha extends Usuario {

    private $id_senha;
    private $senha;

    function getId_senha() {
        return $this->id_senha;
    }

    function getSenha() {
        return $this->senha;
    }

    function setId_senha($id_senha) {
        $this->id_senha = $id_senha;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

}
