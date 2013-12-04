<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class TodayController extends AbstractActionController
{
    private $valueTable;
    
    public function indexAction()
    {
        $timestamp = time();
        $actDate = date("Y-m-d 00:00:00",$timestamp);
        $nextDay = date("Y-m-d 00:00:00",$timestamp+86400);
        return array('values' => $this->getTableGateway()->getValuesBetween($actDate,$nextDay));
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
