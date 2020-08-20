<?php

class FaltasALUNODAO extends Conexao {

    public function salvar(FaltasALUNO $objFaltasALUNO, Disciplinas $objDisciplinas, TipoFALTA $objTipoFALTA) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_faltasal (id_estudante, id_disciplina, "
                . "id_tipo_falta, data_marcacao, estado, ano_lectivo)"
                . "values(:id_estudante, :id_disciplina,:id_tipo_falta, "
                . ":data_marcacao, :estado, :ano_lectivo)";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objFaltasALUNO->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objDisciplinas->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_tipo_falta", $objTipoFALTA->getId_tipo_falta(), PDO::PARAM_INT);
            $this->comando->bindValue(":data_marcacao", $objFaltasALUNO->getData_marcacao(), PDO::PARAM_STR);
            $this->comando->bindValue(":estado", $objFaltasALUNO->getEstado(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objFaltasALUNO->getAno_lectivo(), PDO::PARAM_INT);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex){
            echo 'FaltasALUNO::salvar ==> '.$ex;
        }
        return $this->resposta;
    }
    
    public function justificar(FaltasALUNO $objFaltasALUNO) {
        $this->resposta = null;
        $this->consulta = "update tbl_faltasal set estado = :estado where id_faltaAl = :id_faltaAl";
        try{
            $this->comando = $this->ligar()->prepare($this->comando);
            $this->comando->bindValue(":estado", $objFaltasALUNO->getEstado(), PDO::PARAM_STR);
            $this->comando->bindValue(":id_faltaAl", $objFaltasALUNO->getId_faltaAl(), PDO::PARAM_INT);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = "yes";
            endif;
        }catch(PDOException $ex){
            echo 'FaltasALUNO::justificar ==> '.$ex;
        }
        return $this->resposta;
    }

}





