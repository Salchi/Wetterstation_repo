<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class HomeController extends AbstractActionController
{
    private $valueTable;
    
    public function indexAction()
    {
        $values = $this->getTableGateway()->fetchAll();
        $totalAmount = count($values);
        $temp = 0;
        $wind = 0;
        foreach ($values as $value){
            $temp += $value->Temperature;
            $wind += $value->WindSpeed;
        }
        $averageTemp = $temp/count($values);
        $averageWind = $wind/count($values);
        $dateTimeFirst = $this->getTableGateway()->getValueById(1)->DateTime;
        return array('totalAmount' => $totalAmount, 'averageTemp' => $averageTemp,'averageWind' => $averageWind, 'dateTimeFirst' => $dateTimeFirst);
    }
    
    public function getTableGateway(){
        if (!$this->valueTable) {
            $sm = $this->getServiceLocator();
            $this->valueTable = $sm->get('Application\Model\Database\ValueTable');
        }
        return $this->valueTable;
    }
}
