<?php

class ComponenteDAO extends Conexao{
    
    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function salvar(Componente $objComponente){
        $this->resposta = null;
        $this->consulta = "insert into tbl_componente (componente) values(:componente)";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":componente", $objComponente->getComponente(), PDO::PARAM_STR);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = "yes";
            endif;
            $this->desligar();
        }catch(PDOException $ex){
            echo ''.$ex->getMessage();
        }
        return $this->resposta;
    }

    public function buscarComponentes(){
        $this->resposta = null;
        $this->consulta = "select *from tbl_componente";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo ''.$ex->getMessage();
        }
        return $this->resposta;
    }

    public function buscar_ID(Componente $objComponente){
        $this->resposta = null;
        $this->consulta = "select *from tbl_componente where componente = :componente";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":componente", $objComponente->getComponente(), PDO::PARAM_STR);
            $this->comando->execute();
            if($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo ''.$ex->getMessage();
        }
        return $this->resposta;
    }

}
