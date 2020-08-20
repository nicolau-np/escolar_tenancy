<?php

require_once 'Disciplinas.php';

class Horario extends Disciplinas {
    
  private $id_horario;
  private $ano_lectivo;

  function getId_horario() {
      return $this->id_horario;
  }

  function getAno_lectivo() {
      return $this->ano_lectivo;
  }

  function setId_horario($id_horario) {
      $this->id_horario = $id_horario;
  }

  function setAno_lectivo($ano_lectivo) {
      $this->ano_lectivo = $ano_lectivo;
  }


}
