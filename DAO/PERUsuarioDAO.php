<?php

class PERUsuarioDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function verificar(PERUsuario $objPERUsuario, Usuario $objUsuario) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_permicaousuario where id_usuario = " . $objUsuario->getId_usuario() . ""
                . "and id_tipopermicao = " . $objPERUsuario->getId_tipopermicao() . "";
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

    public function buscar_permicoesUsuario(Usuario $objUsuario) {
        $this->resposta = null;
        $this->consulta = "select *from view_permicaousuario where id_usuario = " . $objUsuario->getId_usuario() . "";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function buscar_permicoesUsuario2($id_usuario) {
        $this->resposta = null;
        $this->consulta = "select *from view_permicaousuario where id_usuario = " . $id_usuario . "";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function salvar(PERUsuario $objPERUsuario, Usuario $objUsuario) {
        $this->resposta = null;
        $this->consulta = "insert into tbl_permicaousuario (id_usuario, id_tipopermicao) "
                . "values(" . $objUsuario->getId_usuario() . ", " . $objPERUsuario->getId_tipopermicao() . ")";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
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

    public function remover(PERUsuario $objPERUsuario, Usuario $objUsuario) {
        $this->resposta = null;
        $this->consulta = "delete from tbl_permicaousuario where id_usuario = " . $objUsuario->getId_usuario() . " and "
                . "id_tipopermicao = " . $objPERUsuario->getId_tipopermicao() . "";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
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



}


