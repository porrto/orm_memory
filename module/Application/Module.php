<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Form\Ski;
use Application\Form\SkiLevel;
use Application\Form\User;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getFormElementConfig()
    {
        return array(
            'factories' => [
                'application.form.user' => function (\Zend\Form\FormElementManager $fem) {
                    $em = $fem->getServiceLocator()->get('entity_manager');

                    $form = new User();
                    $form->setObjectManager($em);
                    $form->setObject(new \Application\Entity\User());
                    $form->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($em));
                    return $form;
                },
                'application.form.skiLevel' => function (\Zend\Form\FormElementManager $fem) {
                    $em = $fem->getServiceLocator()->get('entity_manager');

                    $form = new SkiLevel();
                    $form->setObjectManager($em);
                    $form->setObject(new \Application\Entity\SkiLevel());
                    $form->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($em));
                    return $form;
                },
                'application.form.ski' => function (\Zend\Form\FormElementManager $fem) {
                    $em = $fem->getServiceLocator()->get('entity_manager');

                    $form = new Ski();
                    $form->setObjectManager($em);
                    $form->setObject(new \Application\Entity\Ski());
                    $form->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($em));
                    return $form;
                },
            ],
        );
    }

    public function getServiceConfig()  {
        return array(
            'invokables' => array(
                'application.service.user' => 'Application\Service\User',
                'application.service.skiLevel' => 'Application\Service\SkiLevel',
                'application.service.ski' => 'Application\Service\Ski',
            )
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                //Views
                'locale' => 'Application\View\Helper\Locale',
            )
        );
    }
}
