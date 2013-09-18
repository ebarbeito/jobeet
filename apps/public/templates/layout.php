<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
	  <title><?php include_slot('title', 'Jobeet - Your best job board') ?></title>
    <link rel="shortcut icon" href="/favicon.ico" />
	<link rel="alternate" type="application/atom+xml" title="Latest Jobs" href="<?php echo url_for('job', array('sf_format' => 'atom'), true) ?>" />
    <?php include_stylesheets() ?>
	<?php use_javascript('jquery-1.10.2.min.js') ?>
	<?php use_javascript('search.js') ?>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <div class="content">
          <h1><a href="<?php echo url_for('homepage') ?>">
            <img src="/images/logo.jpg" alt="Jobeet Job Board" />
          </a></h1>
 
          <div id="sub_header">
            <div class="post">
              <h2>Ask for people</h2>
              <div>
                <a href="<?php echo url_for('job_new') ?>">Post a Job</a>
              </div>
            </div>
 
            <div class="search">
              <h2>Ask for a job</h2>
              <form action="<?php echo url_for('job_search') ?>" method="get">
                <input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
                <input type="submit" value="search" />
                <img id="loader" src="/images/loader.gif" style="vertical-align: middle; display: none" />
                <div class="help">
                  Enter some keywords (city, country, position, ...)
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
 
      <div id="content">
        <?php if ($sf_user->hasFlash('notice')): ?>
          <div class="flash_notice">
            <?php echo $sf_user->getFlash('notice') ?>
          </div>
        <?php endif ?>
 
        <?php if ($sf_user->hasFlash('error')): ?>
          <div class="flash_error">
            <?php echo $sf_user->getFlash('error') ?>
          </div>
        <?php endif ?>
        
        <div class="content">
          <?php echo $sf_content ?>
        </div>
      </div>
 
      <div id="footer">
        <div class="content">
          <span class="symfony">
            <img src="/images/jobeet-mini.png" />
            powered by <a href="/">
            <img src="/images/symfony.gif" alt="symfony framework" />
            </a>
          </span>
          <ul>
            <li><a href=""><?php echo __('About Jobeet') ?></a></li>
            <li class="feed"><?php echo link_to(__('Full feed'), 'job', array('sf_format' => 'atom')) ?></li>
            <li><a href=""><?php echo __('Jobeet API') ?></a></li>
            <li class="last"><?php echo link_to(__('Become an affiliate'), 'affiliate_new') ?></li>
          </ul>
          <?php include_component('language', 'language') ?>
        </div>
      </div>
    </div>
    <?php include_javascripts() ?>
  </body>
</html>