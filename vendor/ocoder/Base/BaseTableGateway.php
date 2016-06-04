<?php

/**
 * Base Table Gateway (TableGateway)
 *
 * @author      Truongphuocnt
 */

namespace Ocoder\Base;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\AbstractTableGateway;

class BaseTableGateway extends AbstractTableGateway {

    /**
     * Count the number of elements for conditions 
     *
     * @param   array   - $arrParam     - (limit, offset, where, join)
     * @return  int     - count elements
     */
    protected function _countItem($tableGateway, $arrParam = null) {
        if ($arrParam != null) {
            $arrParam["tableName"] = $tableGateway->table;

            $result = $tableGateway->select(function (Select $select) use ($arrParam) {
                        $ssFilter = $arrParam['ssFilter'];

                        if (!empty($ssFilter['filter_published'])) {
                            $published = ($ssFilter['filter_published'] == 'active') ? 1 : 0;
                            $publishedSql = $arrParam["tableName"] . '.published';
                            $select->where->equalTo($publishedSql, $published);
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
                                            ->like($arrTest[1], $ssFilter['filter_keyword_value'])
                                            ->or
                                            ->like($arrTest[2], '%' . $ssFilter['filter_keyword_value'] . '%')
                                            ->or
                                            ->like($arrTest[3], '%' . $ssFilter['filter_keyword_value'] . '%')
                                    ->UNNEST;
                        }
                    })->count();
        } else {
            $result = $tableGateway->select()->count();
        }
        return $result;
    }

    /**
     * Get list elements for conditions 
     *
     * @param   array   - $arrParam     - (cols, limit, offset, where, join(table, on, field, type))
     * @return  array   - list elements/null
     */
    protected function _listItem($tableGateway, $arrParam = null) {
        try {
            if ($arrParam != null) {
                $arrParam["tableName"] = $tableGateway->table;
                $result = $tableGateway->select(function (Select $select) use ($arrParam) {
                    if (isset($arrParam['cols'])) {
                        $select->columns($arrParam['cols']);
                    }
                    if (isset($arrParam['paginator'])) {
                        $paginator = $arrParam['paginator'];
                        $select->limit($paginator['itemCountPerPage'])
                                ->offset(($paginator['currentPageNumber'] - 1) * $paginator['itemCountPerPage']);
                    }
                    if (isset($arrParam['ssFilter'])) {
                        $ssFilter = $arrParam['ssFilter'];
                        if (!empty($ssFilter['order_by']) && !empty($ssFilter['order'])) {
                            $select->order(array($ssFilter['order_by'] . ' ' . $ssFilter['order']));
                        }
                        if (!empty($ssFilter['filter_published'])) {
                            $published = ($ssFilter['filter_published'] == 'active') ? 1 : 0;
                            $publishedSql = $arrParam["tableName"] . '.published';
                            $select->where->equalTo($publishedSql, $published);
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
                    }
                    if (isset($arrParam['join'])) {
                        foreach ($arrParam['join'] as $join) {
                            $select->join($join['table'], $join['on'], $join['field'], $join['type']);
                        }
                    }
                });
            } else {
                $result = $tableGateway->select();
                $result->buffer();
            }
            return $result;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Insert or update a element
     *
     * @param   array    - $arrParam(list field and value of table)
     * @param   array    - $where(conditions to update)
     * @return  int/null - last Insert Id or update id if(update by id) ("1" if update by $where success "check result not null")
     */
    protected function _saveItem($tableGateway, $arrParam = null, $where = null) {
        try {
            if($where==null){
                if (!isset($arrParam['id'])) {
                    $tableGateway->insert($arrParam);
                    return $tableGateway->lastInsertValue;
                } else {
                    $tableGateway->update($arrParam, array('id' => $arrParam['id']));
                    return $arrParam['id'];
                }
            }else{
                $tableGateway->update($arrParam, $where);
                return 1;
            }
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Get element by conditions
     *
     * @param   array        - $arrParam(list field and value conditions)
     * @return  array/null   - element Object selected
     */
    protected function _getItemByCondition($tableGateway, $arrParam) {
        try {
            $row = $tableGateway->select($arrParam)->current();
            if (empty($row)) {
                return false;
            }
            return (array) $row;
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Delete element by conditions
     *
     * @param   array/Where object       - $conditions(list field and value conditions)
     * @return  true/false
     */
    protected function _deleteItem($tableGateway, $conditions) {
        try {
            $tableGateway->delete($conditions);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Delete element by conditions (Helper)
     *
     * @param   array        - $data(list object)
     * @return  array (list array)
     */
    protected function _convertArrItem($data) {
        $result = array();
        foreach ($data as $item) {
            $result[] = (array) $item;
        }
        return $result;
    }

}
