<?php


class FaltasPROFESSORDAO extends Conexao{

    public function salvar(FaltasPROFESSOR $objFaltaPROFESSOR, TipoFALTA $objTipoFALTA) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_faltaspr (id_funcionario, id_tipo_falta, "
                . "data_marcacao, estado, ano_lectivo) "
                . "values(:id_funcionario, :id_tipo_falta, :data_marcacao, :estado, :ano_lectivo)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_funcionario", $objFaltaPROFESSOR->getId_funcionario(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_tipo_falta", $objTipoFALTA->getId_tipo_falta(), PDO::PARAM_INT);
            $this->comando->bindValue(":data_marcacao", $objFaltaPROFESSOR->getData_marcacao(), PDO::PARAM_STR);
            $this->comando->bindValue(":estado", $objFaltaPROFESSOR->getEstado(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objFaltaPROFESSOR->getAno_lectivo(), PDO::PARAM_INT);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'FaltasPROFESSORES::salvar ==> '.$ex; 
        }
        return $this->resposta;
    }
    
    public function justificar(FaltasPROFESSOR $objFaltaPROFESSOR) {
        $this->resposta = null;
        $this->consulta = "update tbl_faltaspr set estado = :estado where id_faltaPr = :id_faltaPr";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":estado", $objFaltaPROFESSOR->getEstado(), PDO::PARAM_STR);
            $this->comando->bindValue(":id_faltaPr", $objFaltaPROFESSOR->getId_faltaPr(), PDO::PARAM_INT);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'FaltasPROFESSOR::justificar ==> '.$ex;
        }
        return $this->resposta;
    }
    
}




