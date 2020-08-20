<?php

class Alertas {

    private $alerta;

    public function sucesso() {
        try {
            $this->alerta = "<div class='alert alert-success'>Feito com sucesso!</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function existencia() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Já foi registrado</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function licenca_errada() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Erro no nº de Licença</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function codigo_escolar() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Escola ou Nº do código já registrado</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function licenca_usada() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Licença já em uso</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function upload_feito() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Já fez o upload de tabelas</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function ficheiro_inexistente() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Ficheiro de upload inexistente</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function erro_codigoEscola() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Erro no código escolar</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function licenca_caducada() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Licença escolar no estado de caducidade</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function erro_usuario() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Usuário ou senha incorrectos</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function usuario_bloqueado() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Usuário temporáriamente bloqueado</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function nome_turmaIgual() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Já existe uma turma com este nome</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function turma_cadastrada() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Turma já cadastrada</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function disciplina_cadastrada() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Disciplina já cadastrada</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function disciplina_cadastrada_curso() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Disciplina já cadastrada para este curso e classe</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function hora_cadastrada() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Hora já cadastrada</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function sala_cadastrada() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Sala já cadastrada</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function agente_existente() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Número de Agente já existe</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function bilhete_existente() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Número de Bilhete já eixte</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function curso_existente() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Já cadastrou este curso</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function deve_selecionaDisciplinas() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Deve selecionar disciplinas</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function horario_cadastrado() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Já cadastrou esse horário</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function professor_indisponivel() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Professor indisponível neste tempo</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function sala_indisponivel() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Sala indisponível neste tempo</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function disciplina_oucupada_prof() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Para esta disciplina e nesta turma já exite um outro professor</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

    public function passe_errada() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Palavra-passe actual errada</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }
    
        public function confirmacao_errada() {
        try {
            $this->alerta = "<div class='alert alert-danger'>Erro na confirmação da palavra-passe</div>";
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->alerta;
    }

}


