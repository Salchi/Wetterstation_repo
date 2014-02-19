<?php

namespace Application\Model\Forms;

use Zend\Form\Form;

class CompareForm extends Form{
    
    public function __construct($options = null) {
        parent::__construct('CompareForm');
        
        //default timezone
       date_default_timezone_set('Europe/Vienna');
       $this->add(array(
            'name' => 'from1',
            'type' => 'date',
            'options' => array(
                'label' => 'von: ',
            ),
        ));
       
       $this->add(array(
            'name' => 'to1',
            'type' => 'date',
            'options' => array(
                'label' => 'bis: ',
            ),
        ));
       
       $this->add(array(
            'name' => 'from2',
            'type' => 'date',
            'options' => array(
                'label' => 'von: ',
            ),
        ));
       
       $this->add(array(
            'name' => 'to2',
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