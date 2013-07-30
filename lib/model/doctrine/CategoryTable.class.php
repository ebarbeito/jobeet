<?php

/**
 * CategoryTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CategoryTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object CategoryTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Category');
    }
	
	public function getWithJobs() {
		$q = $this->createQuery('c')
		     ->leftJoin('c.Jobs j')
		     ->where('j.expires_at > ?', date('Y-m-d H:i:s', time()))
		     ->andWhere('j.is_activated = ?', 1);
		
		return $q->execute();
	}
}