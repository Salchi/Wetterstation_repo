<?php

namespace Application\Model\Database;

use Zend\Db\TableGateway\TableGateway;

class ValueTable{
    private $tableGateway;
    
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll(){
        $result = $this->tableGateway->select();
        return $result;
    }
    
    public function getValuesBetween($id){
        $id = (int)$id;
        $resultSet = $this->tableGateway->select(array('id'=> $id));
        $result = $resultSet->current();
        if (!$result) {
             echo '<h3 class="ErrorMessage">Frage mit ID: '."$id nicht vorhanden!</h3>";
        }
        return $result;
    }
}
?>
