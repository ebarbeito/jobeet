<?php

/**
 * Affiliate form.
 *
 * @package    jobeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AffiliateForm extends BaseAffiliateForm {

	public function configure() {
		$this->useFields(array(
			'url',
			'email',
			'categories_list'
		));
		
		$this->widgetSchema['categories_list']->setOption('expanded', true);
		$this->widgetSchema['categories_list']->setLabel('Categories');

		$this->validatorSchema['categories_list']->setOption('required', true);

		$this->widgetSchema['url']->setLabel('Your website URL');
		$this->widgetSchema['url']->setAttribute('size', 50);

		$this->widgetSchema['email']->setAttribute('size', 50);

		$this->validatorSchema['email'] = new sfValidatorEmail(array('required' => true));
	}

}
