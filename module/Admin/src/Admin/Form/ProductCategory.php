<?php

namespace Admin\Form;

use Admin\Model\ProductCategoryTable;
use \Zend\Form\Form as Form;

class ProductCategory extends Form {

    public function __construct(ProductCategoryTable $categoryTable) {
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

        // Description
        $this->add(array(
            'name' => 'description',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'description',
            ),
            'options' => array(
                'label' => DESCRIPTION,
                'label_attributes' => array(
                    'for' => 'description',
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
        
        // Name - English
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

        // Description - English
        $this->add(array(
            'name' => 'description_en',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'description_en',
            ),
            'options' => array(
                'label' => DESCRIPTION . ' - ' . ENGLISH,
                'label_attributes' => array(
                    'for' => 'description_en',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Keywords - English
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
        
        // Name - Japanese
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
                    'for' => 'name_en',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));

        // Description - Japanese
        $this->add(array(
            'name' => 'description_jp',
            'type' => 'Textarea',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'description_jp',
            ),
            'options' => array(
                'label' => DESCRIPTION . ' - ' . JAPANESE,
                'label_attributes' => array(
                    'for' => 'description_jp',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));

        // Keywords - Japanese
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
        
        // Parent
        $this->add(array(
            'name' => 'parent',
            'type' => 'Select',
            'options' => array(
                'empty_option' => '-- ' . CHOOSE . ' --',
                'value_options' => $categoryTable->itemInSelectbox(null, array('task' => 'form-category')),
                'label' => PARENT_CATEGORY,
                'label_attributes' => array(
                    'for' => 'parent',
                    'class' => 'col-xs-3 control-label',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
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
