<?php

include "EpocaDis.php";

class DISCurso extends EpocaDis{

    private $id_discurso;

    function getId_discurso() {
        return $this->id_discurso;
    }

    function setId_discurso($id_discurso) {
        $this->id_discurso = $id_discurso;
    }

}
