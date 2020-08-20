<?php

class Conversao {

    private $nota_compreensao;
    private $nota_extensao;

    function getNota_compreensao() {
        return $this->nota_compreensao;
    }

    function getNota_extensao() {
        return $this->nota_extensao;
    }

    function setNota_compreensao($nota_compreensao) {
        $this->nota_compreensao = $nota_compreensao;
    }

    function setNota_extensao($nota_extensao) {
        $this->nota_extensao = $nota_extensao;
    }

    public function converter() {
        $this->nota_compreensao = null;
        try {
            if ($this->nota_compreensao == 0):
                $this->nota_extensao = "Zero";
            elseif ($this->nota_compreensao == 1):
                $this->nota_extensao = "Um valor";
            elseif ($this->nota_compreensao == 2):
                $this->nota_extensao = "Dois valores";
            elseif ($this->nota_compreensao == 3):
                $this->nota_extensao = "Três valores";
            elseif ($this->nota_compreensao == 4):
                $this->nota_extensao = "Quatro valores";
            elseif ($this->nota_compreensao == 5):
                $this->nota_extensao = "Cinco valores";
            elseif ($this->nota_compreensao == 6):
                $this->nota_extensao = "Seis valores";
            elseif ($this->nota_compreensao == 7):
                $this->nota_extensao = "Sete valores";
            elseif ($this->nota_compreensao == 8):
                $this->nota_extensao = "Oito valores";
            elseif ($this->nota_compreensao == 9):
                $this->nota_extensao = "Nove valores";
            elseif ($this->nota_compreensao == 10):
                $this->nota_extensao = "Dez valores";
            elseif ($this->nota_compreensao == 11):
                $this->nota_extensao = "Onze valores";
            elseif ($this->nota_compreensao == 12):
                $this->nota_extensao = "Doze valores";
            elseif ($this->nota_compreensao == 13):
                $this->nota_extensao = "Treze valores";
            elseif ($this->nota_compreensao == 14):
                $this->nota_extensao = "Catorze valores";
            elseif ($this->nota_compreensao == 15):
                $this->nota_extensao = "Quinze valores";
            elseif ($this->nota_compreensao == 16):
                $this->nota_extensao = "Dezasseis valores";
            elseif ($this->nota_compreensao == 17):
                $this->nota_extensao = "Dezassete valores";
            elseif ($this->nota_compreensao == 18):
                $this->nota_extensao = "Dezoito valores";
            elseif ($this->nota_compreensao == 19):
                $this->nota_extensao = "Dezanove valores";
            elseif ($this->nota_compreensao == 20):
                $this->nota_extensao = "Vinte valores";
            endif;
        } catch (Exception $ex) {
            echo 'CONVERSAO::converter => ' . $ex->getMessage();
        }
        return $this->nota_extensao;
    }

}
