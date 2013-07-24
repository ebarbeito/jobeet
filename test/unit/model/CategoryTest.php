<?php

include dirname(__FILE__) . '/../../bootstrap/doctrine.php';

$t =  new lime_test(4);
$c = CategoryTable::getInstance()->createQuery()->fetchOne();
/* @var $c Category */
$t->ok($c instanceof Category, 'instanceof Category Tested object is from proper class');
$t->is($c->countActiveJobs(), 0, '->countActiveJobs() return zero jobs');
$t->is($c->countActiveJobs(), $c->getActiveJobs()->count(), '->countActiveJobs() return the expected number of jobs');
$t->is($c->getActiveJobsQuery()->execute()->count(), $c->getActiveJobs()->count(), '->getActiveJobsQuery()->execute()->count() return the expected number of jobs');

?>
