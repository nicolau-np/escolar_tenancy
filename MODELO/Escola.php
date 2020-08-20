<?php

include_once 'Licenca.php';

class Escola extends Licenca {

    private $id_school;
    private $nome;
    private $province;
    private $city;
    private $distrit;
    private $dbname;
    private $logo_image;
    private $phone;
    private $date_cad;

    function getId_school() {
        return $this->id_school;
    }

    function getNome() {
        return $this->nome;
    }

    function getProvince() {
        return $this->province;
    }

    function getCity() {
        return $this->city;
    }

    function getDistrit() {
        return $this->distrit;
    }

    function getDbname() {
        return $this->dbname;
    }

    function getLogo_image() {
        return $this->logo_image;
    }

    function getPhone() {
        return $this->phone;
    }

    function getDate_cad() {
        return $this->date_cad;
    }

    function setId_school($id_school) {
        $this->id_school = $id_school;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setProvince($province) {
        $this->province = $province;
    }

    function setCity($city) {
        $this->city = $city;
    }

    function setDistrit($distrit) {
        $this->distrit = $distrit;
    }

    function setDbname($dbname) {
        $this->dbname = $dbname;
    }

    function setLogo_image($logo_image) {
        $this->logo_image = $logo_image;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setDate_cad($date_cad) {
        $this->date_cad = $date_cad;
    }

}
