<?php

class FuncionarioDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

        public function search($nome_funcionario) {
        $this->resposta = null;
        $this->consulta = "select *from view_funcionario where nome LIKE '$nome_funcionario%'"
                . " or cargo LIKE '$nome_funcionario%' or nome_escalao LIKE '$nome_funcionario%'";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (Exception $ex) {
            echo '' . $ex->getMessage();
        }

        return $this->resposta;
    }
    
    public function verificar(Funcionario $objFuncionario) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_funcionario where agente = :agente";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":agente", $objFuncionario->getAgente(), PDO::PARAM_STR);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (Exception $ex) {
            echo '' . $ex->getMessage();
        }

        return $this->resposta;
    }

    public function buscar_funcionarios() {
        $this->resposta = null;
        $this->consulta = "select *from view_funcionario";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (Exception $ex) {
            echo '' . $ex->getMessage();
        }

        return $this->resposta;
    }

    public function salvar(Funcionario $objFuncionario, Cargo $objCargo, Escalao $objEscalao) {
        $this->resposta = null;
        $con = $this->ligar();
        $this->consulta = "insert into tbl_funcionario (id_pessoa, id_cargo, id_escalao, "
                . "agente, data_cadastro, data_modificacao)"
                . " values(:id_pessoa, :id_cargo, :id_escalao, :agente, :data_cadastro, :data_modificacao)";
        try {
            $this->comando = $con->prepare($this->consulta);
            $this->comando->bindValue(":id_pessoa", $objFuncionario->getId_pessoa(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_cargo", $objCargo->getId_cargo(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_escalao", $objEscalao->getId_escalao(), PDO::PARAM_INT);
            $this->comando->bindValue(":agente", $objFuncionario->getAgente(), PDO::PARAM_STR);
            $this->comando->bindValue(":data_cadastro", $objFuncionario->getData_cadastro(), PDO::PARAM_STR);
            $this->comando->bindValue(":data_modificacao", $objFuncionario->getData_modificacao(), PDO::PARAM_STR);
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
    
        public function buscar_funcionarioID(Funcionario $objFuncionario) {
        $this->resposta = null;
        $this->consulta = "select *from view_funcionario where id_funcionario = :id_funcionario";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_funcionario", $objFuncionario->getId_funcionario(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (Exception $ex) {
            echo '' . $ex->getMessage();
        }

        return $this->resposta;
    }


    public function buscar_ID(Funcionario $objFuncionario) {
        $this->resposta = null;
        $this->consulta = "select *from view_funcionario where nome = :nome";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":nome", $objFuncionario->getNome(), PDO::PARAM_STR);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (Exception $ex) {
            echo '' . $ex->getMessage();
        }

        return $this->resposta;
    }
    
            public function buscar_IDPessoa(Funcionario $objFuncionario) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_funcionario where id_pessoa = :id_pessoa";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_pessoa", $objFuncionario->getId_pessoa(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (Exception $ex) {
            echo '' . $ex->getMessage();
        }

        return $this->resposta;
    }
    
    public function funcionarios_paginacao($inicio, $registros) {
        $this->resposta = null;
        $this->consulta = "select *from view_funcionario order by nome asc limit $inicio, $registros";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (Exception $ex) {
            echo '' . $ex->getMessage();
        }

        return $this->resposta;
    }    

}










