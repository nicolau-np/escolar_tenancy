<?php

class MunicipioDAO extends Conexao {
    
    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

        public function buscarMunicipio(Municipio $objMunicipio) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_municipio where id_provincia = :id_provincia "
                . "order by municipio asc";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_provincia", $objMunicipio->getId_provincia(), PDO::PARAM_INT);
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
    
       public function verificar(Municipio $objMunicipio) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_municipio where id_provincia = :id_provincia "
                . "and municipio = :municipio";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_provincia", $objMunicipio->getId_provincia(), PDO::PARAM_INT);
            $this->comando->bindValue(":municipio", $objMunicipio->getMunicipio(), PDO::PARAM_STR);
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
    
    public function salvar(Municipio $objMunicipio) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_municipio(id_provincia, municipio) "
                . "values(:id_provincia, :municipio)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_provincia", $objMunicipio->getId_provincia(), PDO::PARAM_INT);
            $this->comando->bindValue(":municipio", $objMunicipio->getMunicipio(), PDO::PARAM_STR);
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

}




