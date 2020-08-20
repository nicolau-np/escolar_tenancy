<?php

class ESHistoricosDAO extends Conexao{
    
    function __construct($base_dados) {
        $this->base_dados = $base_dados;
        
    }
    
    public function verificar(ESHistoricos $objESHistorico) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_historico where id_estudante = :id_estudante "
                . "and ano_lectivo = :ano_lectivo";
      try{
          $this->comando = $this->ligar()->prepare($this->consulta);
          $this->comando->bindValue(":id_estudante", $objESHistorico->getId_estudante(), PDO::PARAM_INT);
          $this->comando->bindValue(":ano_lectivo", $objESHistorico->getAno_lectivo2(), PDO::PARAM_INT);
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
    
    public function salvar(ESHistoricos $objESHistorico, Turno $objTurno){
        $this->resposta = null;
        $this->consulta = "insert into tbl_historico (id_estudante, id_turma, estado, ano_lectivo) "
                . "values(:id_estudante, :id_turma, :estado, :ano_lectivo)";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objESHistorico->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_turma", $objTurno->getId_turma(), PDO::PARAM_INT);
            $this->comando->bindValue(":estado", $objESHistorico->getEstado(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objESHistorico->getAno_lectivo2(), PDO::PARAM_STR);
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
    
    public function updateTurma(ESHistoricos $objESHistorico, Turma $objTurma) {
        $this->resposta = null;
        $this->consulta = "update tbl_historico set id_turma = :id_turma where "
                . "id_estudante = :id_estudante and ano_lectivo = :ano_lectivo";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_turma", $objTurma->getId_turma(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_estudante", $objESHistorico->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objESHistorico->getAno_lectivo2(), PDO::PARAM_STR);
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


}
