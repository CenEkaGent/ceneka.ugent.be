<?php

class Event {
    public $id;
    public $name;
    public $shortName;
    public $description;
    public $teaser;
    public $info;
    public $startTime;
    public $endTime;
    public $images;
    public $location;
    public $locationUrl;
    public $facebookUrl;
    public $longDescription;
    public $canSubscribe;

    function __construct() {
        $this->id = (int)$this->id;
        $this->images = explode(';', $this->images);
    }
}

?>