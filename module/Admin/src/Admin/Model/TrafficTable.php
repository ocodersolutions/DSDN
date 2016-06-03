<?php

namespace Admin\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;

class TrafficTable extends AbstractTableGateway {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function countItem($arrParam = null, $options = null) {
        $result = $this->tableGateway->select(function (Select $select) use ($arrParam) {

                    $select->where->NEST
                                    ->greaterThanOrEqualTo('date', $arrParam['from'])
                                    ->and
                                    ->lessThan('date', $arrParam['to'])
                            ->UNNEST;
                })->count();
        return $result;
    }

    public function saveItem($arrParam = null, $options = null) {
        $this->tableGateway->insert($arrParam);
        return $this->tableGateway->getLastInsertValue();
    }

}
