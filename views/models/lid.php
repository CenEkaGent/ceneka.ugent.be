<?php

class Lid {
    public $naam;
    public $voornaam;
    public $faculteit;
    public $richting;
    public $studentennummer;
    public $email;
    public $opmerkingen;
    public $id;

    function __construct() {
        $this->id = (int)$this->id;
    }
}

?>