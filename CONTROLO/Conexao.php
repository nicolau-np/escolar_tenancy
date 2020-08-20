<?php

class Conexao {

//atributos protegidos
    protected $view;
    protected $comando;
    protected $consulta;
    protected $resposta;
    protected $base_dados;
    
	//atributos privados
    private $conn;
    private $tipo = "mysql";
    private $servidor = "localhost";
    private $porta = "3306";
    private $usuario = "jose";
    private $senha = "Np@2015b";

	//evitar clonagem 
    private function __clone() {
        
    }

	//abrir a conexao com o banco
    public function ligar() {
        try {
            $this->conn = new PDO($this->tipo . ":host=" . $this->servidor . ";port=" . $this->porta . ";dbname=" . $this->base_dados, $this->usuario, $this->senha);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo 'e' . $ex;
        }
        return $this->conn;
    }

	//fechar a conexao com o banco
    public function desligar() {
        try {
            $this->conn = null;
        } catch (PDOException $ex) {
            echo 'e' . $ex;
        }
        return $this->conn;
    }

}
