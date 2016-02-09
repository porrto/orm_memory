<?php
/**
 * Created by PhpStorm.
 * User: isen
 * Date: 02/02/2016
 * Time: 22:24
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController  extends AbstractActionController
{
    public function listAction() {

        $serviceLocator = $this->getServiceLocator();

        /** @var \Application\Mapper\User $userMapper */
        $userMapper = $serviceLocator
            ->get('entity_manager')
            ->getRepository('Application\Entity\User');

        $users = $userMapper->findForAge();

        $viewModel =  new ViewModel(array(
            'users' => $users,
        ));

        $viewModel->setTemplate('application/user/list');

        return $viewModel;
    }

    public function addOrEditAction() {

        $serviceLocator = $this->getServiceLocator();

        /** @var \Application\Form\User $form */
        $form = $serviceLocator->get('formElementManager')->get('application.form.user');
        /**@var \Application\Service\User $userService */
        $userService = $serviceLocator->get('application.service.user');

        $userService->addSkiLevelToUserForm($form);

        if ($this->params()->fromRoute('user_id')) {

            /** @var \Application\Entity\User $user */
            $user = $serviceLocator
                ->get('entity_manager')
                ->getRepository('Application\Entity\User')
                ->find($this->params()->fromRoute('user_id'));

            $form->bind($user);
        }

        $data = $this->prg();

        if ($data instanceof \Zend\Http\PhpEnvironment\Response) {
            return $data;
        }

        if ($data != false) {
            $form->setData($data);
            if ($form->isValid()) {

                /** @var \Application\Entity\User $user */
                $user = $form->getData();

                $userService->save($user);

                $this->redirect()->toRoute('user/list');
            }
        }

        $viewModel =  new ViewModel(array(
            'form' => $form,
        ));

        $viewModel->setTemplate('application/user/add-or-edit');

        return $viewModel;
    }

    public function deleteAction() {

        $serviceLocator = $this->getServiceLocator();

        $userId = $this->params()->fromRoute('user_id');

        if ($userId) {
            $em = $this->getServiceLocator()->get('entity_manager');

            /** @var \Application\Entity\User $userToRemove */
            $userToRemove = $em->getRepository('Application\Entity\User')
                ->find($userId);

            if (!is_null($userToRemove)) {
                /**@var \Application\Service\User $userService */
                $userService = $serviceLocator->get('application.service.user');
                $userService->delete($userToRemove);
            }
        }
        $this->redirect()->toRoute('user/list');
    }

}