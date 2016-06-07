<?php

namespace Admin\Form;

use \Zend\Form\Form as Form;

class Config extends Form {

    public function __construct() {
        parent::__construct();

        // FORM Attribute
        $this->setAttributes(array(
            'action' => '#',
            'method' => 'POST',
            'class' => 'form-horizontal',
            'role' => 'form',
            'name' => 'adminForm',
            'id' => 'adminForm',
            'enctype' => 'multipart/form-data'
        ));

        // ID
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        // Action
        $this->add(array(
            'name' => 'action',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        // Title 
        $this->add(array(
            'name' => 'title',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'title',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => TITLE,
                'label_attributes' => array(
                    'for' => 'title',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'title_en',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'title_en',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => TITLE . ' - ' . ENGLISH,
                'label_attributes' => array(
                    'for' => 'title_en',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'title_jp',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'title_jp',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => TITLE . ' - ' . JAPANESE,
                'label_attributes' => array(
                    'for' => 'title_jp',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Description
        $this->add(array(
            'name' => 'description',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'description',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => DESCRIPTION . ' (Meta)',
                'label_attributes' => array(
                    'for' => 'description',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'description_en',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'description_en',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => DESCRIPTION . ' (Meta) - ' . ENGLISH,
                'label_attributes' => array(
                    'for' => 'description_en',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'description_jp',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'description_jp',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => DESCRIPTION . ' (Meta) - ' . JAPANESE,
                'label_attributes' => array(
                    'for' => 'description_jp',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Keywords
        $this->add(array(
            'name' => 'keywords',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'keywords',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => KEYWORDS . ' (Meta)',
                'label_attributes' => array(
                    'for' => 'keywords',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'keywords_en',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'keywords_en',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => KEYWORDS . ' (Meta) - ' . ENGLISH,
                'label_attributes' => array(
                    'for' => 'keywords_en',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'keywords_jp',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'keywords_jp',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => KEYWORDS . ' (Meta) - ' . JAPANESE,
                'label_attributes' => array(
                    'for' => 'keywords_jp',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Company Name
        $this->add(array(
            'name' => 'company_name',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'company_name',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => COMPANY_NAME,
                'label_attributes' => array(
                    'for' => 'company_name',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'company_name_en',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'company_name_en',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => COMPANY_NAME . ' - ' . ENGLISH,
                'label_attributes' => array(
                    'for' => 'company_name_en',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'company_name_jp',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'company_name_jp',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => COMPANY_NAME . ' - ' . JAPANESE,
                'label_attributes' => array(
                    'for' => 'company_name_jp',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));

        // Company Description
        $this->add(array(
            'name' => 'company_description',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control ckeditor',
                'id' => 'company_description',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => COMPANY_INTRO,
                'label_attributes' => array(
                    'for' => 'company_description',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'company_description_en',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control ckeditor',
                'id' => 'company_description_en',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => COMPANY_INTRO . ' - ' . ENGLISH,
                'label_attributes' => array(
                    'for' => 'company_description_en',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'company_description_jp',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control ckeditor',
                'id' => 'company_description_jp',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => COMPANY_INTRO . ' - ' . JAPANESE,
                'label_attributes' => array(
                    'for' => 'company_description_jp',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Logo
        $this->add(array(
            'name' => 'logo',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'style' => 'width: 500px; float: left',
                'id' => 'Image',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => LOGO,
                'label_attributes' => array(
                    'for' => 'logo',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'logo_en',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'logo_en',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => LOGO . ' - ' . ENGLISH,
                'label_attributes' => array(
                    'for' => 'logo_en',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'logo_jp',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'logo_jp',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => LOGO . ' - ' . JAPANESE,
                'label_attributes' => array(
                    'for' => 'logo_jp',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Intro Image
        $this->add(array(
            'name' => 'intro_image',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Image1',
                'style' => 'width: 500px; float: left',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => INTRO_IMAGE,
                'label_attributes' => array(
                    'for' => 'intro_image',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'intro_image_en',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'intro_image_en',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => INTRO_IMAGE . ' - ' . ENGLISH,
                'label_attributes' => array(
                    'for' => 'intro_image_en',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'intro_image_jp',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'intro_image_jp',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => INTRO_IMAGE . ' - ' . JAPANESE,
                'label_attributes' => array(
                    'for' => 'intro_image_jp',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Contact Info
        $this->add(array(
            'name' => 'contact_info',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control ckeditor',
                'id' => 'contact_info',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => CONTACT_INFO,
                'label_attributes' => array(
                    'for' => 'contact_info',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'contact_info_en',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control ckeditor',
                'id' => 'contact_info_en',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => CONTACT_INFO . ' - ' . ENGLISH,
                'label_attributes' => array(
                    'for' => 'contact_info_en',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'contact_info_jp',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control ckeditor',
                'id' => 'contact_info_jp',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => CONTACT_INFO . ' - ' . JAPANESE,
                'label_attributes' => array(
                    'for' => 'contact_info_jp',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Youtube
        $this->add(array(
            'name' => 'iframe_youtube',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Image2',
                'style' => 'width: 500px; float: left',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => VIDEO,
                'label_attributes' => array(
                    'for' => 'iframe_youtube',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        // Address
        $this->add(array(
            'name' => 'company_address',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'company_address',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => COMPANY_ADDRESS,
                'label_attributes' => array(
                    'for' => 'company_address',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        // Number Phone
        $this->add(array(
            'name' => 'company_phone',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'company_phone',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => COMPANY_PHONE,
                'label_attributes' => array(
                    'for' => 'company_phone',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        // Email
        $this->add(array(
            'name' => 'company_email',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'company_email',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => COMPANY_EMAIL,
                'label_attributes' => array(
                    'for' => 'company_email',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        // Company Fax
        $this->add(array(
            'name' => 'company_fax',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'company_fax',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => COMPANY_FAX,
                'label_attributes' => array(
                    'for' => 'company_fax',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'company_history',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control ckeditor',
                'id' => 'company_history',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => COMPANY_HISTORY,
                'label_attributes' => array(
                    'for' => 'company_fax',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        $this->add(array(
            'name' => 'company_business',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control ckeditor',
                'id' => 'company_business',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => COMPANY_BUSINESS,
                'label_attributes' => array(
                    'for' => 'company_business',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));

    }

    public function showMessage() {
        $messages = $this->getMessages();

        if (empty($messages))
            return false;

        $xhtml = '<div class="callout callout-danger">';
        foreach ($messages as $key => $msg) {
            $xhtml .= sprintf('<p><b>%s:</b> %s</p>', ucfirst($key), current($msg));
        }
        $xhtml .= '</div>';
        return $xhtml;
    }

}
