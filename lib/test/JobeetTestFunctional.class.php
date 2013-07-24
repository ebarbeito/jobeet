<?php

/**
 * Description of JobeetTestFunctional
 *
 * @author ebarbeito
 */
class JobeetTestFunctional extends sfTestFunctional {
	public function getExpiredJob()
	{
		$q = Doctrine_Query::create()
		  ->from('Job j')
		  ->where('j.expires_at < ?', date('Y-m-d', time()));
		
		return $q->fetchOne();
	}
	
	public function getMostRecentProgrammingJob()
	{
		$q = Doctrine_Query::create()
		  ->select('j.*')
		  ->from('Job j')
		  ->leftJoin('j.Category c')
		  ->where('c.slug = ?', 'programming');
		$q = JobTable::getInstance()->addActiveJobsQuery($q);
		
		return $q->fetchOne();
	}
	
	public function loadData()
	{
		Doctrine_Core::loadData(sfConfig::get('sf_test_dir') . '/fixtures');
		return $this;
	}
}

?>
