<?php

class DesistenciaDAO extends Conexao{
    
    public function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function salvar(Pessoa $objPessoa, Desistencia $objDesistencia) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_desistencias(id_pessoa, id_tipo_desistencia, "
                . "motivo, data_desistencia, ano_lectivo) "
                . "values(:id_pessoa, :id_tipo_desistencia, :motivo, :data_desistencia, :ano_lectivo)";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_pessoa", $objPessoa->getId_pessoa(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_tipo_desistencia", $objDesistencia->getId_tipo_desistencia(), PDO::PARAM_INT);
            $this->comando->bindValue(":motivo", $objDesistencia->getMotivo(), PDO::PARAM_STR);
            $this->comando->bindValue(":data_desistencia", $objDesistencia->getData_desistencia(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objDesistencia->getAno_lectivo());
            $this->comando->execute();
            if($this->comando):
            $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex){
            echo 'DesistenciaDAO::salvar==>'.$ex;
        }
        return $this->resposta;
    }
    
    
}





