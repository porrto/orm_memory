<?php

namespace Application\Form;

use Application\Persistence\ObjectManagerAwareTrait;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class SkiLevel extends Form implements InputFilterProviderInterface, ObjectManagerAwareInterface
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
            'name' => 'name',
            'attributes' => ['class' => 'form-control'],
            'options' => array(
                'label' => '__label_name_ski_level',
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
            'name' => array(
                'required' => true
            ),
        );
    }


}