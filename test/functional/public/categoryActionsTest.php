<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$maxJobsHome = sfConfig::get('app_max_jobs_on_homepage');
$maxJobsCategory = sfConfig::get('app_max_jobs_on_category');
$browser = new JobeetTestFunctional(new sfBrowser());
$browser->loadData();

$browser->info('1 - The category page')->
  info('  1.1 - Categories on homepage are clickable')->
  get('/en/')->
  click('Programming')->
  with('request')->begin()->
    isParameter('module', 'category')->
    isParameter('action', 'show')->
    isParameter('slug', 'programming')->
  end()->
 
  info(sprintf('  1.2 - Categories with more than %s jobs also have a "more" link', $maxJobsHome))->
  get('/en/')->
  click('21')->
  with('request')->begin()->
    isParameter('module', 'category')->
    isParameter('action', 'show')->
    isParameter('slug', 'programming')->
  end()->
 
  info(sprintf('  1.3 - Only %s jobs are listed', $maxJobsCategory))->
  with('response')->checkElement('.jobs tr', $maxJobsCategory)->
 
  info('  1.4 - The job listed is paginated')->
  with('response')->begin()->
    checkElement('.pagination_desc', '/31 jobs/')->
    checkElement('.pagination_desc', '#page 1/4#')->
  end()->
 
  click('2')->
  with('request')->begin()->
    isParameter('page', 2)->
  end()->
  with('response')->checkElement('.pagination_desc', '#page 2/4#')
;