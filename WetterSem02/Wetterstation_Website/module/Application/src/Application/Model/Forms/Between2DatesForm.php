<?php

namespace Application\Model\Forms;

use Zend\Form\Form;

class Between2DatesForm extends Form{
    
    public function __construct($options = null) {
        parent::__construct('Between2DatesForm');
        
        //default timezone
        date_default_timezone_set('Europe/Vienna');
       $this->add(array(
            'name' => 'from',
            'type' => 'date',
            'options' => array(
                'label' => 'von: ',
            ),
        ));
       
       $this->add(array(
            'name' => 'to',
            'type' => 'date',
            'options' => array(
                'label' => 'bis: ',
            ),
        ));
       
       $this->add(array(
            'name' => 'submitButton',
            'type' => 'submit',
            'attributes' => array(
                'id' => 'submitButton',
                'value' => 'anzeigen',
            ),
        ));
        
    }
}
?>