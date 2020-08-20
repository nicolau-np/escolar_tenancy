<?php

class SalaDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function buscarsalas() {
        $this->resposta = null;
        $this->consulta = "select *from view_salas";
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

    public function verificar(Sala $objSala) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_sala where id_tiposala = :id_tiposala and"
                . " designacao = :designacao";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_tiposala", $objSala->getId_tiposala(), PDO::PARAM_INT);
            $this->comando->bindValue(":designacao", $objSala->getDesignacao(), PDO::PARAM_STR);
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

    public function salvar(Sala $objSala) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_sala (id_tiposala, quant_estudantes, designacao) "
                . "values(:id_tiposala, :quant_estudantes, :designacao)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_tiposala", $objSala->getId_tiposala(), PDO::PARAM_INT);
            $this->comando->bindValue(":quant_estudantes", $objSala->getQuant_estudantes(), PDO::PARAM_INT);
            $this->comando->bindValue(":designacao", $objSala->getDesignacao(), PDO::PARAM_STR);
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
    
    public function search($sala) {
        $this->resposta = null;
        $this->consulta = "select *from view_salas where designacao LIKE '$sala%' "
                . "or tipo LIKE '$sala%' or quant_estudantes LIKE '$sala%'";
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


    public function busca_ID(Sala $objSala) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_sala where designacao = :designacao";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":designacao", $objSala->getDesignacao(), PDO::PARAM_STR);
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
