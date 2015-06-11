<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta http-equiv="cache-control" content="public">
  <title><?php create_page_title(); ?></title>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" />
  <!-- CSS Files: All pages -->
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/stylesheets/app.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
  <!-- CSS Files: Conditionals -->

  <!-- Modernizr and Jquery Script -->
  <script async type="text/javascript" src="http://fast.fonts.com/jsapi/c5f514c7-d786-4bfb-9484-ea6c8fbd263f.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/vendor/modernizr-min.js"></script>
  <?php wp_enqueue_script('jquery', true); ?>
  <?php wp_head(); ?>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script async src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <?php include_once("parts-analytics.php"); ?>
</head>
<?php $program_slug = get_the_program_slug($post); global $blog_id; $site_id = 'site-' . $blog_id; ?>
<body <?php body_class($program_slug . ' ' . $site_id); ?>>
	<?php if(!empty($program_slug)) { get_template_part('parts', 'header-sub'); } else { get_template_part('parts', 'header-main'); } ?>
