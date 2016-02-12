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
        $this->getEntityManager()->persist($ski);
        $this->getEntityManager()->flush();
        return true;

    }

    public function addUserForSki(\Application\Form\SkiUser $skiUserForm, \Application\Entity\Ski $ski)
    {
        /** @var \Application\Entity\User $user */
        $user = $this->getServiceLocator()
            ->get('entity_manager')
            ->getRepository('Application\Entity\User')
            ->find($skiUserForm->get('user')->getValue());
        $ski->addUser($user);

        $this->getEntityManager()->persist($ski);
    }

    public function delete(\Application\Entity\Ski $ski)
    {
        $this->getEntityManager()->remove($ski);
        $this->getEntityManager()->flush();
    }

    public function addUserToSkiForm(\Application\Form\SkiUser $skiUserForm)
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
        $skiUserForm->get('user')->setValueOptions($userAsArray);
    }

    public function addSkiListForm(\Application\Form\SkiUser $skiUserForm)
    {
        $skiRepo = $this->getServiceLocator()
            ->get('entity_manager')
            ->getRepository('Application\Entity\Ski')
            ->findAll();

        $skiAsArray = array();
        /**
         * @var  $key
         * @var \Application\Entity\Ski $ski
         */
        foreach ($skiRepo as $key => $ski) {
            $skiAsArray[$ski->getId()] = $ski->getName();
        }
        $skiUserForm->get('ski')->setValueOptions($skiAsArray);
    }

    /**
     * @return EntityManager
     */
    private function getEntityManager()
    {
        return $this->getServiceLocator()->get('entity_manager');
    }
}