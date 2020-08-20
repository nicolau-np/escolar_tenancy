<?php

class EscalaoDAO extends Conexao{
    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function buscarEscalao($escalao) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_escalao where nome_escalao = :nome_escalao";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":nome_escalao", $escalao, PDO::PARAM_STR);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (Exception $ex) {
            echo '' . $ex->getMessage();
        }

        return $this->resposta;
    }
    
        public function buscarEscaloes() {
        $this->resposta = null;
        $this->consulta = "select *from tbl_escalao order by nome_escalao asc";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (Exception $ex) {
            echo '' . $ex->getMessage();
        }

        return $this->resposta;
    }
    
            public function salvar(Escalao $objEscalao) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_escalao (nome_escalao) values (:nome_escalao)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":nome_escalao", $objEscalao->getNome_escalao(), PDO::PARAM_STR);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (Exception $ex) {
            echo '' . $ex->getMessage();
        }

        return $this->resposta;
    }
    
       public function verificar(Escalao $objEscalao) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_escalao where nome_escalao = :nome_escalao";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":nome_escalao", $objEscalao->getNome_escalao(), PDO::PARAM_STR);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (Exception $ex) {
            echo '' . $ex->getMessage();
        }

        return $this->resposta;
    }
}



