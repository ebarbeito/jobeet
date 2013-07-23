<?php use_stylesheet('jobs.css') ?>
<?php $maxJobs = sfConfig::get('app_max_jobs_on_homepage'); ?>

<div id="jobs">
  <?php foreach ($categories as $category): ?>
    <div class="category_<?php echo Jobeet::slugify($category->getName()) ?>">
      <div class="category">
        <div class="feed">
          <a href="">Feed</a>
        </div>
        <h1><?php echo link_to($category, '@category?slug=' . $category->getSlug()) ?></h1>
      </div>
 
      <?php include_partial('list', array('jobs' => $category->getActiveJobs($maxJobs))) ?>

      <?php if (($count = $category->countActiveJobs() - $maxJobs) > 0): ?>
      <div class="more_jobs">
        and <?php echo link_to($count, 'category', $category) ?>
        more...
      </div>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</div>