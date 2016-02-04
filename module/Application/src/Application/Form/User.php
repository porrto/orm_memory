<?php

namespace Application\Form;

use Application\Persistence\ObjectManagerAwareTrait;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class User extends Form implements InputFilterProviderInterface, ObjectManagerAwareInterface
{

    use ObjectManagerAwareTrait;

    public function init()
    {
        $this->setAttribute('novalidate', 'novalidate');
        $this->setAttribute('autocomplete', 'off');
        $this->setAttribute('role', 'form');

        $this->add(array(
            'type' => 'text',
            'name' => 'firstName',
            'attributes' => ['class' => 'form-control'],
            'options' => array(
                'label' => '__user_first_name',
            ),
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'lastName',
            'attributes' => ['class' => 'form-control'],
            'options' => array(
                'label' => '__user_last_name',
            ),
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'age',
            'attributes' => ['class' => 'form-control'],
            'options' => array(
                'label' => '__user_age',
            ),
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'sex',
            'attributes' => ['class' => 'form-control'],
            'options' => array(
                'label' => '__user_sex',
            ),
        ));

        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => ['class' => 'btn btn-success']
        ));
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array(
            'firstName' => array(
                'required' => true
            ),
            'lastName' => array(
                'required' => false
            ),
        );
    }


}