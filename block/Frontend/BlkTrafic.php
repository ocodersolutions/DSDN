<?php

namespace Block\Frontend;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;
use Zend\Db\Sql\Select;

class BlkTrafic extends AbstractHelper {

    protected $_data;

    public function __invoke() {
        require_once 'BlkTraffic/default.phtml';
    }

    public function setData($trafficTable) {
        $ssTraffic = new Container('traffic');
        if ($ssTraffic->count != true) {
            $ssTraffic->count = true;
            $remote = new \Zend\Http\PhpEnvironment\RemoteAddress;

            $trafficTable->saveItem(array('ip' => $remote->getIpAddress(), 'date' => date("Y/m/d")));
        }

        $this->today = $trafficTable->countItem(
                array(
                    'from' => date("Y/m/d"),
                    'to' => date("Y/m/d", strtotime("+1 days")),
                )
        );
        $this->yesterday = $trafficTable->countItem(
                array(
                    'from' => date('Y/m/d', strtotime("-1 days")),
                    'to' => date("Y/m/d")
                )
        );
        $this->currentWeek = $trafficTable->countItem(
                array(
                    'from' => date('Y/m/d', strtotime('monday this week')),
                    'to' => date('Y/m/d', strtotime("+1 days")),
                )
        );
        $this->previousWeek = $trafficTable->countItem(
                array(
                    'from' => date('Y/m/d', strtotime('-7 days', strtotime('monday this week'))),
                    'to' => date('Y/m/d', strtotime('monday this week'))
                )
        );
        $this->previousMonth = $trafficTable->countItem(
                array(
                    'from' => date('Y/m/d', mktime(0, 0, 0, date('m') - 1, 1, date('Y'))),
                    'to' => date('Y/m/d', mktime(0, 0, 0, date('m'), 1, date('Y')))
                )
        );
        $this->total = $trafficTable->countItem(
                array(
                    'from' => date('Y/m/d', mktime(0, 0, 0, 1, 1, 2000)),
                    'to' => date('Y/m/d', strtotime("+1 days")),
                )
        );
    }

}
