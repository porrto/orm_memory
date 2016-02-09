<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PoleController extends AbstractActionController
{
    public function listAction() {

        $serviceLocator = $this->getServiceLocator();

        /** @var \Application\Entity\Pole $poles */
        $poles = $serviceLocator
            ->get('entity_manager')
            ->getRepository('Application\Entity\Pole')
            ->findAll();

        $viewModel =  new ViewModel(array(
            'poles' => $poles,
        ));

        $viewModel->setTemplate('application/pole/list');

        return $viewModel;
    }

    public function addOrEditAction() {

        $serviceLocator = $this->getServiceLocator();

        /** @var \Application\Form\Pole $form */
        $form = $serviceLocator->get('formElementManager')->get('application.form.pole');
        /**@var \Application\Service\Pole $poleService */
        $poleService = $serviceLocator->get('application.service.pole');

        $poleService->addUserToPoleForm($form);

        if ($this->params()->fromRoute('pole_id')) {

            /** @var \Application\Entity\Pole $pole */
            $pole = $serviceLocator
                ->get('entity_manager')
                ->getRepository('Application\Entity\Pole')
                ->find($this->params()->fromRoute('pole_id'));

            $form->bind($pole);
        }

        $data = $this->prg();

        if ($data instanceof \Zend\Http\PhpEnvironment\Response) {
            return $data;
        }

        if ($data != false) {
            $form->setData($data);
            if ($form->isValid()) {

                /** @var \Application\Entity\Pole $pole */
                $pole = $form->getData();

                $poleService->save($pole);

                $this->redirect()->toRoute('pole/list');
            }
        }

        $viewModel =  new ViewModel(array(
            'form' => $form,
        ));

        $viewModel->setTemplate('application/pole/add-or-edit');

        return $viewModel;
    }

    public function deleteAction() {

        $serviceLocator = $this->getServiceLocator();

        $poleId = $this->params()->fromRoute('pole_id');

        if ($poleId) {
            $em = $this->getServiceLocator()->get('entity_manager');

            /** @var \Application\Entity\Pole $poleToRemove */
            $poleToRemove = $em->getRepository('Application\Entity\Pole')
                ->find($poleId);

            if (!is_null($poleToRemove)) {
                /**@var \Application\Service\Pole $poleService */
                $poleService = $serviceLocator->get('application.service.pole');
                $poleService->delete($poleToRemove);
            }
        }
        $this->redirect()->toRoute('pole/list');
    }
}
