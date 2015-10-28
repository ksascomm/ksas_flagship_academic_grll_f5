<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php create_page_title(); ?></title>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" />
  <!-- CSS Files: All pages -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/stylesheets/app.css">
    <!-- IE Fix for HTML5 Tags -->
    <!--[if lt IE 10]>
        <script async src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script async src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
        <script async src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/assets/stylesheets/app.ie.css">
    <![endif]-->
  <!-- CSS Files: Conditionals -->
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
  <!-- Modernizr and Jquery Script -->
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/modernizr-min.js"></script>
  <?php wp_enqueue_script('jquery', true); ?>
  <?php wp_head(); ?>


  <?php include_once("parts-analytics.php"); ?>
</head>
<?php $program_slug = get_the_program_slug($post); global $blog_id; $site_id = 'site-' . $blog_id; ?>
<body <?php body_class($program_slug . ' ' . $site_id); ?> onLoad="viewport()">
	<?php if(!empty($program_slug)) { get_template_part('parts', 'header-sub'); } else { get_template_part('parts', 'header-main'); } ?>
