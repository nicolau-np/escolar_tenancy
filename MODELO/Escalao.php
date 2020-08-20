<?php

class Escalao {

    private $id_escalao;
    private $nome_escalao;

    function getId_escalao() {
        return $this->id_escalao;
    }

    function getNome_escalao() {
        return $this->nome_escalao;
    }

    function setId_escalao($id_escalao) {
        $this->id_escalao = $id_escalao;
    }

    function setNome_escalao($nome_escalao) {
        $this->nome_escalao = $nome_escalao;
    }

}
