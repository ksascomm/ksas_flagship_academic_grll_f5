<?php
/*
Template Name: Sitemap Listing (Menus)
*/
?>	

<?php get_header(); ?>
<div class="row sidebar_bg radius10" id="page">
	<div class="small-12 large-8 columns wrapper radius-left offset-topgutter">	
		<?php locate_template('parts/nav-breadcrumbs.php', true, false); ?>	
		<main class="content" role="main">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h1 class="page-title"><?php the_title();?></h1>
			    <?php wp_nav_menu( array( 
				'theme_location' => 'main_nav', 
				'fallback_cb' => 'foundation_page_menu', 
				) ); ?>
				<?php the_content(); ?>
			<?php endwhile; endif; ?>	
		</main>
	</div>	<!-- End main content (left) section -->
<?php locate_template('parts/sidebar.php', true, false); ?>
</div> <!-- End #landing -->
<?php get_footer(); ?>