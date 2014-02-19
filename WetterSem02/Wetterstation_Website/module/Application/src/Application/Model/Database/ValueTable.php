<?php

namespace Application\Model\Database;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Predicate\Between;
use Application\Model\Database\Value;

class ValueTable{
    private $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll(){
        $result = $this->tableGateway->select();
        return $result;
    }
    
    public function getValuesBetween($minDateTime,$maxDateTime){
        $sql = new Sql($this->tableGateway->getAdapter());
        $select = $sql->select('tbl_values');
        $select->where(new Between('dateTime',$minDateTime,$maxDateTime));
        $result = $this->tableGateway->selectWith($select);
        if (!$result) {
             echo '<h3 class="ErrorMessage">Value zwischen: '."$minDateTime und $maxDateTime nicht vorhanden!</h3>";
        }
        return $result;
    }
    
    public function getValueWithDateTime($dateTime){
        $resultSet = $this->tableGateway->select(array('dateTime' => $dateTime));
        if(count($resultSet) < 1){
            return false;
        }
        else{
            return true;
        }
    }
    
    public function getValueById($id){
        $resultSet = $this->tableGateway->select(array('id' => $id));
        $result = $resultSet->current();
        return $result;
    }
    
    public function addValue(Value $value){
        
        $data = array(
            'dateTime' => $value->DateTime,
            'temperature' => $value->Temperature,
            'windSpeed' => $value->WindSpeed,
        );
        $this->tableGateway->insert($data);
    }
}
?>
