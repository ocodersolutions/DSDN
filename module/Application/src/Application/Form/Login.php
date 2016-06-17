<?php

namespace Application\Form;

use \Zend\Form\Form as Form;

class Login extends Form {

    public function __construct($name = null) {
        parent::__construct();

        // FORM Attribute
        $this->setAttributes(array(
            'action' => '',
            'method' => 'POST',
            'name' => 'ApplicationForm',
            'id' => 'ApplicationForm',
            'enctype' => 'multipart/form-data',
        ));

        // Username
        $this->add(array(
            'name' => 'username',
            'type' => 'Text',
            'attributes' => array(
                'class' => 'input_fname',
                'id' => 'username',
                'placeholder' => USERNAME,
            ),
            'options' => array(
                'label' => USERNAME,
                'label_attributes' => array(
                    'class' => 'padd-form control-label col-sm-5',
                )
            ),
        ));

        // Password
        $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'attributes' => array(
                'class' => 'input_fname',
                'id' => 'password',
                'placeholder' => PASSWORD,
            ),
            'options' => array(
                'label' => PASSWORD,
                'label_attributes' => array(
                    'class' => 'padd-form control-label col-sm-5',
                )
            ),
        ));
    }

}
