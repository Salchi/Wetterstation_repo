<?php

namespace Application\Model\Forms;

use Zend\Form\Form;
use Zend\Form\Element;

class DayNightForm extends Form{
    
    public function __construct($options = null) {
        parent::__construct('DayNightForm');
        
        $element = new Element\Select('time');
        $element->setValueOptions(array(
           '0' => 'Tag',
           '1' => 'Nacht',
        ));
        $element->setAttribute('id', 'DayNightSelect');
    
        $this->add($element);
    }
}
?>