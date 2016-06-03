<?php

namespace Admin\Form;

use \Zend\Form\Form as Form;

class Category extends Form {

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

        // Intro
        $this->add(array(
            'name' => 'intro',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'intro',
            ),
            'options' => array(
                'label' => INTRO,
                'label_attributes' => array(
                    'for' => 'intro',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Keywords
        $this->add(array(
            'name' => 'keyword',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'keyword',
            ),
            'options' => array(
                'label' => KEYWORD,
                'label_attributes' => array(
                    'for' => 'keyword',
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

        // Intro English
        $this->add(array(
            'name' => 'intro_en',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'intro_en',
            ),
            'options' => array(
                'label' => INTRO . ' - ' . ENGLISH,
                'label_attributes' => array(
                    'for' => 'intro_en',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Keywords English
        $this->add(array(
            'name' => 'keyword_en',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'keyword_en',
            ),
            'options' => array(
                'label' => KEYWORD . ' - ' . ENGLISH,
                'label_attributes' => array(
                    'for' => 'keyword_en',
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

        // Intro Japanese
        $this->add(array(
            'name' => 'intro_jp',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'intro_jp',
            ),
            'options' => array(
                'label' => INTRO . ' - ' . JAPANESE,
                'label_attributes' => array(
                    'for' => 'intro_jp',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Keywords Japanese
        $this->add(array(
            'name' => 'keyword_jp',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'keyword_jp',
            ),
            'options' => array(
                'label' => KEYWORD . ' - ' . JAPANESE,
                'label_attributes' => array(
                    'for' => 'keyword_jp',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));

        // Thumbnail
        $this->add(array(
            'name' => 'thumbnail',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Image',
                'placeholder' => '',
                'style' => 'width: 70%; float: left',
            ),
            'options' => array(
                'label' => IMAGE_THUMBNAIL,
                'label_attributes' => array(
                    'for' => 'thumbnail',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
    }

}
