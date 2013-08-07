<?php

class CleanupTask extends sfBaseTask
{
	protected function configure()
	{
		$this->addOptions(array(
			new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application', 'public'),
			new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environement', 'prod'),
			new sfCommandOption('days', null, sfCommandOption::PARAMETER_REQUIRED, '', 90),
		));

		$this->namespace = 'jobeet';
		$this->name = 'cleanup';
		$this->briefDescription = 'Cleanup Jobeet database';

		$this->detailedDescription = <<<EOF
The [jobeet:cleanup|INFO] task cleans up the Jobeet database:
 
  [./symfony jobeet:cleanup --env=prod --days=90|INFO]
EOF;
	}

	protected function execute($arguments = array(), $options = array())
	{
		$databaseManager = new sfDatabaseManager($this->configuration);
		$nb = JobTable::getInstance()->cleanup($options['days']);
		$this->logSection('doctrine', sprintf('Removed %d stale jobs', $nb));
	}

}

?>
