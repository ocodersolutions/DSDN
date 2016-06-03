<?php

namespace Admin\Model\Entity;

class Traffic {

    public $id;
    public $ip;
    public $date;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : 0;
        $this->ip = (!empty($data['ip'])) ? $data['ip'] : null;
        $this->date = (!empty($data['date'])) ? $data['date'] : null;
    }

    public function getArrayCopy() {
        $result = get_object_vars($this);
        return $result;
    }
}
