<?php

/**
 * Job form.
 *
 * @package    jobeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class JobForm extends BaseJobForm {

	public function configure() {
		$this->useFields(array(
			'category_id', 
			'type', 
			'company', 
			'logo', 
			'url', 
			'position', 
			'location', 
			'description', 
			'how_to_apply', 
			'is_public', 
			'email'
		));
		
		$this->widgetSchema['type'] = new sfWidgetFormChoice(array(
			'choices'  => JobTable::getInstance()->getTypes(),
			'expanded' => true
		));
		
		$this->widgetSchema['logo'] = new sfWidgetFormInputFile(array(
			'label' => 'Company logo',
		));
		
		$this->validatorSchema['type'] = new sfValidatorChoice(array(
			'choices' => array_keys(JobTable::getInstance()->getTypes()),
		));
		
		$this->validatorSchema['logo'] = new sfValidatorFile(array(
			'required'   => false,
			'path'       => sfConfig::get('sf_upload_dir') . '/jobs',
			'mime_types' => 'web_images',
		));
		
		$this->validatorSchema['email'] = new sfValidatorAnd(array(
			$this->validatorSchema['email'],
			new sfValidatorEmail(),
		));
		
		$this->widgetSchema->setLabels(array(
			'category_id'  => 'Category',
			'how_to_apply' => 'How to apply?',
			'is_public'    => 'Public?',
		));
		
		$this->widgetSchema->setHelp('is_public', 'Whether the job can also be published on affiliate websites or not.');
	}

}
