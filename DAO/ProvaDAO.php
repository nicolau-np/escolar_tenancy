<?php

class ProvaDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function salvar(Prova $objProva, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_prova(id_estudante, id_disciplina, epoca, valor1, data_valor1, "
                . "valor2, data_valor2, ano_lectivo) "
                . "values(:id_estudante, :id_disciplina, :epoca, :valor1, :data_valor1, :valor2, :data_valor2, "
                . ":ano_lectivo) ";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objProva->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":epoca", $objProva->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":valor1", $objProva->getValor1(), PDO::PARAM_STR);
            $this->comando->bindValue(":data_valor1", $objProva->getData_valor1(), PDO::PARAM_STR);
            $this->comando->bindValue(":valor2", $objProva->getValor2(), PDO::PARAM_STR);
            $this->comando->bindValue(":data_valor2", $objProva->getData_valor2(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objProva->getAno_lectivoP(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'PROVA::salvar ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function verificar(Prova $objProva, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_prova where id_estudante = :id_estudante and "
                . "id_disciplina = :id_disciplina and epoca = :epoca and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objProva->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":epoca", $objProva->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objProva->getAno_lectivoP(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo "PROVA::verificar => " . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function update(Prova $objProva, $campo, $valor, $data) {
        $outro_campo = "data_" . $campo;
        $this->resposta = null;
        $this->consulta = "update tbl_prova set $campo = :valor, $outro_campo = :data_valor "
                . "where id_prova = :id_prova";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":valor", $valor, PDO::PARAM_STR);
            $this->comando->bindValue(":data_valor", $data, PDO::PARAM_STR);
            $this->comando->bindValue(":id_prova", $objProva->getId_prova(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo "PROVA::update => " . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function buscarNotas(Prova $objProva, $turma) {
        $this->resposta = null;
        $this->consulta = "select *from view_prova where epoca = :epoca and turma = :turma "
                . "and nome_disciplina = :nome_disciplina and ano_lectivo = :ano_lectivo order by nome asc";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":epoca", $objProva->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":turma", $turma, PDO::PARAM_STR);
            $this->comando->bindValue(":nome_disciplina", $objProva->getNome_disciplina(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objProva->getAno_lectivoP(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'PROVA::buscarNotas ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function buscarEstudante(Prova $objProva) {
        $this->resposta = null;
        $this->consulta = "select *from view_prova where "
                . "id_prova = :id_prova";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue("id_prova", $objProva->getId_prova(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
        } catch (PDOException $ex) {
            echo 'PROVA::buscarEstudante ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }

}
