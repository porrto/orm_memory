<?php

namespace Application\Form;

use Application\Persistence\ObjectManagerAwareTrait;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class User extends Form implements InputFilterProviderInterface, ObjectManagerAwareInterface
{

    use ObjectManagerAwareTrait;
    use ServiceLocatorAwareTrait;

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
            'type' => 'number',
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
            'type' => 'number',
            'name' => 'size',
            'attributes' => ['class' => 'form-control'],
            'options' => array(
                'label' => '__user_size',
            ),
        ));

        $this->add(array(
            'name' => 'skiLevel',
            'type' => 'objectselect',
            'attributes' => array(
                'class' => 'select2 full-width',
            ),
            'options' => array(
                'label' => '__user_ski_level',
                'label_attributes' => array(
                    'class' => 'control-label'
                ),
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Application\Entity\User',
                'property' => 'name'
            )
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