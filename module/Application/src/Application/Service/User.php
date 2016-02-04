<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class User implements  EventManagerAwareInterface, ServiceLocatorAwareInterface
{
    use EventManagerAwareTrait;
    use ServiceLocatorAwareTrait;

    /**
     * Save entity user in db
     *
     * @trigger save.pre, save.post
     * @param \Application\Entity\User $user
     * @return bool
     */
    public function save(\Application\Entity\User $user)
    {

        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', array('data' => $user));
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', array('data' => $user));
        return true;

    }


    public function delete(\Application\Entity\User $user)
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', array('data' => $user));
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', array());

    }

    public function addSkiLevelToUserForm(\Application\Form\User $userForm)
    {
        $skiLevelRepo = $this->getServiceLocator()
            ->get('entity_manager')
            ->getRepository('Application\Entity\SkiLevel')
            ->findAll();

        $skiLevelAsArray = array();
        /**
         * @var  $key
         * @var \Application\Entity\SkiLevel $skiLevel
         */
        foreach ($skiLevelRepo as $key => $skiLevel) {
            $skiLevelAsArray[$skiLevel->getId()] = $skiLevel->getName();
        }
        $userForm->get('skiLevel')->setValueOptions($skiLevelAsArray);
    }


    /**
     * @return EntityManager
     */
    private function getEntityManager()
    {
        return $this->getServiceLocator()->get('entity_manager');
    }
}