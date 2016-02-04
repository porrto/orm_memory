<?php

namespace Application\Form\Element;

use Zend\Form\Element;

class Switchery extends \Zend\Form\Element\Checkbox
{
    /**
     * Seed attributes
     *
     * @var array
     */
    protected $attributes = [
        'type'  =>  'checkbox',
        'data-init-plugin' => 'switchery',
        'class' =>  'js-switch',
    ];

}
