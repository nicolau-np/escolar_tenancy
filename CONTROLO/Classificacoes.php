<?php

class Classificacoes {

    private $nota;
    private $estado;

    function getNota() {
        return $this->nota;
    }

    function getEstado() {
        return $this->estado;
    }

    function setNota($nota) {
        $this->nota = $nota;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    public function nota10() {
        $this->estado = null;
        try {
            if ($this->nota >= 4.5):
                $this->estado = "apto";
            elseif ($this->nota <= 4):
                $this->estado = "n/apto";
            endif;
        } catch (Exception $ex) {
            echo 'CLASSIFICACOES::nota10 => ' . $ex->getMessage();
        }
        return $this->estado;
    }

    public function nota20() {
        $this->estado = null;
        try {
            if ($this->nota >= 9.5):
                $this->estado = "apto";
            elseif ($this->nota <= 9):
                $this->estado = "n/apto";
            endif;
        } catch (Exception $ex) {
            echo 'CLASSIFICACOES::nota20 => ' . $ex->getMessage();
        }
        return $this->estado;
    }

}
