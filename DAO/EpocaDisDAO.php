<?php

class EpocaDisDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function buscarEpocas() {
        $this->resposta = null;
        $this->consulta = "select *from tbl_epocadis";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
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
