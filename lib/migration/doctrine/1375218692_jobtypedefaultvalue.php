<?php

class Jobtypedefaultvalue extends Doctrine_Migration_Base
{
  public function up()
  {
	  $jobs = JobTable::getInstance()->findAll();
	  array_map(function ($job) {
		  if (!$job->getType()) {
			  /* @var $job Job */
			  $job->setType('full-time');
			  $job->save();
		  }
	  }, $jobs->getData());
  }

  public function down()
  {
  }
}
