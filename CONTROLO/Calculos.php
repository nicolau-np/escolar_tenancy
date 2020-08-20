<?php

class Calculos {

    private $capC;
    private $cfC;
    private $cpeC;
    private $macC;
    private $cppC;
    private $ctC;

    function getCapC() {
        return $this->capC;
    }

    function getCfC() {
        return $this->cfC;
    }

    function getCpeC() {
        return $this->cpeC;
    }

    function getMacC() {
        return $this->macC;
    }

    function getCtC() {
        return $this->ctC;
    }

    function getCppC() {
        return $this->cppC;
    }

    function setCapC($capC) {
        $this->capC = $capC;
    }

    function setCfC($cfC) {
        $this->cfC = $cfC;
    }

    function setCpeC($cpeC) {
        $this->cpeC = $cpeC;
    }

    function setMacC($macC) {
        $this->macC = $macC;
    }

    function setCtC($ctC) {
        $this->ctC = $ctC;
    }

    function setCppC($cppC) {
        $this->cppC = $cppC;
    }

    public function calcular_mac($soma_ava, $numero_ava) {
        $this->macC = null;
        try {
            $this->macC = ($soma_ava / $numero_ava);
        } catch (Exception $ex) {
            echo "Calculos::calcular_mac => " . $ex;
        }
        return $this->macC;
    }

    public function calcular_cpp($soma_pro, $numero_pro) {
        $this->cppC = null;
        try {
            $this->cppC = ($soma_pro / $numero_pro);
        } catch (Exception $ex) {
            echo "Calculos::calcular_cpp => " . $ex;
        }
        return $this->cppC;
    }

    public function calcular_cap($soma_ct) {
        $this->capC = null;
        try {
            $this->capC = ($soma_ct) / 3;
        } catch (Exception $ex) {
            echo "Calculos::calcular_cap => " . $ex;
        }
        return $this->capC;
    }

    public function calcular_cf() {
        $this->cfC = null;
        try {
            $this->cfC = ($this->capC * 0.4) + ($this->cpeC * 0.6);
        } catch (Exception $ex) {
            echo "Calculos::calcular_cf => " . $ex;
        }
        return $this->cfC;
    }

    public function calcular_ct($mac, $cpp) {
        $this->ctC = null;
        try {
            $this->ctC = ($mac + $cpp) / 2;
        } catch (Exception $ex) {
            echo "Calculos::calcular_ct => " . $ex;
        }
        return $this->ctC;
    }

}

