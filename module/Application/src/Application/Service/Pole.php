<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\Form\Form;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class Pole implements  EventManagerAwareInterface, ServiceLocatorAwareInterface
{
    use EventManagerAwareTrait;
    use ServiceLocatorAwareTrait;

    /**
     * Save entity pole in db
     *
     * @trigger save.pre, save.post
     * @param \Application\Entity\Pole $pole
     * @return bool
     */
    public function save(\Application\Entity\Pole $pole)
    {
        $this->getEntityManager()->persist($pole);
        $this->getEntityManager()->flush();
        return true;

    }


    public function delete(\Application\Entity\Pole $pole)
    {
        $this->getEntityManager()->remove($pole);
        $this->getEntityManager()->flush();
    }

    public function addUserToPoleForm(\Application\Form\Pole $poleForm)
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
        $poleForm->get('user')->setValueOptions($userAsArray);
    }


    /**
     * @return EntityManager
     */
    private function getEntityManager()
    {
        return $this->getServiceLocator()->get('entity_manager');
    }
}