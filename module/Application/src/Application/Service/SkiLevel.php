<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class SkiLevel implements  EventManagerAwareInterface, ServiceLocatorAwareInterface
{
    use EventManagerAwareTrait;
    use ServiceLocatorAwareTrait;

    /**
     * Save entity skiLevel in db
     *
     * @trigger save.pre, save.post
     * @param \Application\Entity\SkiLevel $skiLevel
     * @return bool
     */
    public function save(\Application\Entity\SkiLevel $skiLevel)
    {

        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', array('data' => $skiLevel));
        $this->getEntityManager()->persist($skiLevel);
        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', array('data' => $skiLevel));
        return true;

    }


    public function delete(\Application\Entity\SkiLevel $skiLevel)
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', array('data' => $skiLevel));
        $this->getEntityManager()->remove($skiLevel);
        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', array());

    }

    /**
     * @return EntityManager
     */
    private function getEntityManager()
    {
        return $this->getServiceLocator()->get('entity_manager');
    }
}