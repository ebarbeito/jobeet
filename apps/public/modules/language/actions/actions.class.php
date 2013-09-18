<?php

/**
 * language actions.
 *
 * @package    jobeet
 * @subpackage language
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class languageActions extends sfActions {

	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request) {
		$this->forward('default', 'module');
	}

	public function executeChangeLanguage(sfWebRequest $request) {
		$form = new sfFormLanguage(
			$this->getUser(),
			array('languages' => array('en', 'es'))
		);

		$form->process($request);

		return $this->redirect('localized_homepage');
	}

}
