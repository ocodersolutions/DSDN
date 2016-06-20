<?php

namespace Admin\Model;

use Zend\Db\Sql\Where;
use ocoder\File\Image;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;

class DocumentTable extends AbstractTableGateway {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function countItem($arrParam = null, $options = null) {
        if ($options['task'] == 'list-item') {

            $result = $this->tableGateway->select(function (Select $select) use ($arrParam) {
                $ssFilter = $arrParam['ssFilter'];


                if (!empty($ssFilter['filter_group'])) {
                    $select->where->equalTo('id', $ssFilter['filter_group']);
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
                //$ssFilter = $arrParam['ssFilter'];

                $select->columns(array(
                            'id', 'name', 'description', 'link', 'created_by', 'created', 'published'
                        ))
                        ->limit($paginator['itemCountPerPage'])
                        ->offset(($paginator['currentPageNumber'] - 1) * $paginator['itemCountPerPage']);

                if (!empty($ssFilter['order_by']) && !empty($ssFilter['order'])) {
                    $select->order(array($ssFilter['order_by'] . ' ' . $ssFilter['order']));
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
        return $result;
    }

    public function listItemCurrentMonth($arrParam = NULL) {

       
        $result = $this->tableGateway->select(function (Select $select) use ($arrParam) {
            $select->columns(array(
                'id', 'name', 'description', 'link', 'created_by', 'created', 'published'
            ));
            $select->order(array('created DESC'));

            $select->where->greaterThanOrEqualTo('created', date('Y-m-01'))
                            ->lessThanOrEqualTo('created', date('Y-m-t'));
        });
       
        $ds=(int)(date('j',date('Y-m-01')));
        $de=(int)(date('t',date('Y-m-t')));
        $arrDocsDate = array();
        $result->buffer();
        
        for ($i=$ds;$i<=$de;$i++){

            foreach ($result as $document) {

                $daycreate = strtotime($document->created);
                $check = date('d',$daycreate);
                if ($check==$i){

                  $arrDocsDate[$i]= $document;  
                }
               
            }
            
        }
        
        return $arrDocsDate;
        //return $result;
    }

    public function listItemByMonth($arrParam = NULL) {
        $result = $this->tableGateway->select(function (Select $select) use ($arrParam) {
            $select->columns(array(
                'id', 'name', 'description', 'link', 'created_by', 'created', 'published'
            ));
            $select->order(array('created DESC'));

            $select->where->greaterEqualTo('created', date('Y-'.$month.'-01'))
                            ->lessThanOrEqualTo('created', date('Y-'.$month.'-t'));
        });
    }

    public function getItem($arrParam = null, $options = null) {
        if ($options == null) {
            $result = $this->tableGateway->select(function (Select $select) use ($arrParam) {
                        $select->columns(array('id', 'name', 'description', 'link', 'created_by', 'created', 'published'));
                        $select->where->equalTo('id', $arrParam['id']);
                    })->current();
        }

        return $result;
    }

    public function deleteItem($arrParam = null, $options = null) {
        if ($options['task'] == 'multi-delete') {
            if (!empty($arrParam['cid'])) {
                $items = $this->listItem($arrParam['cid']);

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
                'name' => $arrParam['name'],
                'description' => $arrParam['description'],
                'link' => $arrParam['link'],
                'created_by' => $arrParam['created_by'],
                'created' => date('Y-m-d H:i:s'),
                'published' => 1,
            );

            // if (!empty($arrParam['file']['tmp_name'])) {
            //     $imageObj = new Image();
            //     $data['avatar'] = $imageObj->upload('file', array('task' => 'user-avatar'));
            // }

            $this->tableGateway->insert($data);
            return $this->tableGateway->getLastInsertValue();
        }
        if ($options['task'] == 'edit-item') {
            $data = array(
                'name' => $arrParam['name'],
                'description' => $arrParam['description'],
                'link' => $arrParam['link'],
                'created_by' => $arrParam['created_by'],
                'created' => date('Y-m-d H:i:s'),
                'published' => $arrParam['published'],
            );

            // if (!empty($arrParam['file']['tmp_name'])) {
            //     $imageObj = new Image();
            //     $data['avatar'] = $imageObj->upload('file', array('task' => 'user-avatar'));
            //     $imageObj->removeImage($arrParam['avatar'], array('task' => 'user-avatar'));
            // }

            $this->tableGateway->update($data, array('id' => $arrParam['id']));
            return $arrParam['id'];
        }
    }

}
