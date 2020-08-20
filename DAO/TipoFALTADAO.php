<?php

class TipoFALTADAO extends Conexao{

    public function buscar() {
        $this->resposta = null;
        $this->consulta = "select *from tbl_tipo_faltas";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->execute();
            if($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->desligar();
        }catch(PDOException $ex){
            echo 'TipoFALTA::buscar ==> '.$ex;
        }
        return $this->resposta;
    }
    
}
