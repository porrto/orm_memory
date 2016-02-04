<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class Ski implements  EventManagerAwareInterface, ServiceLocatorAwareInterface
{
    use EventManagerAwareTrait;
    use ServiceLocatorAwareTrait;

    /**
     * Save entity ski in db
     *
     * @trigger save.pre, save.post
     * @param \Application\Entity\Ski $ski
     * @return bool
     */
    public function save(\Application\Entity\Ski $ski)
    {

        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', array('data' => $ski));
        $this->getEntityManager()->persist($ski);
        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', array('data' => $ski));
        return true;

    }


    public function delete(\Application\Entity\Ski $ski)
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', array('data' => $ski));
        $this->getEntityManager()->remove($ski);
        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', array());

    }

    public function addUserToSkiForm(\Application\Form\Ski $skiForm)
    {
        $userRepo = $this->getServiceLocator()
            ->get('entity_manager')
            ->getRepository('Application\Entity\User')
            ->findAll();

        $userAsArray = array();
        /**
         * @var  $key
         * @var \Application\Entity\User $user
         */
        foreach ($userRepo as $key => $user) {
            $userAsArray[$user->getId()] = $user->getFirstName();
        }
        $skiForm->get('user')->setValueOptions($userAsArray);
    }

    /**
     * @return EntityManager
     */
    private function getEntityManager()
    {
        return $this->getServiceLocator()->get('entity_manager');
    }
}