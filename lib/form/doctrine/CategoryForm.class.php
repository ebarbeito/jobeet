<?php

/**
 * Category form.
 *
 * @package    jobeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CategoryForm extends BaseCategoryForm {

	public function configure() {
		$this->useFields(array(
			'name',
			'slug',
		));
		
		$this->embedI18n(array('en', 'es'));
		$this->widgetSchema->setLabel('en', 'English');
		$this->widgetSchema->setLabel('es', 'Spanish');
	}

}
