<?php

class BloqueioDAO extends Conexao{
    
    public function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function update(Bloqueio $objBloqueio) {
        $this->resposta = null;
        $this->consulta = "update tbl_bloqueios set estado = :estado, data_modificacao = :data_modificacao"
                . " where epoca = :epoca";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":estado", $objBloqueio->getEstado(), PDO::PARAM_STR);
            $this->comando->bindValue(":data_modificacao", $objBloqueio->getData_modificacao(), PDO::PARAM_STR);
            $this->comando->bindValue(":epoca", $objBloqueio->getEpoca(), PDO::PARAM_STR);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = "yes";
            endif;
            $this->desligar();
        }catch(PDOException $ex){
        echo 'BloqueioDAO::update==>'.$ex;
        }
        return $this->resposta;
    }
    
    public function verificar(Bloqueio $objBloqueio) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_bloqueios where epoca = :epoca";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":epoca", $objBloqueio->getEpoca(), PDO::PARAM_STR);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = $this->comando;
            endif;
            $this->desligar();
        }catch(PDOException $ex){
            echo 'BloqueioDAO::verifivcar==>'.$ex;
        }
        return $this->resposta;
    }
    
        public function buscar() {
        $this->resposta = null;
        $this->consulta = "select *from tbl_bloqueios";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = $this->comando;
            endif;
            $this->desligar();
        }catch(PDOException $ex){
            echo 'BloqueioDAO::buscar==>'.$ex;
        }
        return $this->resposta;
    }
    
    
}








