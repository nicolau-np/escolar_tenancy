<?php

class TipoPERDAO extends Conexao{
    
    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function buscar_tiposPermicao() {
        $this->resposta = null;
        $this->consulta = "select *from tbl_tipopermicao";
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
    
        public function buscar_idTipo(PERUsuario $objPERUsuario) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_tipopermicao where tipo = :tipo";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":tipo", $objPERUsuario->getTipo(), PDO::PARAM_STR);
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


