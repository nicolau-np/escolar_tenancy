<?php

class ProvinciaDAO extends Conexao {
    
    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

        public function buscarProvincias() {
        $this->resposta = null;
        $this->consulta = "select *from tbl_provincia order by provincia asc";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
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

}
