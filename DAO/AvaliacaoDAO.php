<?php

class AvaliacaoDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function salvar(Avaliacao $objAvaliacao, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_avaliacao(id_estudante, id_disciplina, epoca, valor1, data_valor1, "
                . "valor2, data_valor2, valor3, data_valor3, ano_lectivo) "
                . "values(:id_estudante, :id_disciplina, :epoca, :valor1, :data_valor1, :valor2, :data_valor2, "
                . ":valor3, :data_valor3, :ano_lectivo) ";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objAvaliacao->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":epoca", $objAvaliacao->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":valor1", $objAvaliacao->getValor1(), PDO::PARAM_STR);
            $this->comando->bindValue(":data_valor1", $objAvaliacao->getData_valor1(), PDO::PARAM_STR);
            $this->comando->bindValue(":valor2", $objAvaliacao->getValor2(), PDO::PARAM_STR);
            $this->comando->bindValue(":data_valor2", $objAvaliacao->getData_valor2(), PDO::PARAM_STR);
            $this->comando->bindValue(":valor3", $objAvaliacao->getValor3(), PDO::PARAM_STR);
            $this->comando->bindValue(":data_valor3", $objAvaliacao->getData_valor3(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objAvaliacao->getAno_lectivoA(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'AVALIACAO::salvar ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function verificar(Avaliacao $objAvaliacao, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_avaliacao where id_estudante = :id_estudante and "
                . "id_disciplina = :id_disciplina and epoca = :epoca and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objAvaliacao->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":epoca", $objAvaliacao->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objAvaliacao->getAno_lectivoA(), PDO::PARAM_INT);
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

    public function update(Avaliacao $objAvaliacao, $campo, $valor, $data) {
        $outro_campo = "data_" . $campo;
        $this->resposta = null;
        $this->consulta = "update tbl_avaliacao set $campo = :valor, $outro_campo = :data_valor "
                . "where id_avaliacao = :id_avaliacao";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":valor", $valor, PDO::PARAM_STR);
            $this->comando->bindValue(":data_valor", $data, PDO::PARAM_STR);
            $this->comando->bindValue(":id_avaliacao", $objAvaliacao->getId_avaliacao(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo "AVALIACAO::update => " . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function buscarNotas(Avaliacao $objAvaliacao, $turma) {
        $this->resposta = null;
        $this->consulta = "select *from view_avaliacao where epoca = :epoca and turma = :turma "
                . "and nome_disciplina = :nome_disciplina and ano_lectivo = :ano_lectivo order by nome asc";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":epoca", $objAvaliacao->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":turma", $turma, PDO::PARAM_STR);
            $this->comando->bindValue(":nome_disciplina", $objAvaliacao->getNome_disciplina(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objAvaliacao->getAno_lectivoA(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'AVALIACAO::buscarNotas ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function buscarEstudante(Avaliacao $objAvaliacao) {
        $this->resposta = null;
        $this->consulta = "select *from view_avaliacao where "
                . "id_avaliacao = :id_avaliacao";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue("id_avaliacao", $objAvaliacao->getId_avaliacao(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
        } catch (PDOException $ex) {
            echo 'AVALIACAO::buscarEstudante ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }

}





