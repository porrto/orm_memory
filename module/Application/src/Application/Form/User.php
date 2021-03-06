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
            'type' => 'select',
            'name' => 'sex',
            'attributes' => ['class' => 'select2 full-width'],
            'options' => array(
                'label' => '__user_sex',
                'empty_option' => '__label_select_sex',
                'value_options' => array(
                    \Application\Entity\User::SEX_F => \Application\Entity\User::SEX_F,
                    \Application\Entity\User::SEX_M => \Application\Entity\User::SEX_M,
                ),
            )
        ));

        $this->add(array(
            'type' => 'select',
            'name' => 'ageMax',
            'attributes' => ['class' => 'select2 full-width', 'id' => 'ageMax'],
            'options' => array(
                'label' => '__label_choice_max_age',
                'empty_option' => '__label_select_age',
                'value_options' => array(
                    '25' => '25',
                    '50' => '50',
                ),
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
                'required' => true
            ),
            'age' => array(
                'required' => true
            ),
            'size' => array(
                'required' => true
            ),
            'skiLevel' => array(
                'required' => true
            ),
            'sex' => array(
                'required' => true
            ),
            'ageMax' => array(
                'required' => false
            ),
        );
    }


}