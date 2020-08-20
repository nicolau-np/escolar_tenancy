<?php

class PessoaDAO extends Conexao
{

    function __construct($base_dados)
    {
        $this->base_dados = $base_dados;
    }


    public function verificar(Pessoa $objPessoa)
    {
        $this->resposta = null;
        $this->consulta = "select *from tbl_pessoa where bilhete = :bilhete";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":bilhete", $objPessoa->getBilhete(), PDO::PARAM_STR);
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

    public function verificar2(Pessoa $objPessoa)
    {
        $this->resposta = null;
        $this->consulta = "select *from tbl_pessoa where nome = :nome and data_nascimento = :data_nascimento";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":nome", $objPessoa->getNome(), PDO::PARAM_STR);
            $this->comando->bindValue(":data_nascimento", $objPessoa->getData_nascimento(), PDO::PARAM_STR);
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

    public function verificarIdentidade(Pessoa $objPessoa)
    {
        $this->resposta = null;
        $this->consulta = "select *from tbl_pessoa where bilhete = :bilhete or nome = :nome";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":bilhete", $objPessoa->getBilhete(), PDO::PARAM_STR);
            $this->comando->bindValue(":nome", $objPessoa->getNome(), PDO::PARAM_STR);
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

    public function salvar(Pessoa $objPessoa)
    {
        $this->resposta = null;
        $con = $this->ligar();
        $this->consulta = "insert into tbl_pessoa (nome, data_nascimento, genero, estado_civil, "
            . "naturalidade, id_provincia, id_municipio, telefone, bilhete, data_emissao, "
            . "local_emissao, pai, mae, idade, comuna)"
            . " values(:nome, :data_nascimento, :genero, :estado_civil, "
            . ":naturalidade, :id_provincia, :id_municipio, :telefone, :bilhete, :data_emissao, "
            . ":local_emissao, :pai, :mae, :idade, :comuna)";
        try {
            $this->comando = $con->prepare($this->consulta);
            $this->comando->bindValue(":nome", $objPessoa->getNome(), PDO::PARAM_STR);
            $this->comando->bindValue(":data_nascimento", $objPessoa->getData_nascimento(), PDO::PARAM_STR);
            $this->comando->bindValue(":genero", $objPessoa->getGenero(), PDO::PARAM_STR);
            $this->comando->bindValue(":estado_civil", $objPessoa->getEstado_civil(), PDO::PARAM_STR);
            $this->comando->bindValue(":naturalidade", $objPessoa->getNaturalidade(), PDO::PARAM_STR);
            $this->comando->bindValue(":id_provincia", $objPessoa->getId_provincia(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_municipio", $objPessoa->getId_municipio(), PDO::PARAM_INT);
            $this->comando->bindValue(":telefone", $objPessoa->getTelefone(), PDO::PARAM_STR);
            $this->comando->bindValue(":bilhete", $objPessoa->getBilhete(), PDO::PARAM_STR);
            $this->comando->bindValue(":data_emissao", $objPessoa->getData_emissao(), PDO::PARAM_STR);
            $this->comando->bindValue(":local_emissao", $objPessoa->getLocal_emissao(), PDO::PARAM_STR);
            $this->comando->bindValue(":pai", $objPessoa->getPai(), PDO::PARAM_STR);
            $this->comando->bindValue(":mae", $objPessoa->getMae(), PDO::PARAM_STR);
            $this->comando->bindValue(":idade", $objPessoa->getIdade(), PDO::PARAM_INT);
            $this->comando->bindValue(":comuna", $objPessoa->getComuna(), PDO::PARAM_STR);
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

}




