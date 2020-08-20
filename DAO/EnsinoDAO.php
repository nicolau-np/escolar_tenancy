<?php

class EnsinoDAO extends Conexao {
    
    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

        public function verificarEnsino(Ensino $objEnsino) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_ensino where ensino = :ensino";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":ensino", $objEnsino->getEnsino(), PDO::PARAM_STR);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }

        return $this->resposta;
    }

    public function salvar(Ensino $objEnsino) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_ensino (ensino) values (:ensino)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":ensino", $objEnsino->getEnsino(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function buscarEnsinos() {
        $this->resposta = null;
        $this->consulta = "select *from tbl_ensino";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }

        return $this->resposta;
    }

}
