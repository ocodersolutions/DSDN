<?php

namespace Admin\Model\Entity;

class Banner {

    public $id;
    public $name;
    public $name_lang;
    public $description;
    public $description_lang;
    public $link;
    public $banner;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : 0;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->name_lang = (!empty($data['name_lang'])) ? $data['name_lang'] : null;
        $this->description = (!empty($data['description'])) ? $data['description'] : null;
        $this->description_lang = (!empty($data['description_lang'])) ? $data['description_lang'] : null;
        $this->link = (!empty($data['link'])) ? $data['link'] : null;
        $this->banner = (!empty($data['banner'])) ? $data['banner'] : null;
    }

    public function getArrayCopy() {
        $result = get_object_vars($this);
        return $result;
    }
}
