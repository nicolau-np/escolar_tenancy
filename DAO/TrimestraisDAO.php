<?php

class TrimestraisDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function salvar(Trimestrais $objTrimestrais, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_notastrimestrais(id_estudante, id_disciplina, epoca, mac, cpp, ct, ano_lectivo)"
                . " values(:id_estudante, :id_disciplina, :epoca, :mac, :cpp, :ct, :ano_lectivo)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objTrimestrais->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":epoca", $objTrimestrais->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":mac", $objTrimestrais->getMac(), PDO::PARAM_STR);
            $this->comando->bindValue(":cpp", $objTrimestrais->getCpp(), PDO::PARAM_STR);
            $this->comando->bindValue(":ct", $objTrimestrais->getCt(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objTrimestrais->getAno_lectivoT(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo "TRIMESTRAIS::salvar => " . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function verificar(Trimestrais $objTrimestrais, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_notastrimestrais where id_estudante = :id_estudante and "
                . "id_disciplina = :id_disciplina and epoca = :epoca and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objTrimestrais->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":epoca", $objTrimestrais->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objTrimestrais->getAno_lectivoT(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo "TRIMESTRAIS::verificar => " . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function updateMac(Trimestrais $objTrimestrais, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "update tbl_notastrimestrais set mac = :mac "
                . "where id_estudante = :id_estudante and id_disciplina = :id_disciplina "
                . "and epoca = :epoca and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":mac", $objTrimestrais->getMac(), PDO::PARAM_STR);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objTrimestrais->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":epoca", $objTrimestrais->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objTrimestrais->getAno_lectivoT(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo "TRIMESTRAIS::updateMac => " . $ex->getMessage();
        }
        return $this->resposta;
    }
    
    public function updateCpp(Trimestrais $objTrimestrais, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "update tbl_notastrimestrais set cpp = :cpp, data_lancamento = :data_lancamento "
                . "where id_estudante = :id_estudante and id_disciplina = :id_disciplina "
                . "and epoca = :epoca and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":cpp", $objTrimestrais->getCpp(), PDO::PARAM_STR);
            $this->comando->bindValue(":data_lancamento", $objTrimestrais->getData_lancamento(), PDO::PARAM_STR);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objTrimestrais->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":epoca", $objTrimestrais->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objTrimestrais->getAno_lectivoT(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo "TRIMESTRAIS::updateCpp => " . $ex->getMessage();
        }
        return $this->resposta;
    }
    
    public function updateCt(Trimestrais $objTrimestrais, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "update tbl_notastrimestrais set ct = :ct "
                . "where id_estudante = :id_estudante and id_disciplina = :id_disciplina "
                . "and epoca = :epoca and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":ct", $objTrimestrais->getCt(), PDO::PARAM_STR);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objTrimestrais->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":epoca", $objTrimestrais->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objTrimestrais->getAno_lectivoT(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = "yes";
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo "TRIMESTRAIS::updateCt => " . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function buscarNotas(Trimestrais $objTrimestrais, $turma) {
        $this->resposta = null;
        $this->consulta = "select *from view_notastrimestrais where epoca = :epoca and turma = :turma "
                . "and nome_disciplina = :nome_disciplina and ano_lectivo = :ano_lectivo order by nome asc";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":epoca", $objTrimestrais->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":turma", $turma, PDO::PARAM_STR);
            $this->comando->bindValue(":nome_disciplina", $objTrimestrais->getNome_disciplina(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objTrimestrais->getAno_lectivoT(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'TRIMESTRAIS::buscarNotas ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }
    
        public function buscarNotas_femenino(Trimestrais $objTrimestrais, $turma) {
        $genero = "F";
        $genero2 = "Femenino";
        $this->resposta = null;
        $this->consulta = "select *from view_notastrimestrais where epoca = :epoca and turma = :turma "
                . "and nome_disciplina = :nome_disciplina and (genero = :genero or genero = :genero2) and ano_lectivo = :ano_lectivo order by nome asc";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":epoca", $objTrimestrais->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":turma", $turma, PDO::PARAM_STR);
            $this->comando->bindValue(":nome_disciplina", $objTrimestrais->getNome_disciplina(), PDO::PARAM_STR);
            $this->comando->bindValue(":genero", $genero, PDO::PARAM_STR);
            $this->comando->bindValue(":genero2", $genero2, PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objTrimestrais->getAno_lectivoT(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'TRIMESTRAIS::buscarNotas_femenino ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }
    
        public function buscarNotas_masculino(Trimestrais $objTrimestrais, $turma) {
        $genero = "M";
        $genero2 = "Masculino";
        $this->resposta = null;
        $this->consulta = "select *from view_notastrimestrais where epoca = :epoca and turma = :turma "
                . "and nome_disciplina = :nome_disciplina and (genero = :genero or genero = :genero2) and ano_lectivo = :ano_lectivo order by nome asc";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":epoca", $objTrimestrais->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":turma", $turma, PDO::PARAM_STR);
            $this->comando->bindValue(":nome_disciplina", $objTrimestrais->getNome_disciplina(), PDO::PARAM_STR);
            $this->comando->bindValue(":genero", $genero, PDO::PARAM_STR);
            $this->comando->bindValue(":genero2", $genero2, PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objTrimestrais->getAno_lectivoT(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'TRIMESTRAIS::buscarNotas_masculino ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function buscarEstudante(Trimestrais $objTrimestrais) {
        $this->resposta = null;
        $this->consulta = "select *from view_notastrimestrais where "
                . "id_notastrimestrais = :id_notastrimestrais";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue("id_notastrimestrais", $objTrimestrais->getId_notastrimestrais(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
        } catch (PDOException $ex) {
            echo 'TRIMESTRAIS::buscarEstudante ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function somarCT(Trimestrais $objTrimestrais, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "select sum(ct) from view_notastrimestrais where "
                . "id_estudante = :id_estudante and id_disciplina = :id_disciplina "
                . "and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objTrimestrais->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objTrimestrais->getAno_lectivoT(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando->fetchColumn();
            endif;
        } catch (PDOException $ex) {
            echo 'TRIMESTRAIS::somarCT ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }
    
        public function search_nota(Trimestrais $objTrimestrais, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "select *from view_notastrimestrais where epoca = :epoca and "
                . "id_estudante = :id_estudante and nome_disciplina = :nome_disciplina "
                . "and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":epoca", $objTrimestrais->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":nome_disciplina", $objTrimestrais->getNome_disciplina(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objTrimestrais->getAno_lectivoT(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'TRIMESTRAIS::search_nota ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function search_nota2(Trimestrais $objTrimestrais, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "select *from view_notastrimestrais where epoca = :epoca and "
            . "id_estudante = :id_estudante and id_disciplina = :id_disciplina "
            . "and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":epoca", $objTrimestrais->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_disciplina", $objTrimestrais->getId_disciplina(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objTrimestrais->getAno_lectivoT(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'TRIMESTRAIS::search_nota ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }
    
            public function consultar_nota(Trimestrais $objTrimestrais, Estudante $objEstudante) {
        $this->resposta = null;
        $this->consulta = "select *from view_notastrimestrais where epoca = :epoca and "
                . "id_estudante = :id_estudante and nome_disciplina = :nome_disciplina "
                . "and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":epoca", $objTrimestrais->getEpoca(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_estudante", $objEstudante->getId_estudante(), PDO::PARAM_INT);
            $this->comando->bindValue(":nome_disciplina", $objTrimestrais->getNome_disciplina(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objTrimestrais->getAno_lectivoT(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo 'TRIMESTRAIS::search_nota ==> ' . $ex->getMessage();
        }
        return $this->resposta;
    }

}











































