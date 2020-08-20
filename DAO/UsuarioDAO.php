<?php

class UsuarioDAO extends Conexao {

    function __construct($base_dados) {
        $this->base_dados = $base_dados;
    }

    public function buscar_usuarios() {
        $this->resposta = null;
        $this->consulta = "select *from view_usuarios order by nome asc";
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

    public function search($nome_usuario) {
        $this->resposta = null;
        $this->consulta = "select *from view_usuarios where nome_usuario LIKE '$nome_usuario%' order by nome_usuario asc";
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

    public function verificar(Usuario $objUsuario) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_usuario where id_funcionario = :id_funcionario";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_funcionario", $objUsuario->getId_funcionario(), PDO::PARAM_INT);
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

    public function salvar(Usuario $objUsuario) {
        $this->resposta = null;
        $con = $this->ligar();
        $this->consulta = "insert into tbl_usuario (id_funcionario, nome_usuario, estado) "
                . "values(:id_funcionario, :nome_usuario, :estado)";
        try {
            $this->comando = $con->prepare($this->consulta);
            $this->comando->bindValue(":id_funcionario", $objUsuario->getId_funcionario(), PDO::PARAM_INT);
            $this->comando->bindValue(":nome_usuario", $objUsuario->getNome_usuario(), PDO::PARAM_STR);
            $this->comando->bindValue(":estado", $objUsuario->getEstado(), PDO::PARAM_STR);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $con->lastInsertId();
            endif;
            $this->desligar();
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function localisarUsuario(Senha $objSenha) {
        $this->resposta = null;
        $this->consulta = "select *from view_usuarios where nome_usuario = :nome_usuario "
                . "and senha = :senha";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":nome_usuario", $objSenha->getNome_usuario(), PDO::PARAM_STR);
            $this->comando->bindValue(":senha", $objSenha->getSenha(), PDO::PARAM_STR);
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

    public function buscarID_funcionario(Usuario $objUsuario) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_usuario where id_usuario = :id_usuario";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_usuario", $objUsuario->getId_usuario(), PDO::PARAM_INT);
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

    public function buscarID_usuario(Usuario $objUsuario) {
        $this->resposta = null;
        $this->consulta = "select *from tbl_usuario where id_funcionario = :id_funcionario";
        try {
            $this->comando = $this->ligar()->prepare($this->consulta);
            $this->comando->bindValue(":id_funcionario", $objUsuario->getId_funcionario(), PDO::PARAM_INT);
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

    public function buscar_nomeUS(Usuario $objUsuario) {
        $this->resposta = null;
        $this->consulta = "select *from view_usuarios where id_usuario = " . $objUsuario->getId_usuario() . "";
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

    
        public function usuarios_paginacao($inicio, $registros) {
        $this->resposta = null;
        $this->consulta = "select *from view_usuarios order by nome asc limit $inicio, $registros";
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





