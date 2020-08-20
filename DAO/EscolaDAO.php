<?php

class EscolaDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function salvar(Escola $escola) {
        $this->resposta = null;
        $this->consulta = "insert into schools (id_school, id_licence, nome, "
                . "province, city, distrit, dbname, logo_image, phone, date_cad) "
                . "values (:id_school, :id_licence, :nome, :province, :city, "
                . ":distrit, :dbname, :logo_image, :phone, :date_cad)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_school", $escola->getId_school(), PDO::PARAM_STR);
            $this->comando->bindValue(":id_licence", $escola->getId_licence(), PDO::PARAM_INT);
            $this->comando->bindValue(":nome", $escola->getNome(), PDO::PARAM_STR);
            $this->comando->bindValue(":province", $escola->getProvince(), PDO::PARAM_STR);
            $this->comando->bindValue(":city", $escola->getCity(), PDO::PARAM_STR);
            $this->comando->bindValue(":distrit", $escola->getDistrit(), PDO::PARAM_STR);
            $this->comando->bindValue(":dbname", $escola->getDbname(), PDO::PARAM_STR);
            $this->comando->bindValue(":logo_image", $escola->getLogo_image(), PDO::PARAM_STR);
            $this->comando->bindValue(":phone", $escola->getPhone(), PDO::PARAM_STR);
            $this->comando->bindValue(":date_cad", $escola->getDate_cad(), PDO::PARAM_STR);
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

    public function verificar(Escola $escola) {
        $this->resposta = null;
        $this->consulta = "select *from schools where id_school = :id_school or nome = :nome";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_school", $escola->getId_school(), PDO::PARAM_STR);
            $this->comando->bindValue(":nome", $escola->getNome(), PDO::PARAM_STR);
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

    public function consultaEscola(Escola $objEscola) {
        $this->resposta = null;
        $this->consulta = "select *from schools where id_school = :id_school";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_school", $objEscola->getId_school(), PDO::PARAM_STR);
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
