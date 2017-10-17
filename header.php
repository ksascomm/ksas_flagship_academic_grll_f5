<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="date" content="<?php the_modified_date(); ?>" />
    <title>
        <?php create_page_title_grll(); ?>
    </title>

    <meta property="og:site_name" content="Krieger School of Arts and Sciences" />
    <meta property="og:title" content="<?php echo get_bloginfo( 'title' ); ?> | Krieger School of Arts and Sciences | Johns Hopkins University" />
    <meta property="og:url" content="<?php echo site_url(); ?>" />
    <meta property="og:description" content="The Zanvyl Krieger School of Arts and Sciences is the core institution of Johns Hopkins University’s Homewood campus" />

    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/assets/images/gilman.jpg" />
    <meta property="og:image:width" content="1600" />
    <meta property="og:image:height" content="400" />
    
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" />
    <!-- CSS Files: All pages -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/stylesheets/app.min.css">
    <!-- Make IE a modern browser -->
    <!--[if IE]>
    <script src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/css3-mediaqueries/0.1/css3-mediaqueries.min.js"></script>
  <![endif]-->
    <!--[if lt IE 11]>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/assets/css/app.ie.css">
    <div data-alert class="alert-box alert">
    <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.'); ?> 
    </div>    
  <![endif]-->
    <!-- CSS Files: Conditionals -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.min.css">

    <?php wp_head(); ?>

    <?php include_once("analytics.php"); ?>
</head>
<?php $program_slug = get_the_program_slug($post); global $blog_id; $site_id = 'site-' . $blog_id; ?>

<body <?php body_class($program_slug . ' ' . $site_id); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
    <?php if(!empty($program_slug)) { 
        get_template_part( '/parts/header-sub'); 
      } else { 
        get_template_part( '/parts/header-main'); 
    } ?>