<?php

namespace Admin\Model\Entity;

use Zend\Json\Json;

class Product {

    public $id;
    public $name;
    public $name_lang;
    public $alias;
    public $alias_lang;
    public $intro;
    public $intro_lang;
    public $description;
    public $description_lang;
    public $keyword;
    public $keyword_lang;
    public $price;
    public $special;
    public $sale_off;
    public $picture;
    public $status;
    public $ordering;
    public $created;
    public $created_by;
    public $modified;
    public $modified_by;
    public $category_id;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->name_lang = (!empty($data['name_lang'])) ? $data['name_lang'] : null;
        $this->alias = (!empty($data['alias'])) ? $data['alias'] : null;
        $this->alias_lang = (!empty($data['alias_lang'])) ? $data['alias_lang'] : null;
        $this->intro = (!empty($data['intro'])) ? $data['intro'] : null;
        $this->intro_lang = (!empty($data['intro_lang'])) ? $data['intro_lang'] : null;
        $this->description = (!empty($data['description'])) ? $data['description'] : null;
        $this->description_lang = (!empty($data['description_lang'])) ? $data['description_lang'] : null;
        $this->keyword = (!empty($data['description'])) ? $data['description'] : null;
        $this->keyword_lang = (!empty($data['description_lang'])) ? $data['description_lang'] : null;
        $this->price = (!empty($data['price'])) ? $data['price'] : null;
        $this->special = (!empty($data['special'])) ? $data['special'] : null;
        $this->sale_off = (!empty($data['sale_off'])) ? $data['sale_off'] : null;
        $this->picture = (!empty($data['picture'])) ? $data['picture'] : null;
        $this->status = (!empty($data['status'])) ? $data['status'] : 0;
        $this->ordering = (!empty($data['ordering'])) ? $data['ordering'] : null;
        $this->created = (!empty($data['created'])) ? $data['created'] : null;
        $this->created_by = (!empty($data['created_by'])) ? $data['created_by'] : null;
        $this->modified = (!empty($data['modified'])) ? $data['modified'] : null;
        $this->modified_by = (!empty($data['modified_by'])) ? $data['modified_by'] : null;
    }

    public function getArrayCopy() {
        $result = get_object_vars($this);
        $result['status'] = ($result['status'] == 1) ? 'active' : 'inactive';
        $result['special'] = ($result['special'] == 1) ? 'yes' : 'no';

        if (!empty($result['sale_off'])) {
            $saleOff = Json::decode($result['sale_off']);
            $result['sale_off_type'] = $saleOff->type;
            $result['sale_off_value'] = $saleOff->value;
        }

        return $result;
    }

}
