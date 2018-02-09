<?php

class Registration {
    public $event_id;
    public $leden_id;
    

    function __construct() {
        $this->event_id = (int)$this->event_id;
        $this->leden_id = (int)$this->leden_id;
    }
}

?>