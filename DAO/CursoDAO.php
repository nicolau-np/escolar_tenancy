<?php

class CursoDAO extends Conexao {
    
    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

        public function salvar(Curso $objCurso) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_curso (id_ensino, nome_curso) "
                . "values (:id_ensino, :nome_curso)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_ensino", $objCurso->getId_ensino(), PDO::PARAM_INT);
            $this->comando->bindValue(":nome_curso", $objCurso->getNome_curso(), PDO::PARAM_STR);
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

    public function verificarCurso(Curso $objCurso) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_curso where id_ensino = :id_ensino "
                . "and nome_curso = :nome_curso";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_ensino", $objCurso->getId_ensino(), PDO::PARAM_INT);
            $this->comando->bindValue(":nome_curso", $objCurso->getNome_curso(), PDO::PARAM_STR);
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

    public function buscarCursos() {
        $this->resposta = null;
        $this->consulta = "select *from view_curso";
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
    
        public function buscarCursos_paginacao($inicio, $limit) {
        $this->resposta = null;
        $this->consulta = "select *from view_curso limit $inicio, $limit";
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
    
    
        public function buscarCurso_ID(Curso $objCurso) {
        $this->resposta = null;
        $this->consulta = "select *from view_curso where id_curso = :id_curso";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_curso", $objCurso->getId_curso(), PDO::PARAM_INT);
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
    
        public function search($nome_curso) {
        $this->resposta = null;
        $this->consulta = "select *from view_curso where nome_curso LIKE '$nome_curso%' "
                . "or ensino LIKE '$nome_curso%'";
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
    
          public function busca_ID(Curso $objCurso) {
        $this->resposta = null;
        $this->consulta = "select *from view_curso where nome_curso = :nome_curso";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":nome_curso", $objCurso->getNome_curso(), PDO::PARAM_STR);
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

