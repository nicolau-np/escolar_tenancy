<?php

include_once 'Curso.php';

class Classes extends Curso {

    private $id_classe;
    private $classe;

    function getId_classe() {
        return $this->id_classe;
    }

    function getClasse() {
        return $this->classe;
    }

    function setId_classe($id_classe) {
        $this->id_classe = $id_classe;
    }

    function setClasse($classe) {
        $this->classe = $classe;
    }

}
