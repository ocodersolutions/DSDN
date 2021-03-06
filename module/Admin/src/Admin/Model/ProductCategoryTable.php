<?php

namespace Admin\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

class ProductCategoryTable extends NestedTable {

    protected $tableGateway;
    protected $tableName = 'productcategories';

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function itemInSelectbox($arrParam = null, $options = null) {
        if ($options['task'] == 'list-level') {
            $items = $this->tableGateway->select(function (Select $select) use ($arrParam) {
                        $select->columns(array('id', 'level'))
                                ->order('level DESC')
                                ->limit(1);
                        ;
                    })->current();
            $result = array();
            if (!empty($items)) {
                for ($i = 1; $i <= $items->level; $i++)
                    $result[$i] = 'Level ' . $i;
            }
        }

        if ($options['task'] == 'form-category') {
            $items = $this->tableGateway->select(function (Select $select) use ($arrParam) {
                $select->columns(array('id', 'name', 'level'))
                        ->order('left ASC')
                ;
            });

            $result = array();
            if (!empty($items)) {
                foreach ($items as $item) {
                    $result[$item->id] = str_repeat('------|', $item->level) . ' ' . $item->name;
                }
            }
        }

        if ($options['task'] == 'list-book') {
            $items = $this->tableGateway->select(function (Select $select) use ($arrParam) {
                $select->columns(array('id', 'name', 'level'))
                        ->order('left ASC')
                ->where->greaterThan('left', 0)
                ;
            });

            $result = array();
            if (!empty($items)) {
                foreach ($items as $item) {
                    $result[$item->id] = str_repeat('------|', $item->level - 1) . ' ' . $item->name;
                }
            }
        }
        return $result;
    }

    public function countItem($arrParam = null, $options = null) {
        if ($options['task'] == 'list-item') {

            $result = $this->tableGateway->select(function (Select $select) use ($arrParam) {
                        $ssFilter = $arrParam['ssFilter'];

                        if (!empty($ssFilter['filter_status'])) {
                            $status = ($ssFilter['filter_status'] == 'active') ? 1 : 0;
                            $select->where->equalTo('productcategories.status', $status);
                        }

                        if (!empty($ssFilter['filter_level'])) {
//                            $select->where->lessThanOrEqualTo('productcategories.level', $ssFilter['filter_level']);
                            $select->where->greaterThanOrEqualTo('productcategories.level', $ssFilter['filter_level']);
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
                            '*'
                        ))
//                        ->join(
//                                array('c' => 'productcategories'), 'productcategories.parent = c.id', array('pleft' => 'left', 'pright' => 'right'), $select::JOIN_LEFT
//                        )
                        ->limit($paginator['itemCountPerPage'])
                        ->offset(($paginator['currentPageNumber'] - 1) * $paginator['itemCountPerPage'])
                ->where->greaterThan('productcategories.level', 0);
                ;

                if (!empty($ssFilter['order_by']) && !empty($ssFilter['order'])) {
                    $select->order(array('productcategories.' . $ssFilter['order_by'] . ' ' . $ssFilter['order']));
                }

                if (!empty($ssFilter['filter_status'])) {
                    $status = ($ssFilter['filter_status'] == 'active') ? 1 : 0;
                    $select->where->equalTo('productcategories.status', $status);
                }

                if (!empty($ssFilter['filter_level'])) {
                    $select->where->lessThanOrEqualTo('productcategories.level', $ssFilter['filter_level']);
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
//                die($select->getSqlString());
                $select->order(array('left ASC'));
            });
        }

        return $result;
    }

    public function changeStatus($arrParam = null, $options = null) {
        if ($options['task'] == 'change-status') {
            if ($arrParam['status_id'] > 0) {
                $data = array('status' => ($arrParam['status_value'] == 1) ? 0 : 1);
                $where = array('id' => $arrParam['status_id']);
                $this->tableGateway->update($data, $where);
                return true;
            }
        }

        if ($options['task'] == 'change-multi-status') {
            if (!empty($arrParam['cid'])) {
                $data = array('status' => $arrParam['status_value']);
                $cid = implode(',', $arrParam['cid']);
                $where = array('id IN (' . $cid . ')');
                $this->tableGateway->update($data, $where);
                return true;
            }
        }

        return false;
    }

    public function moveItem($arrParam = null, $options = null) {
        if ($options == null) {
            if ($arrParam['status_id'] > 0) {
                if ($arrParam['status_value'] == 'up')
                    $this->moveUp($arrParam['status_id']);
                if ($arrParam['status_value'] == 'down')
                    $this->moveDown($arrParam['status_id']);
                return true;
            }
        }

        return false;
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
                foreach ($arrParam['cid'] as $id) {
                    $this->removeNode($id, array('type' => 'only'));
                }

                return true;
            }
        }
        return false;
    }

    public function saveItem($arrParam = null, $options = null) {
        if ($options['task'] == 'add-item') {
//            $data = array(
//                'name' => $arrParam['name'],
//                'status' => ($arrParam['status'] == 'active') ? 1 : 0,
//                'created' => date('Y-m-d H:i:s'),
//                'parent' => $arrParam['parent'],
//            );
            $arrParam['status'] = ($arrParam['status'] == 'active') ? 1 : 0;

//            if (!empty($arrParam['description'])) {
//                $config = array(
//                    array('HTML.AllowedElements', 'p,s,u,em,strong,span'),
//                    array('HTML.AllowedAttributes', 'style'),
//                );
//
//                $filter = new \Zendvn\Filter\Purifier($config);
//                $data['description'] = $filter->filter($arrParam['description']);
//            }

            $this->insertNode($arrParam, $arrParam['parent'], array('position' => 'right'));
            $arrParam['id'] = $this->tableGateway->getLastInsertValue();
        }
        if ($options['task'] == 'edit-item') {
//            $data = array(
//                'name' => $arrParam['name'],
//                'status' => ($arrParam['status'] == 'active') ? 1 : 0,
//                'modified' => date('Y-m-d H:i:s'),
//                'parent' => $arrParam['parent'],
//            );
            $arrParam['status'] = ($arrParam['status'] == 'active') ? 1 : 0;

//            if (!empty($arrParam['description'])) {
//                $config = array(
//                    array('HTML.AllowedElements', 'p,s,u,em,strong,span'),
//                    array('HTML.AllowedAttributes', 'style'),
//                );
//
//                $filter = new \Zendvn\Filter\Purifier($config);
//                $data['description'] = $filter->filter($arrParam['description']);
//            }

            if ($arrParam['parent'] == $arrParam['id'])
                $arrParam['parent'] = null;
            $this->updateNode($arrParam, $arrParam['id'], $arrParam['parent']);
        }

        // Update alias
        $arrParam['alias'] = $arrParam['alias'] . '-' . $arrParam['id'];

        $aliasLang = json_decode($arrParam['alias_lang']);
        $alias_en = $aliasLang->alias_en . '-' . $arrParam['id'];
        $alias_jp = $aliasLang->alias_jp . '-' . $arrParam['id'];
        $arrParam['alias_lang'] = json_encode(array(
            'alias_en' => $alias_en,
            'alias_jp' => $alias_jp,
        ));

        $this->tableGateway->update($arrParam, array('id' => $arrParam['id']));
        return $arrParam['id'];
    }

}
