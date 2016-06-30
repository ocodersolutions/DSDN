<?php

namespace Admin\Model\Entity;

class Config {

    public $id;
    public $title;
    public $title_lang;
    public $description;
    public $description_lang;
    public $keywords;
    public $keywords_lang;
    public $company_name;
    public $company_name_lang;
    public $company_description;
    public $company_description_lang;
    public $logo;
    public $logo_lang;
    public $intro_image;
    public $intro_image_lang;
    public $contact_info;
    public $contact_info_lang;
    public $iframe_youtube;
    public $other_link;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : 0;
        $this->title = (!empty($data['title'])) ? $data['title'] : null;
        $this->title_lang = (!empty($data['title_lang'])) ? $data['title_lang'] : null;
        $this->description = (!empty($data['description'])) ? $data['description'] : null;
        $this->description_lang = (!empty($data['description_lang'])) ? $data['description_lang'] : null;
        $this->keywords = (!empty($data['keywords'])) ? $data['keywords'] : null;
        $this->keywords_lang = (!empty($data['keywords_lang'])) ? $data['keywords_lang'] : null;
        $this->company_name = (!empty($data['company_name'])) ? $data['company_name'] : null;
        $this->company_name_lang = (!empty($data['company_name_lang'])) ? $data['company_name_lang'] : null;
        $this->company_description = (!empty($data['company_description'])) ? $data['company_description'] : null;
        $this->company_description_lang = (!empty($data['company_description_lang'])) ? $data['company_description_lang'] : null;
        $this->logo = (!empty($data['logo'])) ? $data['logo'] : null;
        $this->logo_lang = (!empty($data['logo_lang'])) ? $data['logo_lang'] : null;
        $this->intro_image = (!empty($data['intro_image'])) ? $data['intro_image'] : null;
        $this->intro_image_lang = (!empty($data['intro_image_lang'])) ? $data['intro_image_lang'] : null;
        $this->contact_info = (!empty($data['contact_info'])) ? $data['contact_info'] : null;
        $this->contact_info_lang = (!empty($data['contact_info_lang'])) ? $data['contact_info_lang'] : null;
        $this->iframe_youtube = (!empty($data['iframe_youtube'])) ? $data['iframe_youtube'] : null;
        $this->company_address = (!empty($data['company_address'])) ? $data['company_address'] : null;
        $this->company_phone = (!empty($data['company_phone'])) ? $data['company_phone'] : null;
        $this->company_fax = (!empty($data['company_fax'])) ? $data['company_fax'] : null;
        $this->company_email = (!empty($data['company_email'])) ? $data['company_email'] : null;
        $this->company_fax = (!empty($data['company_history'])) ? $data['company_history'] : null;
        $this->company_email = (!empty($data['company_business'])) ? $data['company_business'] : null;
        $this->other_link = (!empty($data['other_link'])) ? $data['other_link'] : null;
    }

    public function getArrayCopy() {
        $result = get_object_vars($this);
        return $result;
    }
}
