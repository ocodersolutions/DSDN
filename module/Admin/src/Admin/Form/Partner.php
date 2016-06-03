<?php

namespace Admin\Form;

use \Zend\Form\Form as Form;
use Zend\Form\Element as Element;

class Partner extends Form {

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
            'style' => 'padding-top: 20px;',
            'enctype' => 'multipart/form-data'
        ));
        // Name
        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'name',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => NAME,
                'label_attributes' => array(
                    'for' => 'name',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        // Name Japanese
        $this->add(array(
            'name' => 'name_jp',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'name_jp',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => NAME . ' - ' . JAPANESE,
                'label_attributes' => array(
                    'for' => 'name_jp',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        // Name English
        $this->add(array(
            'name' => 'name_en',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'name_en',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => NAME . ' - ' . ENGLISH,
                'label_attributes' => array(
                    'for' => 'name_en',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        // Website
        $this->add(array(
            'name' => 'website',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'name',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => WEBSITE,
                'label_attributes' => array(
                    'for' => 'name',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        
        // Description_vi
        $this->add(array(
            'name' => 'description',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'description',
                'style' =>'resize:none',
                'rows' => '4',
            ),
            'options' => array(
                'label' => DESCRIPTION,
                'label_attributes' => array(
                    'for' => 'description',
                    'class' => 'col-xs-3 control-label',
                )
            ),
         ));   
        // Description English
        $this->add(array(
            'name' => 'description_en',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'description_en',
                'style' =>'resize:none',
                'rows' => '4',
            ),
            'options' => array(
                'label' => DESCRIPTION . ' - ' . ENGLISH,
                'label_attributes' => array(
                    'for' => 'description_en',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Description Japanese
        $this->add(array(
            'name' => 'description_jp',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'description_jp',
                'style' =>'resize:none',
                'rows' => '4',
            ),
            'options' => array(
                'label' => DESCRIPTION . ' - ' . JAPANESE,
                'label_attributes' => array(
                    'for' => 'description_jp',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        // ID
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
        
        // Logo
        $this->add(array(
            'name' => 'logo',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Image1',
                'placeholder' => 'Chọn logo',
                'style' =>'width: 42%; float: left; margin-left: 15px;'
            ),
        ));
        // Button Chọn ảnh
        $this->add(array(
            'name' => 'selectImage',
            'type' => 'button',
            'attributes' => array(
                'style' => 'height: 34px',
                'id' => 'BrowseImageIcon1',
                'placeholder' => '',
                'value' => BROWSER_IMAGE,
            ),
        ));

        // Action
        $this->add(array(
            'name' => 'action',
            'attributes' => array(
                'type' => 'hidden',
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
