<?php


class ClassesDAO extends Conexao
{

    function __construct($base_dados)
    {
        $this->base_dados = $base_dados;
    }


    public function buscarClasses()
    {
        $this->resposta = null;
        $this->consulta = "select *from tbl_classe";
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

    public function buscarClasse_ID(Classes $objClasses)
    {
        $this->resposta = null;
        $this->consulta = "select *from tbl_classe where id_classe = :id_classe";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
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

    public function buscarClasses_porCurso(Classes $objClasses)
    {
        $this->resposta = null;
        $this->consulta = "select *from tbl_classe where id_curso=:id_curso";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_curso", $objClasses->getId_curso(), PDO::PARAM_INT);
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

    public function verificarClasse(Classes $objClasses)
    {
        $this->resposta = null;
        $this->consulta = "select *from tbl_classe where id_curso = :id_curso and classe = :classe ";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_curso", $objClasses->getId_curso(), PDO::PARAM_INT);
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

    public function salvar(Classes $objClasses)
    {
        $this->resposta = null;
        $this->consulta = "insert into tbl_classe (id_curso, classe) "
            . "values(:id_curso, :classe)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_curso", $objClasses->getId_curso(), PDO::PARAM_INT);
            $this->comando->bindValue(":classe", $objClasses->getClasse(), PDO::PARAM_STR);
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

    public function busca_ID(Classes $objClasses)
    {
        $this->resposta = null;
        $this->consulta = "select *from tbl_classe where classe = :classe";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
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


    public function busca_ID_curso_classe(Classes $objClasses)
    {
        $this->resposta = null;
        $this->consulta = "select *from view_classe where classe = :classe and nome_curso = :nome_curso";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":classe", $objClasses->getClasse(), PDO::PARAM_STR);
            $this->comando->bindValue(":nome_curso", $objClasses->getNome_curso(), PDO::PARAM_STR);
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

