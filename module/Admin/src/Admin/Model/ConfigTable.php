<?php

namespace Admin\Model;

use Zend\Db\Sql\Where;
use ocoder\File\Image;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;

class ConfigTable extends AbstractTableGateway {

    protected $tableGateway;
    protected $tableName = 'configs';

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getItem($arrParam = null, $options = null) {

        if ($options == null) {
            $result = $this->tableGateway->select(function (Select $select) use ($arrParam) {
                        $select->columns(array('*'));
                        $select->where->equalTo('id', $arrParam['id']);
                    })->current();
        }

        return $result;
    }

    public function saveItem($arrParam = null, $options = null) {

        if ($options['task'] == 'add-item') {
//            $data = array(
//                'username' => $arrParam['username'],
//                'email' => $arrParam['email'],
//                'password' => md5($arrParam['password']),
//                'fullname' => $arrParam['fullname'],
//                'group_id' => $arrParam['group'],
//                'ordering' => $arrParam['ordering'],
//                'published' => ($arrParam['published'] == 'active') ? 1 : 0,
//                'created' => date('Y-m-d H:i:s'),
//            );
//
//            if (!empty($arrParam['file']['tmp_name'])) {
//                $imageObj = new Image();
//                $data['avatar'] = $imageObj->upload('file', array('task' => 'user-avatar'));
//            }

            $this->tableGateway->insert($arrParam);
            $arrParam['id'] = $this->tableGateway->getLastInsertValue();
        }
        if ($options['task'] == 'edit-item') {
//            $data = array(
//                'username' => $arrParam['username'],
//                'email' => $arrParam['email'],
//                'fullname' => $arrParam['fullname'],
//                'group_id' => $arrParam['group'],
//                'ordering' => $arrParam['ordering'],
//                'published' => ($arrParam['published'] == 'active') ? 1 : 0,
//                'modified' => date('Y-m-d H:i:s'),
//            );
//
//            if (!empty($arrParam['password']))
//                $data['password'] = md5($arrParam['password']);
//
//            if (!empty($arrParam['file']['tmp_name'])) {
//                $imageObj = new Image();
//                $data['avatar'] = $imageObj->upload('file', array('task' => 'user-avatar'));
//                $imageObj->removeImage($arrParam['avatar'], array('task' => 'user-avatar'));
//            }
            
            $this->tableGateway->update($arrParam, array('id' => $arrParam['id']));
        }
        return $arrParam['id'];
    }

}
