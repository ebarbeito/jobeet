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
	$this->getUser()->addJobToHistory($this->job);
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
    $job = $this->getRoute()->getObject();
	$this->forward404If($job->getIsActivated());
	$this->form = new JobForm($job);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $job = $this->getRoute()->getObject();
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->form = new JobForm($job);
    $this->processForm($request, $this->form);
    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
	$job = $this->getRoute()->getObject();
    $job->delete();
	$this->redirect('job/index');
  }
  
  public function executePublish(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
	$job = $this->getRoute()->getObject();
    $job->publish();
    $this->getUser()->setFlash('notice', sprintf('Your job is now online for %s days.', sfConfig::get('app_active_days')));
    $this->redirect('job_show_user', $job);
  }
  
  public function executeExtend(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $job = $this->getRoute()->getObject();
    $this->forward404Unless($job->extend());
	$this->getUser()->setFlash('notice', sprintf('Your job validity has been extended until %s.', $job->getDateTimeObject('expires_at')->format('m/d/Y')));
    $this->redirect('job_show_user', $job);
  }
  
  public function executeSearch(sfWebRequest $request)
  {
    $this->forwardUnless($query = $request->getParameter('query'), 'job', 'index');
    $this->jobs = Doctrine_Core::getTable('Job') ->getForLuceneQuery($query);
	
	if ($request->isXmlHttpRequest()) {
		if ('*' == $query || !$this->jobs) {
			return $this->renderText('No results.');
		}
		return $this->renderPartial('job/list', array('jobs' => $this->jobs));
	}
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $job = $form->save();
      $this->redirect('job_show', $job);
    }
  }
}
