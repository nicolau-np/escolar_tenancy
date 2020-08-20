<?php

class LicencaDAO extends Conexao {

    private $uso1 = "sim";

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function salvar(Licenca $licenca) {
        $this->resposta = null;
        $this->consulta = "";
        try {
            
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
    }

    public function verificar($licenca) {
        $this->resposta = null;
        $this->consulta = "select *from licences where 	licence_cod = :licence_cod";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":licence_cod", $licenca, PDO::PARAM_STR);
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

    public function muda_uso($id_licenca) {
        $this->resposta = null;
        $this->consulta = "update licences set uses = :uses where id_licence = :id_licence";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":uses", $this->uso1, PDO::PARAM_STR);
            $this->comando->bindValue(":id_licence", $id_licenca, PDO::PARAM_INT);
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

    public function statusLicenca(Licenca $objLicenca) {
        $this->resposta = null;
        $this->consulta = "select *from licences where id_licence = :id_licence";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_licence", $objLicenca->getId_licence(), PDO::PARAM_INT);
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
