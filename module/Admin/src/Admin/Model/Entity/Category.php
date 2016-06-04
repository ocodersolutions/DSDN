<?php

namespace Admin\Model\Entity;

use Zend\Json\Json;

class Category {

    public $id;
    public $name;
    public $name_lang;
    public $alias;
    public $alias_lang;
    public $intro;
    public $intro_lang;
    public $keyword;
    public $keyword_lang;
    public $parent_id;
    public $thumbnail;
    public $status;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : 0;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->name_lang = (!empty($data['name_lang'])) ? $data['name_lang'] : null;
        $this->alias = (!empty($data['alias'])) ? $data['alias'] : null;
        $this->alias_lang = (!empty($data['alias_lang'])) ? $data['alias_lang'] : null;
        $this->intro = (!empty($data['intro'])) ? $data['intro'] : null;
        $this->intro_lang = (!empty($data['intro_lang'])) ? $data['intro_lang'] : null;
        $this->keyword = (!empty($data['keyword'])) ? $data['keyword'] : null;
        $this->keyword_lang = (!empty($data['keyword_lang'])) ? $data['keyword_lang'] : null;
        $this->parent_id = (!empty($data['parent_id'])) ? $data['parent_id'] : 0;
        $this->thumbnail = (!empty($data['thumbnail'])) ? $data['thumbnail'] : null;
        $this->status = (!empty($data['status'])) ? $data['status'] : 0;
    }

    public function getArrayCopy() {
        $result = get_object_vars($this);
        return $result;
    }
}
