<?php
/**
 * Created by PhpStorm.
 * User: isen
 * Date: 02/02/2016
 * Time: 22:27
 */

namespace Application\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SkiController extends AbstractActionController
{
    public function listAction() {

        $serviceLocator = $this->getServiceLocator();

        /** @var \Application\Entity\Ski $skis */
        $skis = $serviceLocator
            ->get('entity_manager')
            ->getRepository('Application\Entity\Ski')
            ->findAll();

        $viewModel =  new ViewModel(array(
            'skis' => $skis,
        ));

        $viewModel->setTemplate('application/ski/list');

        return $viewModel;

    }

    public function addOrEditAction() {

        $serviceLocator = $this->getServiceLocator();

        /** @var \Application\Form\Ski $form */
        $form = $serviceLocator->get('formElementManager')->get('application.form.ski');
        /**@var \Application\Service\Ski $skiService */
        $skiService = $serviceLocator->get('application.service.ski');

        $data = $this->prg();

        if ($data instanceof \Zend\Http\PhpEnvironment\Response) {
            return $data;
        }

        if ($data != false) {
            $form->setData($data);
            if ($form->isValid()) {

                /** @var \Application\Entity\Ski $ski */
                $ski = $form->getData();

                //$skiService->addUserForSki($form, $ski);
                $skiService->save($ski);

                $this->redirect()->toRoute('ski/list');
            }
        }

        $viewModel =  new ViewModel(array(
            'form' => $form,
        ));

        $viewModel->setTemplate('application/ski/add-or-edit');

        return $viewModel;
    }

    public function addUserAction() {
        $serviceLocator = $this->getServiceLocator();

        /** @var \Application\Form\SkiUser $form */
        $form = $serviceLocator->get('formElementManager')->get('application.form.ski.user');
        /**@var \Application\Service\Ski $skiService */
        $skiService = $serviceLocator->get('application.service.ski');

        $skiService->addUserToSkiForm($form);
        $skiService->addSkiListForm($form);

        $data = $this->prg();

        if ($data instanceof \Zend\Http\PhpEnvironment\Response) {
            return $data;
        }

        if ($data != false) {

            $form->setData($data);
            if ($form->isValid()) {

                /** @var \Application\Entity\Ski $ski */
                $ski = $serviceLocator
                    ->get('entity_manager')
                    ->getRepository('Application\Entity\Ski')
                    ->find($form->get('ski')->getValue());

                $skiService->addUserForSki($form, $ski);
                $skiService->save($ski);

                $this->redirect()->toRoute('ski/list');
            }
        }

        $viewModel =  new ViewModel(array(
            'form' => $form,
        ));

        $viewModel->setTemplate('application/ski/add-user');

        return $viewModel;

    }

    public function deleteAction() {

    }
}