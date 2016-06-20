<?php

namespace Application\Model;

use Zend\Db\Sql\Where;
use ocoder\File\Image;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;

class UserTable extends AbstractTableGateway {
    protected $tableName = 'users';

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function countItem($arrParam = null, $options = null) {
        if ($options['task'] == 'list-item') {

            $result = $this->tableGateway->select(function (Select $select) use ($arrParam) {
                        $ssFilter = $arrParam['ssFilter'];

                        if (!empty($ssFilter['filter_published'])) {
                            $published = ($ssFilter['filter_published'] == 'active') ? 1 : 0;
                            $select->where->equalTo('users.published', $published);
                        }

                        if (!empty($ssFilter['filter_group'])) {
                            $select->where->equalTo('users.group_id', $ssFilter['filter_group']);
                        }

                        if (!empty($ssFilter['filter_keyword_type']) && !empty($ssFilter['filter_keyword_value'])) {
                            $arrTest = $ssFilter['filter_keyword_type'];
                            if (count($arrTest) < 4) {
                                for ($i = count($arrTest); $i <= 4; $i++) {
                                    $arrTest[] = $arrTest[0];
                                }
                            }
                            $select->where->NEST
                                            ->like($arrTest[0], '%' . $ssFilter['filter_keyword_value'] . '%')
                                            ->or
                                            ->like($arrTest[1], '%' . $ssFilter['filter_keyword_value'] . '%')
                                            ->or
                                            ->like($arrTest[2], '%' . $ssFilter['filter_keyword_value'] . '%')
                                            ->or
                                            ->like($arrTest[3], '%' . $ssFilter['filter_keyword_value'] . '%')
                                    ->UNNEST;
                        }
                    })->count();
        }
        return $result;
    }

    public function listItem($arrParam = null, $options = null) {

        if ($options['task'] == 'list-item') {
            $result = $this->tableGateway->select(function (Select $select) use ($arrParam) {
                $paginator = $arrParam['paginator'];
                $ssFilter = $arrParam['ssFilter'];

                $select->columns(array(
                            'id', 'username', 'email', 'published', 'ordering', 'avatar', 'created', 'created_by', 'fullname', 'modified', 'modified_by'
                        ))
                        ->limit($paginator['itemCountPerPage'])
                        ->offset(($paginator['currentPageNumber'] - 1) * $paginator['itemCountPerPage']);

                if (!empty($ssFilter['order_by']) && !empty($ssFilter['order'])) {
                    $select->order(array($ssFilter['order_by'] . ' ' . $ssFilter['order']));
                }

                if (!empty($ssFilter['filter_published'])) {
                    $published = ($ssFilter['filter_published'] == 'active') ? 1 : 0;
                    $select->where->equalTo('users.published', $published);
                }

                if (!empty($ssFilter['filter_keyword_type']) && !empty($ssFilter['filter_keyword_value'])) {
                    $arrTest = $ssFilter['filter_keyword_type'];
                    if (count($arrTest) < 4) {
                        for ($i = count($arrTest); $i <= 4; $i++) {
                            $arrTest[] = $arrTest[0];
                        }
                    }
                    $select->where->NEST
                                    ->like($arrTest[0], '%' . $ssFilter['filter_keyword_value'] . '%')
                                    ->or
                                    ->like($arrTest[1], '%' . $ssFilter['filter_keyword_value'] . '%')
                                    ->or
                                    ->like($arrTest[2], '%' . $ssFilter['filter_keyword_value'] . '%')
                                    ->or
                                    ->like($arrTest[3], '%' . $ssFilter['filter_keyword_value'] . '%')
                            ->UNNEST;
                }
            });
        }

        if ($options['task'] == 'list-avatar') {
            $result = $this->tableGateway->select(function (Select $select) use ($arrParam) {
                        $select->columns(array('avatar'))
                        ->where->in('id', $arrParam);
                    })->toArray();
        }

        return $result;
    }

    public function changePublished($arrParam = null, $options = null) {
        if ($options['task'] == 'change-published') {
            if ($arrParam['published_id'] > 0) {
                $data = array('published' => ($arrParam['published_value'] == 1) ? 0 : 1);
                $where = array('id' => $arrParam['published_id']);
                $this->tableGateway->update($data, $where);
                return true;
            }
        }

        if ($options['task'] == 'change-multi-published') {
            if (!empty($arrParam['cid'])) {
                $data = array('published' => $arrParam['published_value']);
                $cid = implode(',', $arrParam['cid']);
                $where = array('id IN (' . $cid . ')');
                $this->tableGateway->update($data, $where);
                return true;
            }
        }

        return false;
    }

    public function getItem($arrParam = null, $options = null) {

        if ($options == null) {
            $result = $this->tableGateway->select(function (Select $select) use ($arrParam) {
                        $select->columns(array('id', 'username', 'email', 'group_id', 'fullname', 'ordering', 'avatar', 'published'));
                        $select->where->equalTo('id', $arrParam['id']);
                    })->current();
        }

        return $result;
    }

    public function ordering($arrParam = null, $options = null) {

        if ($options == null) {
            if (!empty($arrParam['cid'])) {
                foreach ($arrParam['cid'] as $id) {
                    $data = array('ordering' => $arrParam['ordering'][$id]);
                    $where = array('id' => $id);
                    $this->tableGateway->update($data, $where);
                }
                return true;
            }
        }

        return false;
    }

    public function deleteItem($arrParam = null, $options = null) {
        if ($options['task'] == 'multi-delete') {
            if (!empty($arrParam['cid'])) {
                $items = $this->listItem($arrParam['cid'], array('task' => 'list-avatar'));

                $where = new Where();
                $where->in('id', $arrParam['cid']);
                $this->tableGateway->delete($where);

                return true;
            }
        }
        return false;
    }

    public function saveItem($arrParam = null, $options = null) {
       
        if ($options['task'] == 'add-item') {
            $data = array(
                'username' => $arrParam['username'],
                'email' => $arrParam['email'],
                'password' => md5($arrParam['password']),
                'fullname' => $arrParam['fullname'],
                'group_id' => $arrParam['group'],
                'ordering' => $arrParam['ordering'],
                'published' => ($arrParam['published'] == 'active') ? 1 : 0,
                'created' => date('Y-m-d H:i:s'),

            );

            if (!empty($arrParam['file']['tmp_name'])) {
                $imageObj = new Image();
                $data['avatar'] = $imageObj->upload('file', array('task' => 'user-avatar'));
            }

            $this->tableGateway->insert($data);
            return $this->tableGateway->getLastInsertValue();
        }
        if ($options['task'] == 'edit-item') {
            $data = array(
                'username' => $arrParam['username'],
                'email' => $arrParam['email'],
                'fullname' => $arrParam['fullname'],
                'group_id' => $arrParam['group'],
                'ordering' => $arrParam['ordering'],
                'published' => ($arrParam['published'] == 'active') ? 1 : 0,
                'modified' => date('Y-m-d H:i:s'),
                'avatar' => $arrParam['avatar'],
            );

            if (!empty($arrParam['password']))
                $data['password'] = md5($arrParam['password']);

            if (!empty($arrParam['file']['tmp_name'])) {
                $imageObj = new Image();
                $data['avatar'] = $imageObj->upload('file', array('task' => 'user-avatar'));
                $imageObj->removeImage($arrParam['avatar'], array('task' => 'user-avatar'));
            }
            $this->tableGateway->update($data, array('id' => $arrParam['id']));
            return $arrParam['userid'];
            
        }
    }

}
