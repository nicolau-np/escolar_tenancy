<?php

class TurnoDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function salvar(Turno $objTurno) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_turno (turno) values (:turno)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":turno", $objTurno->getTurno(), PDO::PARAM_STR);
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

    public function verificarTurno(Turno $objTurno) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_turno where turno = :turno";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":turno", $objTurno->getTurno(), PDO::PARAM_STR);
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

    public function buscarTurnos() {
        $this->resposta = null;
        $this->consulta = "select *from tbl_turno";
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

    public function busca_ID(Turno $objTurno) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_turno where turno = :turno";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":turno", $objTurno->getTurno(), PDO::PARAM_STR);
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
