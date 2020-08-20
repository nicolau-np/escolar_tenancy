<?php

class HorarioDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function buscarHorarioProf(Funcionario $objFuncionario, Globals $objGlobals) {
        $this->resposta = null;
        $this->consulta = "select DISTINCT turma, sigla, id_disciplina, id_turma from view_horario where agente = :agente and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":agente", $objFuncionario->getAgente(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objGlobals->getAno_lectivo(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function salvar(Horario $objHorario, Sala $objSala, Turma $objTurma, Funcionario $objFuncionario) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_horario(id_disciplina, id_turma, id_sala, id_funcionario, ano_lectivo)"
                . "values(:id_disciplina, :id_turma, :id_sala, :id_funcionario, :ano_lectivo)";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_disciplina", $objHorario->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_turma", $objTurma->getId_turma(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_sala", $objSala->getId_sala(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_funcionario", $objFuncionario->getId_funcionario(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objHorario->getAno_lectivo(), PDO::PARAM_INT);
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

    public function verificar(Horario $objHorario, Sala $objSala, Turma $objTurma, Funcionario $objFuncionario) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_horario where id_disciplina = :id_disciplina and "
                . "id_turma = :id_turma and id_sala = :id_sala and id_funcionario = :id_funcionario"
                . " and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_disciplina", $objHorario->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_turma", $objTurma->getId_turma(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_sala", $objSala->getId_sala(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_funcionario", $objFuncionario->getId_funcionario(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objHorario->getAno_lectivo(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo $ex->getMessage() . " === aqui";
        }
        return $this->resposta;
    }


    public function Prof_VS_disciplinas(Horario $objHorario, Turma $objTurma, Funcionario $objFuncionario) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_horario where id_disciplina = :id_disciplina "
                . "and id_turma = :id_turma and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_disciplina", $objHorario->getId_disciplina(), PDO::PARAM_INT);
            $this->comando->bindValue(":id_turma", $objTurma->getId_turma(), PDO::PARAM_INT);
            $this->comando->bindValue(":ano_lectivo", $objHorario->getAno_lectivo(), PDO::PARAM_INT);
            $this->comando->execute();
            $this->view = $this->comando->fetch(PDO::FETCH_OBJ);
            if ($this->comando && $this->comando->rowCount() > 0):
                $this->resposta = "no";
            elseif ($this->comando && $this->comando->rowCount() <= 0):
                $this->resposta = "yes";
            endif;
        } catch (PDOException $ex) {
            echo '' . $ex;
        }
        return $this->resposta;
    }

    public function buscaHora_pro(Funcionario $objFuncionario, Globals $objGlobals) {
        $this->resposta = null;
        $this->consulta = "select *from view_horario where id_funcionario = :id_funcionario and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_funcionario", $objFuncionario->getId_funcionario(), PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $objGlobals->getAno_lectivo(), PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function buscar_professores($turma, $ano_lectivo, $nome_disciplina) {
        $this->resposta = null;
        $this->consulta = "select *from view_horario where turma = :turma "
                . "and ano_lectivo = :ano_lectivo and nome_disciplina = :nome_disciplina";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":turma", $turma, PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $ano_lectivo, PDO::PARAM_INT);
            $this->comando->bindValue(":nome_disciplina", $nome_disciplina, PDO::PARAM_STR);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function buscar_horario($turma, $ano_lectivo, $dia_semana, $hora_entrada) {
        $this->resposta = null;
        $this->consulta = "select *from view_horario where turma = :turma "
                . "and dia_semana = :dia_semana and hora_entrada = :hora_entrada "
                . "and ano_lectivo = :ano_lectivo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":turma", $turma, PDO::PARAM_STR);
            $this->comando->bindValue(":dia_semana", $dia_semana, PDO::PARAM_STR);
            $this->comando->bindValue(":hora_entrada", $hora_entrada, PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $ano_lectivo, PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }
    
    public function buscar_horarioTA($turma, $ano_lectivo) {
        $this->resposta = null;
        $this->consulta = "select DISTINCT hora_entrada, hora_saida from view_horario where turma = :turma "
                . "and ano_lectivo = :ano_lectivo order by hora_entrada asc";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":turma", $turma, PDO::PARAM_STR);
            $this->comando->bindValue(":ano_lectivo", $ano_lectivo, PDO::PARAM_INT);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }

}










