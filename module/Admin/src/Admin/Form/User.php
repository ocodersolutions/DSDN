<?php
namespace Admin\Form;

use \Zend\Form\Form as Form;

class User extends Form {

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
        
        // Username 
        $this->add(array(
            'name' => 'username',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'username',
                'placeholder' => USERNAME,
            ),
            'options' => array(
                'label' => USERNAME,
                'label_attributes' => array(
                    'for' => 'username',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));

        // Email
        $this->add(array(
            'name' => 'email',
            'type' => 'Email',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'email',
                'placeholder' => 'mail@domain.com',
            ),
            'options' => array(
                'label' => EMAIL,
                'label_attributes' => array(
                    'for' => 'email',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));
        
        // Fullname
        $this->add(array(
            'name' => 'fullname',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'fullname',
                'placeholder' => FULLNAME,
            ),
            'options' => array(
                'label' => FULLNAME,
                'label_attributes' => array(
                    'for' => 'fullname',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));

        // Password
        $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'password',
                'placeholder' => PASSWORD,
            ),
            'options' => array(
                'label' => PASSWORD,
                'label_attributes' => array(
                    'for' => 'password',
                    'class' => 'col-xs-3 control-label',
                )
            ),
        ));

        // Published
        $this->add(array(
            'name' => 'published',
            'type' => 'Select',
            'options' => array(
                'empty_option' => '-- ' . PUBLISHED . ' --',
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
