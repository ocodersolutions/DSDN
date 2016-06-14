<?php
namespace Admin\Model\Entity;

class Document {

	public $id;
	public $name;
	public $description;
	public $link;
	public $created;
	public $created_by;
	public $published;

	public function exchangeArray($data){
		$this->id			= (!empty($data['id'])) ? $data['id'] : null;
		$this->name			= (!empty($data['name'])) ? $data['name'] : null;
		$this->description	= (!empty($data['description'])) ? $data['description'] : null;
		$this->link			= (!empty($data['link'])) ? $data['link'] : null;
		$this->created		= (!empty($data['created'])) ? $data['created'] : null;
		$this->created_by	= (!empty($data['created_by'])) ? $data['created_by'] : null;
		$this->published    = (!empty($data['published'])) ? $data['published'] : null;
	}
	
	public function getArrayCopy(){
		$result = get_object_vars($this);
		
		return $result;
	}

}