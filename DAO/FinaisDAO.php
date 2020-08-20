<?php

class FinaisDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function salvar(Finais $objFinais, Estudante $objEstudantes) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_notasfinais(id_estudante, id_disciplina, cap, cpe, cf, estado, ano_lectivo)"
                . " values(:id_estudante, :id_disciplina, :cap, :cpe, :cf, :estado, :ano_lectivo)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objEstudantes->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objFinais->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":cap", $objFinais->getCap(), PDO::PARAM_STR);
            $this->comando->bindValue(":cpe", $objFinais->getCpe(), PDO::PARAM_STR);
            $this->comando->bindValue(":cf", $objFinais->getCf(), PDO::PARAM_STR);
            $this->comando->bindValue(":estado", $objFinais->getEstado(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objFinais->getAno_lectivoF(), PDO::PARAM_STR);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'FINAIS::salvar = > ' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function verificar(Finais $objFinais, Estudante $objEstudantes) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_notasfinais where id_estudante = :id_estudante "
                . "and id_disciplina = :id_disciplina and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objEstudantes->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objFinais->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objFinais->getAno_lectivoF(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'FINAIS::verificar => ' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function updateCAP(Finais $objFinais, Estudante $objEstudantes) {
        $this->resposta = null;
        $this->consulta = "update tbl_notasfinais set cap = :cap where id_estudante = :id_estudante "
                . "and id_disciplina = :id_disciplina and ano_lectivo = :ano_lectivo";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":cap", $objFinais->getCap(), PDO::PARAM_STR);
            $this->comando->bindValue(":id_estudante", $objEstudantes->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objFinais->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objFinais->getAno_lectivoF(), PDO::PARAM_INT);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'FINAIS::updateCAP => '.$ex->getMessage();
        }
        return $this->resposta;
        
    }

    public function update(Finais $objFinais, $campo, $valor) {
        $this->resposta = null;
        $this->consulta = "update tbl_notasfinais set $campo = :valor, data_lancamento = :data_lancamento "
                . "where id_notasfinais = :id_notasfinais";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":valor", $valor, PDO::PARAM_STR);
            $this->comando->bindValue(":data_lancamento", $objFinais->getData_lancamento(), PDO::PARAM_STR);
            $this->comando->bindValue(":id_notasfinais", $objFinais->getId_notasfinais(), PDO::PARAM_INT);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'FINAIS::update => '.$ex->getMessage();
        }
        return $this->resposta;
    }

    public function updateCF(Finais $objFinais, Estudante $objEstudantes) {
      $this->resposta = null;
        $this->consulta = "update tbl_notasfinais set cf = :cf, estado = :estado "
                . "where id_estudante = :id_estudante and id_disciplina = :id_disciplina "
                . "and ano_lectivo = :ano_lectivo";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":cf", $objFinais->getCf(), PDO::PARAM_STR);
            $this->comando->bindValue(":estado", $objFinais->getEstado(), PDO::PARAM_STR);
            $this->comando->bindValue(":id_estudante", $objEstudantes->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objFinais->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objFinais->getAno_lectivoF(), PDO::PARAM_INT);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'FINAIS::updateCF => '.$ex->getMessage();
        }
        return $this->resposta;  
    }
    
    public function buscarNotas(Finais $objFinais, $turma) {
        $this->resposta = null;
        $this->consulta = "select *from view_notasfinais where turma = :turma and "
                . "nome_disciplina = :nome_disciplina and ano_lectivo = :ano_lectivo "
                . "order by nome asc";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":turma", $turma, PDO::PARAM_STR);
            $this->comando->bindValue(":nome_disciplina", $objFinais->getNome_disciplina(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objFinais->getAno_lectivoF(), PDO::PARAM_INT);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'FINAIS::buscarNotas ==> '.$ex->getMessage();
        }
        return $this->resposta;
    }
    
    public function buscarEstudante(Finais $objFinais) {
        $this->resposta = null;
        $this->consulta = "select *from view_notasfinais where id_notasfinais = :id_notasfinais";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_notasfinais", $objFinais->getId_notasfinais(), PDO::PARAM_INT);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'FINAIS::buscarEstudante ==> '.$ex->getMessage();
        }
        return $this->resposta;
    }
    
    public function search_nota(Finais $objFinais, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "select *from view_notasfinais where "
                . "id_estudante = :id_estudante and nome_disciplina = :nome_disciplina "
                . "and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":nome_disciplina", $objFinais->getNome_disciplina(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objFinais->getAno_lectivoF(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'FINAIS::search_nota ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }
    
    public function search_nota2(Finais $objFinais, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "select *from view_notasfinais where "
                . "id_estudante = :id_estudante and id_disciplina = :id_disciplina "
                . "and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objFinais->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objFinais->getAno_lectivoF(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'FINAIS::search_nota ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }
    
        public function consultar_nota(Finais $objFinais, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "select *from view_notasfinais where id_estudante = :id_estudante "
                . "and nome_disciplina = :nome_disciplina and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":nome_disciplina", $objFinais->getNome_disciplina(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objFinais->getAno_lectivoF(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'FINAIS::search_nota ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }

}




































