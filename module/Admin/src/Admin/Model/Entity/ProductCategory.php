<?php
namespace Admin\Model\Entity;

class ProductCategory {

	public $id;
	public $name;
        public $name_lang;
        public $alias;
        public $alias_lang;
	public $status;
	public $description;
        public $description_lang;
        public $keyword;
        public $keyword_lang;
	public $created;
	public $created_by;
	public $modified;
	public $modified_by;
	public $parent;
	public $left;
	public $right;
	public $level;
        public $thumbnail;

	public function exchangeArray($data){
		$this->id			= (!empty($data['id'])) ? $data['id'] : null;
		$this->name			= (!empty($data['name'])) ? $data['name'] : null;
                $this->name_lang			= (!empty($data['name_lang'])) ? $data['name_lang'] : null;
                $this->alias			= (!empty($data['alias'])) ? $data['alias'] : null;
                $this->alias_lang			= (!empty($data['alias_lang'])) ? $data['alias_lang'] : null;
		$this->status		= (!empty($data['status'])) ? $data['status'] : 0;
		$this->description	= (!empty($data['description'])) ? $data['description'] : null;
                $this->description_lang	= (!empty($data['description_lang'])) ? $data['description_lang'] : null;
                $this->keyword	= (!empty($data['keyword'])) ? $data['keyword'] : null;
                $this->keyword_lang	= (!empty($data['keyword_lang'])) ? $data['keyword_lang'] : null;
		$this->created		= (!empty($data['created'])) ? $data['created'] : null;
		$this->created_by	= (!empty($data['created_by'])) ? $data['created_by'] : null;
		$this->modified		= (!empty($data['modified'])) ? $data['modified'] : null;
		$this->modified_by	= (!empty($data['modified_by'])) ? $data['modified_by'] : null;
		$this->parent		= (!empty($data['parent'])) ? $data['parent'] : null;
		$this->left			= (!empty($data['left'])) ? $data['left'] : null;
		$this->right		= (!empty($data['right'])) ? $data['right'] : null;
		$this->level		= (!empty($data['level'])) ? $data['level'] : null;
                $this->thumbnail        = (!empty($data['thumbnail'])) ? $data['thumbnail'] : null;
	}
	
	public function getArrayCopy(){
		$result = get_object_vars($this);
		$result['status']	= ($result['status'] == 1) ? 'active' : 'inactive';
		return $result;
	}

}