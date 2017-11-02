<?php

namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class Login extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->add([
            'name' => 'email',
            'options' => [
                'label' => 'Email',
            ],
            'attributes' => [
                'class' => 'beer-inputs',
            ],
            'type'  => 'Text',
        ]);
        $this->add([
            'name' => 'password',
            'options' => [
                'label' => 'Password',
            ],
            'type'  => 'Text',
        ]);

        $this->add([
            'name' => 'send',
            'type'  => 'Submit',
            'attributes' => [
                'value' => 'Submit',
            ],
        ]);

        $this->setAttribute('action', '/login/index');
        $this->setAttribute('method', 'post');
    }
}