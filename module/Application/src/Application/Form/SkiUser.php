<?php

namespace Application\Form;

use Application\Persistence\ObjectManagerAwareTrait;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class SkiUser extends Form implements InputFilterProviderInterface, ObjectManagerAwareInterface
{

    use ObjectManagerAwareTrait;
    use ServiceLocatorAwareTrait;

    public function init()
    {
        $this->setAttribute('novalidate', 'novalidate');
        $this->setAttribute('autocomplete', 'off');
        $this->setAttribute('role', 'form');

        $this->add(array(
            'name' => 'user',
            'type' => 'objectselect',
            'attributes' => array(
                'class' => 'select2 full-width',
            ),
            'options' => array(
                'label' => '__label_user',
                'label_attributes' => array(
                    'class' => 'control-label'
                ),
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Application\Entity\User',
                'property' => 'name'
            )
        ));

        $this->add(array(
            'name' => 'ski',
            'type' => 'objectselect',
            'attributes' => array(
                'class' => 'select2 full-width',
            ),
            'options' => array(
                'label' => '__list_ski',
                'label_attributes' => array(
                    'class' => 'control-label'
                ),
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Application\Entity\Ski',
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
            'user' => array(
                'required' => false
            ),
            'ski' => array(
                'required' => false
            ),
        );
    }


}