<?php

class Application {
    public $id;
    public $description;
    public $title;
    public $type;
    public $fullDescription;
    public $requirements;
    public $logo;
    public $companyURI;
    public $duration;
    public $topics;
    public $company;
    public $location;

    function __construct() {
        $this->id = (int)$this->id;
    }
}

?>