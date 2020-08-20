<?php

class EstudanteDAO extends Conexao {
    
    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }
    
    public function search($nome_estudante) {
        $this->resposta = null;
        $this->consulta = "select *from view_estudante where nome LIKE '$nome_estudante%' "
                . " or nome_curso LIKE '$nome_estudante%' or classe LIKE '$nome_estudante%' "
                . "or turma LIKE '$nome_estudante%' order by nome asc";
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
    
    public function buscar_estudante() {
        $this->resposta = null;
        $this->consulta = "select *from view_estudante order by nome asc";
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
    
    public function verificar(Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_estudante where id_pessoa = :id_pessoa";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_pessoa", $objEstudante->getId_pessoa(), PDO::PARAM_INT);
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

        public function salvar(Estudante $objEstudante, Turno $objTurno) {
        $this->resposta = null;
            $con = $this->ligar();
        $this->consulta = "insert into tbl_estudante (id_pessoa, id_curso, id_classe, id_turma, data_cadastro, data_modificacao, ano_lectivo) "
                . "values (:id_pessoa, :id_curso, :id_classe, :id_turma, :data_cadastro, :data_modificacao, :ano_lectivo)";
        try {
            $this->comando = $con->prepare($this->consulta);
            $this->comando->bindValue(":id_pessoa", $objEstudante->getId_pessoa(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_curso", $objTurno->getId_curso(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_classe", $objTurno->getId_classe(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_turma", $objTurno->getId_turma(), PDO::PARAM_INT);
            $this->comando->bindValue(":data_cadastro", $objEstudante->getData_cadastro(), PDO::PARAM_STR);
            $this->comando->bindValue(":data_modificacao", $objEstudante->getData_modificacao(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objEstudante->getAno_lectivo(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $con->lastInsertId();
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        
        return $this->resposta;
    }
    
    public function updateTurma(Estudante $objEstudante, Turma $objTurma) {
        $this->resposta = null;
        $this->consulta = "update tbl_estudante set id_turma = :id_turma where "
                . "id_estudante = :id_estudante and ano_lectivo = :ano_lectivo";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_turma", $objTurma->getId_turma(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objEstudante->getAno_lectivo(), PDO::PARAM_STR);
            $this->comando->execute();
            if($this->comando):
                $this->resposta = "yes";
            endif;
            $this->desligar();
                    
        } catch (PDOException $ex) {
            echo ''.$ex->getMessage();
        }
        return $this->resposta;
    }
    
        public function buscarEstudantes_turma(Estudante $objEstudante, Turma $objTurma) {
        $this->resposta = null;
        $this->consulta = "select *from view_estudante where turma = :turma"
                . " and ano_lectivo = :ano_lectivo order by nome asc";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":turma", $objTurma->getTurma(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objEstudante->getAno_lectivo(), PDO::PARAM_INT);
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
    
       public function buscarEst_Cur_cla(Estudante $objEstudante, Classes $objClasses) {
        $this->resposta = null;
        $this->consulta = "select *from view_estudante where nome_curso = :nome_curso "
                . "and classe = :classe and ano_lectivo = :ano_lectivo order by nome asc";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":nome_curso", $objClasses->getNome_curso(), PDO::PARAM_STR);
            $this->comando->bindValue(":classe", $objClasses->getClasse(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objEstudante->getAno_lectivo(), PDO::PARAM_INT);
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

    public function estudante_paginacao($inicio, $registros) {
        $this->resposta = null;
        $this->consulta = "select *from view_estudante order by nome asc limit $inicio,$registros";
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
    
        public function ver_estudante(Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "select *from view_estudante where id_estudante = :id_estudante and "
                . "ano_lectivo = :ano_lectivo";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objEstudante->getAno_lectivo(), PDO::PARAM_INT);
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







