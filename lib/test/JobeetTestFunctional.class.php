<?php

/**
 * Description of JobeetTestFunctional
 *
 * @author ebarbeito
 */
class JobeetTestFunctional extends sfTestFunctional {

	public function createJob($values = array(), $publish = false) {
		$this->
				get('/en/job/new')->
				click('Preview your job', array('job' => array_merge(array(
						'company' => 'Sensio Labs',
						'url' => 'http://www.sensio.com/',
						'position' => 'Developer',
						'location' => 'Atlanta, USA',
						'description' => 'You will work with symfony to develop websites for our customers.',
						'how_to_apply' => 'Send me an email',
						'email' => 'for.a.job@example.com',
						'is_public' => false,
							), $values)))->
				followRedirect()
		;

		if ($publish) {
			$this->
					click('Publish', array(), array('method' => 'put', '_with_csrf' => true))->
					followRedirect()
			;
		}

		return $this;
	}

	public function getJobByPosition($position) {
		$q = Doctrine_Query::create()->
				from('Job j')->
				where('j.position = ?', $position);

		return $q->fetchOne();
	}

	public function getExpiredJob() {
		$q = Doctrine_Query::create()
				->from('Job j')
				->where('j.expires_at < ?', date('Y-m-d', time()));

		return $q->fetchOne();
	}

	public function getMostRecentProgrammingJob() {
		$q = Doctrine_Query::create()
				->select('j.*')
				->from('Job j')
				->leftJoin('j.JobeetCategory c')
				->leftJoin('c.Translation t')
				->where('t.slug = ?', 'programming');

		$q = Doctrine_Core::getTable('Job')->addActiveJobsQuery($q);

		return $q->fetchOne();
	}

	public function loadData() {
		Doctrine_Core::loadData(sfConfig::get('sf_test_dir') . '/fixtures');
		return $this;
	}

}

?>
