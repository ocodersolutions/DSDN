<?php

namespace Admin\Form;

use Admin\Model\ProductCategoryTable;
use \Zend\Form\Form as Form;
use Zend\Form\Element as Element;

class Article extends Form {

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
                'class' => 'form-control ckeditor',
                'id' => 'intro',
                'rows' => '20',
            ),
            'options' => array(
                'label' => INTRO,
                'label_attributes' => array(
                    'for' => 'intro',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Content
        $this->add(array(
            'name' => 'content',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control ckeditor',
                'id' => 'content',
            ),
            'options' => array(
                'label' => DESCRIPTION,
                'label_attributes' => array(
                    'for' => 'content',
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
                'class' => 'form-control ckeditor',
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
        
        // Content English
        $this->add(array(
            'name' => 'content_en',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control ckeditor',
                'id' => 'content_en',
            ),
            'options' => array(
                'label' => DESCRIPTION . ' - ' . ENGLISH,
                'label_attributes' => array(
                    'for' => 'content_en',
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
                'class' => 'form-control ckeditor',
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
        
        // Content Japanese
        $this->add(array(
            'name' => 'content_jp',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control ckeditor',
                'id' => 'content_jp',
            ),
            'options' => array(
                'label' => DESCRIPTION . ' - ' . JAPANESE,
                'label_attributes' => array(
                    'for' => 'content_jp',
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

        // Ordering
        $this->add(array(
            'name' => 'ordering',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'ordering',
                'placeholder' => 'Enter ordering',
            ),
            'options' => array(
                'label' => ORDERING,
                'label_attributes' => array(
                    'for' => 'ordering',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));

        // Price
        $this->add(array(
            'name' => 'price',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'price',
                'placeholder' => '',
            ),
            'options' => array(
                'label' => PRICE,
                'label_attributes' => array(
                    'for' => 'price',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));

        // Status
        $this->add(array(
            'name' => 'status',
            'type' => 'Select',
            'options' => array(
                'empty_option' => '-- ' . CHOOSE . ' --',
                'value_options' => array(
                    'active' => ACTIVE,
                    'inactive' => INACTIVE,
                ),
                'label' => PUBLISHED,
                'label_attributes' => array(
                    'for' => 'status',
                    'class' => 'col-xs-3 control-label',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));

        // Sale Off Type
        $this->add(array(
            'name' => 'sale_off_type',
            'type' => 'Select',
            'options' => array(
                'empty_option' => '-- Select sale off type --',
                'value_options' => array(
                    'number' => 'Number',
                    'percent' => 'Percent',
                    'none' => 'No Sale Off',
                ),
                'label' => 'Sale off type',
                'label_attributes' => array(
                    'for' => 'sale_off_type',
                    'class' => 'col-xs-3 control-label',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));

        // Sale off value
        $this->add(array(
            'name' => 'sale_off_value',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'sale_off_value',
                'placeholder' => 'Enter sale off value',
            ),
            'options' => array(
                'label' => 'Sale off value',
                'label_attributes' => array(
                    'for' => 'sale_off_value',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));

        // Special
        $this->add(array(
            'name' => 'special',
            'type' => 'Select',
            'options' => array(
                'empty_option' => '-- ' . CHOOSE . ' --',
                'value_options' => array(
                    'yes' => SPECIAL,
                    'no' => NORMAL,
                ),
                'label' => SPECIAL,
                'label_attributes' => array(
                    'for' => 'special',
                    'class' => 'col-xs-3 control-label',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
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
