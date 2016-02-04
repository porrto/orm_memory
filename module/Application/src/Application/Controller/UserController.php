<?php
/**
 * Created by PhpStorm.
 * User: isen
 * Date: 02/02/2016
 * Time: 22:24
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\ViewModel;

class UserController  extends AbstractActionController
{
    public function listAction() {
        $serviceLocator = $this->getServiceLocator();

        /** @var \Application\Entity\User $users */
        $users = $serviceLocator
            ->get('entity_manager')
            ->getRepository('Application\Entity\User')
            ->findAll();

        $viewModel =  new \Zend\View\Model\ViewModel(array(
            'users' => $users,
        ));

        $viewModel->setTemplate('application/user/list');

        return $viewModel;
    }

    public function addOrEditAction() {
        $serviceLocator = $this->getServiceLocator();
       /** @var \Application\Form\User $form */
       $form = $serviceLocator->get('formElementManager')->get('application.form.user');

        $viewModel =  new \Zend\View\Model\ViewModel(array(
            'form' => $form,
        ));

        $viewModel->setTemplate('application/user/add-or-edit');

        return $viewModel;
    }

    public function deleteAction() {

    }

}