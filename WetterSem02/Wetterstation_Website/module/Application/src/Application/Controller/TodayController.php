<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Model\Database\Value;

class TodayController extends AbstractActionController
{
    private $valueTable;
    
    public function indexAction()
    {
        //raspi.wetterstation@gmail.com
        //d.salchner@tsn.at

        $datei = file("./public/avg_temp.txt");
       
        $values = array();
        $index = 0;
        foreach($datei as $line)
        {
           $line = explode(";", (string)$line);
           $data['temperature'] = (!empty($line[0])) ? $line[0] : null;
           $data['dateTime'] = $line[1];
           $data['windSpeed'] = (!empty($line[2])) ? $line[2] : null;
           $value = new Value();
           $value->exchangeArray($data);
           $values[$index] = $value;
           $index++;
        }
        
        foreach($values as $value){
            if($this->getTableGateway()->getValueWithDateTime($value->DateTime) == false){
                $this->getTableGateway()->addValue($value);
            }
        }
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
