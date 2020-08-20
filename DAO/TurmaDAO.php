<?php

class TurmaDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function pesq($turma) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_turma where turma = :turma";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":turma", $turma, PDO::PARAM_STR);
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

    public function verNome(Turma $objTurno) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_turma where turma = :turma";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":turma", $objTurno->getTurma(), PDO::PARAM_STR);
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

    public function verificarTurma(Turno $objTurno) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_turma where id_curso = :id_curso and "
                . "id_classe = :id_classe and id_turno = :id_turno and turma = :turma";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_curso", $objTurno->getId_curso(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_classe", $objTurno->getId_classe(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_turno", $objTurno->getId_turno(), PDO::PARAM_INT);
            $this->comando->bindValue(":turma", $objTurno->getTurma(), PDO::PARAM_INT);
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

    public function salvar(Turno $objTurno) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_turma (id_curso, id_classe, id_turno, turma) "
                . "values (:id_curso, :id_classe, :id_turno, :turma)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_curso", $objTurno->getId_curso(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_classe", $objTurno->getId_classe(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_turno", $objTurno->getId_turno(), PDO::PARAM_INT);
            $this->comando->bindValue(":turma", $objTurno->getTurma(), PDO::PARAM_STR);
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

    public function buscaTurmas() {
        $this->resposta = null;
        $this->consulta = "select *from view_turma order by classe asc";
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

    public function buscarTurma_ID(Turma $objTurma) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_turma where id_turma = :id_turma";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_turma", $objTurma->getId_turma(), PDO::PARAM_INT);
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

    public function buscarTurma_ID2(Turma $objTurma) {
        $this->resposta = null;
        $this->consulta = "select *from view_turma where id_turma = :id_turma";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_turma", $objTurma->getId_turma(), PDO::PARAM_INT);
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

    public function busca_ID(Turma $objTurma) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_turma where turma = :turma";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":turma", $objTurma->getTurma(), PDO::PARAM_STR);
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

    public function buscaTurma_cla_curso(Classes $objClasses) {
        $this->resposta = null;
        $this->consulta = "select *from view_turma where nome_curso = :nome_curso "
                . "and classe = :classe";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":nome_curso", $objClasses->getNome_curso(), PDO::PARAM_STR);
            $this->comando->bindValue(":classe", $objClasses->getClasse(), PDO::PARAM_STR);
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

    public function search($nome_turma) {
        $this->resposta = null;
        $this->consulta = "select *from view_turma where turma LIKE '$nome_turma%' "
                . "or nome_curso LIKE '$nome_turma%' or turno LIKE '$nome_turma%' or"
                . " classe LIKE '$nome_turma%'";
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

    public function Turmas_paginacao($inicio, $resgistros) {
        $this->resposta = null;
        $this->consulta = "select *from view_turma order by classe asc limit $inicio, $resgistros";
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

}

