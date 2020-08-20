<?php

class Cargo {
    
    private $id_cargo;
    private $cargo;
    
    function getId_cargo() {
        return $this->id_cargo;
    }

    function getCargo() {
        return $this->cargo;
    }

    function setId_cargo($id_cargo) {
        $this->id_cargo = $id_cargo;
    }

    function setCargo($cargo) {
        $this->cargo = $cargo;
    }



}
