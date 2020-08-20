<?php

class DirectorDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function verificar(Director $objDirector, Funcionario $objFuncionario) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_director where id_funcionario = :id_funcionario "
                . "and id_turma = :id_turma and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_funcionario", $objFuncionario->getId_funcionario(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_turma", $objDirector->getId_turma(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objDirector->getAno_lectivo(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function salvar(Director $objDirector, Funcionario $objFuncionario) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_director (id_funcionario, id_turma, ano_lectivo)"
                . "values(:id_funcionario, :id_turma, :ano_lectivo)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_funcionario", $objFuncionario->getId_funcionario(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_turma", $objDirector->getId_turma(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objDirector->getAno_lectivo(), PDO::PARAM_INT);
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

    public function verificar_turma(Director $objDirector) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_director where id_turma = :id_turma "
                . "and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_turma", $objDirector->getId_turma(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objDirector->getAno_lectivo(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function verificar_prof(Director $objDirector, Funcionario $objFuncionario) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_director where id_funcionario = :id_funcionario "
                . "and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_funcionario", $objFuncionario->getId_funcionario(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objDirector->getAno_lectivo(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function buscar_turma(Director $objDirector, Funcionario $objFuncionario) {
        $this->resposta = null;
        $this->consulta = "select *from view_director where id_funcionario = :id_funcionario "
                . "and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_funcionario", $objFuncionario->getId_funcionario(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objDirector->getAno_lectivo(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }
    
    public function buscar_directores() {
        $this->resposta = null;
        $this->consulta = "select *from view_director order by ano_lectivo desc";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }

}


