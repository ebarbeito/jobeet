<?php

class myUser extends sfGuardSecurityUser {

	public function getJobHistory() {
		$ids = $this->getAttribute('job_history', array());
		if (!empty($ids)) {
			return Doctrine_Core::getTable('Job')
				->createQuery('a')
				->whereIn('a.id', $ids)
				->execute();
		}

		return array();
	}
	
	public function resetJobHistory() {
		$this->getAttributeHolder()->remove('job_history');
	}

}