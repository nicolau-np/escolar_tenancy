<?php

class SenhaDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    
    public function salvar(Senha $objSenha) {
        $this->resposta = null;
        $con = $this->ligar();
        $this->consulta = "insert into tbl_senha (id_usuario, senha) "
                . "values (:id_usuario, :senha)";
        try {
            $this->comando = $con->prepare($this->consulta);
            $this->comando->bindValue(":id_usuario", $objSenha->getId_usuario(), PDO::PARAM_INT);
            $this->comando->bindValue(":senha", $objSenha->getSenha(), PDO::PARAM_STR);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $con->lastInsertId();
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }
    
    public function verificar(Senha $objSenha) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_senha where id_usuario = :id_usuario";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_usuario", $objSenha->getId_usuario(), PDO::PARAM_INT);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'SENHA::verificar ==> '.$ex->getMessage();
        }
        return $this->resposta;
    }
    
    public function update(Senha $objSenha) {
        $this->resposta = null;
        $this->consulta = "update tbl_senha set senha = :senha where id_usuario = :id_usuario";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":senha", $objSenha->getSenha(), PDO::PARAM_STR);
            $this->comando->bindValue(":id_usuario", $objSenha->getId_usuario(), PDO::PARAM_INT);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'SENHA::update ==> '.$ex->getMessage();
        }
        return $this->resposta;

    }

}






