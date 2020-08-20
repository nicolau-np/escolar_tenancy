<?php

class DisciplinasDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function salvar(Disciplinas $objDisciplinas) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_disciplina(id_componente, nome_disciplina, sigla) "
                . "values(:id_componente, :nome_disciplina, :sigla)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_componente", $objDisciplinas->getId_componente(), PDO::PARAM_INT);
            $this->comando->bindValue(":nome_disciplina", $objDisciplinas->getNome_disciplina(), PDO::PARAM_STR);
            $this->comando->bindValue(":sigla", $objDisciplinas->getSigla(), PDO::PARAM_STR);
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

    public function verificar(Disciplinas $objDisciplinas) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_disciplina where id_componente = :id_componente "
                . "and nome_disciplina = :nome_disciplina and sigla = :sigla";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_componente", $objDisciplinas->getId_componente(), PDO::PARAM_INT);
            $this->comando->bindValue(":nome_disciplina", $objDisciplinas->getNome_disciplina(), PDO::PARAM_STR);
            $this->comando->bindValue(":sigla", $objDisciplinas->getSigla(), PDO::PARAM_STR);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }
    
    public function buscarDisciplinas() {
        $this->resposta = null;
        $this->consulta = "select *from view_disciplina order by nome_disciplina asc";
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
    
    public function search($disciplina) {
        $this->resposta = null;
        $this->consulta = "select *from view_disciplina where nome_disciplina LIKE '$disciplina%' "
                . "or sigla LIKE '$disciplina%' or componente LIKE '$disciplina%'";
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
    
    public function ID_buscarDisciplina($id){
        $this->resposta = null;
        $this->consulta = "select *from view_disciplina where id_disciplina = :id_disciplina";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_disciplina", $id, PDO::PARAM_INT);
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
    
     public function Disciplinas_paginacao($inicio, $resgistros) {
        $this->resposta = null;
        $this->consulta = "select *from view_disciplina order by nome_disciplina asc limit $inicio, $resgistros";
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


    public function buscar_ID(Disciplinas $objDisciplinas){
        $this->resposta = null;
        $this->consulta = "select *from view_disciplina where nome_disciplina = :nome_disciplina";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":nome_disciplina", $objDisciplinas->getNome_disciplina() , PDO::PARAM_STR);
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


