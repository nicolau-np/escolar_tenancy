<?php

class Estilos {

    private $estilo;
    private $estado;

    function getEstilo() {
        return $this->estilo;
    }

    function getEstado() {
        return $this->estado;
    }

    public function nota20($nota) {
        $this->estilo = null;
        try {
            if ($nota >= 9.5):
                $this->estilo = "muito_bom";
            elseif ($nota <= 9.49):
                $this->estilo = "mau";
            endif;
        } catch (Exception $ex) {
            echo 'ESTILOS::nota20 ==>' . $ex->getMessage();
        }
        return $this->estilo;
    }

    public function nota10($nota) {
        $this->estilo = null;
        try {
            if ($nota >= 4.5):
                $this->estilo = "muito_bom";
            elseif ($nota <= 4.49):
                $this->estilo = "mau";
            endif;
        } catch (Exception $ex) {
            echo 'ESTILOS::nota10 ==>' . $ex->getMessage();
        }
        return $this->estilo;
    }

    public function nota_qualitativa($nota) {
        $this->estilo = null;
        $this->estado = null;
        try {
            if ((round($nota) == 1) || (round($nota) == 2)):
                $this->estilo = "mau";
                $this->estado = "MAU";
            elseif ((round($nota) == 3) || (round($nota) == 4)):
                $this->estilo = "mediuque";
                $this->estado = "MEDÍUCRE";
            elseif ((round($nota) == 5) || (round($nota) == 6)):
                $this->estilo = "sufice";
                $this->estado = "SÚFICE";
            elseif ((round($nota) == 7) || (round($nota) == 8)):
                $this->estilo = "bom";
                $this->estado = "BOM";
            elseif ((round($nota) == 9) || (round($nota) == 10)):
                $this->estilo = "muito_bom";
                $this->estado = "MUITO BOM";
            else:
                $this->estilo = "nada";
                $this->estado = "###";
            endif;
        } catch (Exception $ex) {
            echo 'ESTILOS::nota_qualitativa ==>' . $ex->getMessage();
        }
        return $this->estilo;
    }

}












