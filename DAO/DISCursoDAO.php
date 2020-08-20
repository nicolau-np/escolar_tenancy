<?php

class DISCursoDAO extends Conexao
{

    function __construct($base_dados)
    {
        $this->base_dados = $base_dados;
    }

    public function verificar(Curso $objCurso, DISCurso $objDISCurso, Classes $objClasses, Disciplinas $objDisciplinas)
    {
        $this->resposta = null;
        $this->consulta = "select *from tbl_disccurso where id_curso = :id_curso and "
            . "id_disciplina = :id_disciplina and id_classe = :id_classe and "
            . "id_epocaDis = :id_epocaDis";

        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_curso", $objCurso->getId_curso(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objDisciplinas->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_classe", $objClasses->getId_classe(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_epocaDis", $objDISCurso->getId_epocaDis(), PDO::PARAM_INT);
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

    public function salvar(Curso $objCurso, DISCurso $objDISCurso, Classes $objClasses, Disciplinas $objDisciplinas)
    {
        $this->resposta = null;
        $this->consulta = "insert into tbl_disccurso (id_curso, id_disciplina, id_classe, id_epocaDis) "
            . "values(:id_curso, :id_disciplina, :id_classe, :id_epocaDis)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_curso", $objCurso->getId_curso(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objDisciplinas->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_classe", $objClasses->getId_classe(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_epocaDis", $objDISCurso->getId_epocaDis(), PDO::PARAM_INT);
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

    public function buscarDisciplina_ID(Curso $objCurso, Classes $objClasses)
    {
        $this->resposta = null;
        $this->consulta = "select *from tbl_disccurso where id_curso = :id_curso "
            . "and id_classe = :id_classe";

        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_curso", $objCurso->getId_curso(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_classe", $objClasses->getId_classe(), PDO::PARAM_INT);
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

    public function buscarDISC_ID(Disciplinas $objDisciplinas)
    {
        $this->resposta = null;
        $this->consulta = "select *from view_disccurso where id_disciplina = :id_disciplina";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_disciplina", $objDisciplinas->getId_disciplina(), PDO::PARAM_INT);
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

    public function busca()
    {
        $this->resposta = null;
        $this->consulta = "select distinct nome_curso, classe from view_disccurso order by classe asc";
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

    public function conta_disciplinas($nome_curso, $classe)
    {
        $this->resposta = null;
        $this->consulta = "select *from view_disccurso where nome_curso = :nome_curso "
            . "and classe = :classe";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":nome_curso", $nome_curso, PDO::PARAM_STR);
            $this->comando->bindValue(":classe", $classe, PDO::PARAM_STR);
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


    public function Discurso_paginacao($inicio, $resgistros)
    {
        $this->resposta = null;
        $this->consulta = "select distinct nome_curso, classe from view_disccurso order by classe asc limit $inicio, $resgistros";
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


    public function search($curso) {
        $this->resposta = null;
        $this->consulta = "select distinct nome_curso, classe from view_disccurso where nome_curso LIKE '$curso%' "
            . "or classe LIKE '$curso%'";
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

}
