<?php

class TIPSalaDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function buscar_tiposSalas() {
        $this->resposta = null;
        $this->consulta = "select *from tbl_tiposala order by tipo asc";
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

    public function verificar(TIPSala $objTIPSala) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_tiposala where tipo = :tipo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":tipo", $objTIPSala->getTipo(), PDO::PARAM_STR);
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

    public function salvar(TIPSala $objTIPSala) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_tiposala(tipo) values(:tipo)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":tipo", $objTIPSala->getTipo(), PDO::PARAM_STR);
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

}

