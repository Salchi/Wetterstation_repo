<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Database\Value;
use Application\Model\Forms\Between2DatesForm;
use Application\Model\Forms\CompareForm;

class ArchiveController extends AbstractActionController {

    private $valueTable;

    public function indexAction() {
        return new ViewModel();
    }

    public function totalprocessAction() {
        //raspi.wetterstation@gmail.com
        //d.salchner@tsn.at

        $datei = file("./public/avg_temp.txt");

        $values = array();
        $index = 0;
        foreach ($datei as $line) {
            $line = explode(";", (string) $line);
            $data['temperature'] = (!empty($line[0])) ? $line[0] : null;
            $data['dateTime'] = $line[1];
            $data['windSpeed'] = (!empty($line[2])) ? $line[2] : null;
            $value = new Value();
            $value->exchangeArray($data);
            $values[$index] = $value;
            $index++;
        }

        foreach ($values as $value) {
            if ($this->getTableGateway()->getValueWithDateTime($value->DateTime) == false) {
                $this->getTableGateway()->addValue($value);
            }
        }
        return array('values' => $this->getTableGateway()->fetchAll());
    }

    public function monthprocessAction() {
        //raspi.wetterstation@gmail.com
        //d.salchner@tsn.at

        $datei = file("./public/avg_temp.txt");

        $values = array();
        $index = 0;
        foreach ($datei as $line) {
            $line = explode(";", (string) $line);
            $data['temperature'] = $line[0];
            $data['dateTime'] = $line[1];
            $data['windSpeed'] = (!empty($line[2])) ? $line[2] : null;
            $value = new Value();
            $value->exchangeArray($data);
            $values[$index] = $value;
            $index++;
        }

        foreach ($values as $value) {
            if ($this->getTableGateway()->getValueWithDateTime($value->DateTime) == false) {
                $this->getTableGateway()->addValue($value);
            }
        }
        $timestamp = time();
        $actDate = date("Y-m-01 00:00:00", $timestamp);
        $year = substr($actDate, 0, 4);
        $month = substr($actDate, 5, 2) + 1;
        $nextMonth = "$year-$month-01 00:00:00";
        return array('values' => $this->getTableGateway()->getValuesBetween($actDate, $nextMonth));
    }

    public function yearprocessAction() {
        //raspi.wetterstation@gmail.com
        //d.salchner@tsn.at

        $datei = file("./public/avg_temp.txt");

        $values = array();
        $index = 0;
        foreach ($datei as $line) {
            $line = explode(";", (string) $line);
            $data['temperature'] = $line[0];
            $data['dateTime'] = $line[1];
            $data['windSpeed'] = (!empty($line[2])) ? $line[2] : null;
            $value = new Value();
            $value->exchangeArray($data);
            $values[$index] = $value;
            $index++;
        }

        foreach ($values as $value) {
            if ($this->getTableGateway()->getValueWithDateTime($value->DateTime) == false) {
                $this->getTableGateway()->addValue($value);
            }
        }
        $timestamp = time();
        $actDate = date("Y-01-01 00:00:00", $timestamp);
        $year = substr($actDate, 0, 4) + 1;
        $nextYear = "$year-01-01 00:00:00";
        return array('values' => $this->getTableGateway()->getValuesBetween($actDate, $nextYear));
    }

    public function betweentwodatesAction() {
        $request = $this->getRequest();
        $form = new Between2DatesForm();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            //raspi.wetterstation@gmail.com
            //d.salchner@tsn.at

            $datei = file("./public/avg_temp.txt");

            $values = array();
            $index = 0;
            foreach ($datei as $line) {
                $line = explode(";", (string) $line);
                $data['temperature'] = $line[0];
                $data['dateTime'] = $line[1];
                $data['windSpeed'] = (!empty($line[2])) ? $line[2] : null;
                $value = new Value();
                $value->exchangeArray($data);
                $values[$index] = $value;
                $index++;
            }

            foreach ($values as $value) {
                if ($this->getTableGateway()->getValueWithDateTime($value->DateTime) == false) {
                    $this->getTableGateway()->addValue($value);
                }
            }
            $from = $form->get('from')->getValue() . " 00:00:00";
            $to = $form->get('to')->getValue() . " 23:59:59";
            return array('values' => $this->getTableGateway()->getValuesBetween($from, $to),'form' => $form, 'dateChosen' => true);
        }
        else{
            return array('form' => $form,'values' => array(),'dateChosen' => false);
        }
    }

    public function compareAction() {
        $request = $this->getRequest();
        $form = new CompareForm();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            $datei = file("./public/avg_temp.txt");

            $values = array();
            $index = 0;
            foreach ($datei as $line) {
                $line = explode(";", (string) $line);
                $data['temperature'] = $line[0];
                $data['dateTime'] = $line[1];
                $data['windSpeed'] = (!empty($line[2])) ? $line[2] : null;
                $value = new Value();
                $value->exchangeArray($data);
                $values[$index] = $value;
                $index++;
            }

            foreach ($values as $value) {
                if ($this->getTableGateway()->getValueWithDateTime($value->DateTime) == false) {
                    $this->getTableGateway()->addValue($value);
                }
            }
            $from1 = $form->get('from1')->getValue() . " 00:00:00";
            $to1 = $form->get('to1')->getValue() . " 23:59:59";
            
            $from2 = $form->get('from2')->getValue() . " 00:00:00";
            $to2 = $form->get('to2')->getValue() . " 23:59:59";
            return array('values1' => $this->getTableGateway()->getValuesBetween($from1, $to1),'values2' => $this->getTableGateway()->getValuesBetween($from2, $to2),'form' => $form, 'dateChosen' => true);
        }
        else{
            return array('form' => $form,'values' => array(),'dateChosen' => false);
        }
    }
    
    public function getTableGateway() {
        if (!$this->valueTable) {
            $sm = $this->getServiceLocator();
            $this->valueTable = $sm->get('Application\Model\Database\ValueTable');
        }
        return $this->valueTable;
    }

}

?>
