<?php

/**
 * job actions.
 *
 * @package    jobeet
 * @subpackage job
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jobActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	  $this->categories = Doctrine_Core::getTable('Category')->getWithJobs();
  }

  public function executeShow(sfWebRequest $request)
  {
//	$this->job = JobTable::getInstance()->findOneById($request->getParameter('id'));
//	$this->job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id')));
//	$this->forward404Unless($this->job);
	$this->job = $this->getRoute()->getObject();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new JobForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->form = new JobForm();
    $this->processForm($request, $this->form);
    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));
    $this->form = new JobForm($job);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));
    $this->form = new JobForm($job);
    $this->processForm($request, $this->form);
    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));
    $job->delete();

    $this->redirect('job/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $job = $form->save();

      $this->redirect('job/edit?id='.$job->getId());
    }
  }
}
