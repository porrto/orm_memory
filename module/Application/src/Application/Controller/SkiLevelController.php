<?php
/**
 * Created by PhpStorm.
 * User: isen
 * Date: 02/02/2016
 * Time: 22:27
 */

namespace Application\Controller;


use Zend\Mvc\Application;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SkiLevelController extends AbstractActionController
{
    public function listAction() {

        $serviceLocator = $this->getServiceLocator();

        /** @var \Application\Entity\SkiLevel $skiLevels */
        $skiLevels = $serviceLocator
            ->get('entity_manager')
            ->getRepository('Application\Entity\SkiLevel')
            ->findAll();

        $viewModel =  new ViewModel(array(
            'skiLevels' => $skiLevels,
        ));

        $viewModel->setTemplate('application/ski-level/list');

        return $viewModel;
    }

    public function addOrEditAction() {

        $serviceLocator = $this->getServiceLocator();

        /** @var \Application\Form\SkiLevel $form */
        $form = $serviceLocator->get('formElementManager')->get('application.form.skiLevel');

        if ($this->params()->fromRoute('ski-level_id')) {

            /** @var \Application\Entity\SkiLevel $skiLevel */
            $skiLevel = $serviceLocator
                ->get('entity_manager')
                ->getRepository('Application\Entity\SkiLevel')
                ->find($this->params()->fromRoute('ski-level_id'));

            $form->bind($skiLevel);
        }
            $data = $this->prg();

        if ($data instanceof \Zend\Http\PhpEnvironment\Response) {
            return $data;
        }

        if ($data != false) {
            $form->setData($data);
            if ($form->isValid()) {

                $skiLevel = $form->getData();

                /**@var \Application\Service\SkiLevel $skiLevelService */
                $skiLevelService = $serviceLocator->get('application.service.skiLevel');
                $skiLevelService->save($skiLevel);

                $this->redirect()->toRoute('ski-level/list');
            }
        }

        $viewModel =  new ViewModel(array(
            'form' => $form,
        ));

        $viewModel->setTemplate('application/ski-level/add-or-edit');

        return $viewModel;

    }

    public function deleteAction() {

        $serviceLocator = $this->getServiceLocator();

        $skiLevelId = $this->params()->fromRoute('ski-level_id');

        if ($skiLevelId) {
            $em = $this->getServiceLocator()->get('entity_manager');

            /** @var \Application\Entity\SkiLevel $skiLevelToRemove */
            $skiLevelToRemove = $em->getRepository('Application\Entity\SkiLevel')
                ->find($skiLevelId);

            if (!is_null($skiLevelToRemove)) {
                /**@var \Application\Service\SkiLevel $skiLevelService */
                $skiLevelService = $serviceLocator->get('application.service.skiLevel');
                $skiLevelService->delete($skiLevelToRemove);
            }
        }
        $this->redirect()->toRoute('ski-level/list');
    }
}