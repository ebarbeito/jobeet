<?php

/**
 * affiliate actions.
 *
 * @package    jobeet
 * @subpackage affiliate
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class affiliateActions extends sfActions {

	public function executeNew(sfWebRequest $request) {
		$this->form = new AffiliateForm();
	}

	public function executeCreate(sfWebRequest $request) {
		$this->forward404Unless($request->isMethod(sfRequest::POST));
		$this->form = new AffiliateForm();
		$this->processForm($request, $this->form);
		$this->setTemplate('new');
	}
	
	public function executeWait(sfWebRequest $request) {
		
	}

	protected function processForm(sfWebRequest $request, sfForm $form) {
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid()) {
			$affiliate = $form->save();
			$this->redirect($this->generateUrl('affiliate_wait', $affiliate));
		}
	}

}
