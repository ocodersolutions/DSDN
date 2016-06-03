<?php

namespace Admin\Model;

use Zend\Db\Sql\Where;
use ocoder\File\Image;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\AbstractTableGateway;

class BannerTable extends AbstractTableGateway {

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
                $ssFilter = $arrParam['ssFilter'];

                $select->columns(array(
                            'id', 'name', 'name_lang', 'link', 'banner', 'description', 'description_lang',
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

    public function getItem($arrParam = null, $options = null) {

        if ($options == null) {
            $result = $this->tableGateway->select(function (Select $select) use ($arrParam) {
                        $select->columns(array('id', 'name', 'name_lang', 'link', 'banner', 'description', 'description_lang'));
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
                'name_lang' => $arrParam['name_lang'],
                'link' => $arrParam['link'],
                'banner' => $arrParam['banner'],
                'description' => $arrParam['description'],
                'description_lang' => $arrParam['description_lang'],
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
                    'name' => $arrParam['name'],
                    'name_lang' => $arrParam['name_lang'],
                    'link' => $arrParam['link'],
                    'banner' => $arrParam['banner'],
                    'description' => $arrParam['description'],
                    'description_lang' => $arrParam['description_lang'],
            );

            if (!empty($arrParam['file']['tmp_name'])) {
                $imageObj = new Image();
                $data['avatar'] = $imageObj->upload('file', array('task' => 'user-avatar'));
                $imageObj->removeImage($arrParam['avatar'], array('task' => 'user-avatar'));
            }

            $this->tableGateway->update($data, array('id' => $arrParam['id']));
            return $arrParam['id'];
        }
    }

}
