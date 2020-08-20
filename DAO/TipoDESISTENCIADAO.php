<?php


class TipoDESISTENCIADAO extends Conexao{

    public function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }
    
    public function buscar(){
        $this->resposta = null;
        $this->consulta = "select *from tbl_tipo_desistencia";
        try{
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->execute();
            if($this->comando):
            $this->resposta = $this->comando;
            endif;
            $this->desligar();
        }catch(PDOException $ex){
        echo 'TipoDESISTENCIA::buscar==>'.$ex;
        }
        return $this->resposta;
    }
    
}







