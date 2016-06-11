<?php

namespace Admin\Form;

use \Zend\Form\Form as Form;
use Zend\Form\Element as Element;

class TopKeyword extends Form {

    public function __construct($name = null) {
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
        ));

        // ID
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        // Keyword VI
        $this->add(array(
            'name' => 'keyword_vi',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'name',
                'placeholder' => 'Nhập từ khóa',
            ),
            'options' => array(
                'label' => 'Từ khóa',
                'label_attributes' => array(
                    'for' => 'keyword_vi',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Keyword EN
        $this->add(array(
            'name' => 'keyword_en',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'name',
                'placeholder' => 'Nhập từ khóa',
            ),
            'options' => array(
                'label' => 'Từ khóa - EN',
                'label_attributes' => array(
                    'for' => 'keyword_en',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Link VI
        $this->add(array(
            'name' => 'link_vi',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'name',
                'placeholder' => 'Nhập Link',
            ),
            'options' => array(
                'label' => 'Link',
                'label_attributes' => array(
                    'for' => 'link_vi',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Link EN
        $this->add(array(
            'name' => 'link_en',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'name',
                'placeholder' => 'Nhập Link',
            ),
            'options' => array(
                'label' => 'Link - EN',
                'label_attributes' => array(
                    'for' => 'link_en',
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
