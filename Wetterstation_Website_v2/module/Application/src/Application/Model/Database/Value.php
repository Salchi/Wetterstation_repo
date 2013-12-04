<?php

namespace Application\Model\Database;

class Value{
    
    public $DateTime;
    public $Temperature;
    public $WindSpeed;
    
    public function exchangeArray($data){    
        $this->DateTime = (!empty($data['dateTime'])) ? $data['dateTime'] : null;
        $this->Temperature = (!empty($data['temperature'])) ? $data['temperature'] : null;
        $this->WindSpeed = (!empty($data['windSpeed'])) ? $data['windSpeed'] : null;
    }
}
?>
