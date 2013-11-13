<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Database\Value;

class TodayController extends AbstractActionController
{
    private $valueTable;
    
    public function indexAction()
    {
            
        //$values = array(4,4.2,4.6,5,6,7,8,9,10.6,11.8,12.6,13.3,13.8,14.2,14.5,14.3,13.8,13.4,12.2,11,9.8,9,8.6,8.3);
       
        return array('values' => $this->getTableGateway()->fetchAll());
    }
    
     public function getTableGateway(){
        if (!$this->valueTable) {
            $sm = $this->getServiceLocator();
            $this->valueTable = $sm->get('Application\Model\Database\ValueTable');
        }
        return $this->valueTable;
    }
}

?>
