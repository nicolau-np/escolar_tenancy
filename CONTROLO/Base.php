<?php

class Base extends Conexao {

    private $dbtype = "mysql";
    private $host = "localhost";
    private $port = "3306";
    private $user = "jose";
    private $pass = "Np@2015b";
    private $dbname;
    private $conn1;
    private $conn2;

    function getDbname() {
        return $this->dbname;
    }

    function setDbname($dbname) {
        $this->dbname = $dbname;
    }

    public function conectar_banco() {
        try {
            $this->conn2 = new PDO($this->dbtype . ":host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbname, $this->user, $this->pass);
            $this->conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->conn2;
    }

    public function conectar_servidor() {
        try {
            $this->conn1 = new PDO($this->dbtype . ":host=" . $this->host . ";", $this->user, $this->pass);
            $this->conn1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->conn1;
    }

    public function criar() {
        $this->resposta = null;
        $this->consulta = "CREATE DATABASE " . $this->getDbname() . " DEFAULT CHARACTER SET utf8";
        try {
            $this->comando = $this->conectar_servidor()->prepare($this->consulta);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = "yes";
            endif;
            $this->conn1 = null;
        } catch (PDOException $ex) {
            echo '' . $ex;
        }
        return $this->resposta;
    }

    public function verificar_tabelas() {
        $this->resposta = null;
        $this->consulta = "SHOW TABLES";
        try {
            $this->comando = $this->conectar_banco()->prepare($this->consulta);
            $this->comando->execute();
            if ($this->comando):
                $this->resposta = $this->comando;
            endif;
            $this->conn2 = null;
        } catch (PDOException $ex) {
            echo '' . $ex->getMessage();
        }
        return $this->resposta;
    }

    public function importar($banco) {

        $this->resposta = null;
        if (file_exists($banco)):
            $this->consulta = file_get_contents($banco, 4096);
            try {
                $this->comando = $this->conectar_banco()->prepare($this->consulta);
                $this->comando->execute();
                if ($this->comando):
                    $this->resposta = "yes";
                endif;
                $this->conn2 = null;
            } catch (PDOException $ex) {
                echo '' . $ex->getMessage();
            }
        else:
            $this->resposta = "no";
        endif;

        return $this->resposta;
    }

}
