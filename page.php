<?php get_header(); ?>
<div class="row sidebar_bg radius10" id="page" role="main">
	<div class="small-12 large-8 columns wrapper radius-left offset-topgutter">
		<div class="content">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h1 class="page-title"><?php the_title();?></h1>
				<?php the_content(); ?>
			<?php endwhile; endif; ?>	
		</div>
	</div>	<!-- End main content (left) section -->
<?php get_template_part('/parts/sidebar'); ?>
</div> <!-- End #landing -->
<?php get_footer(); ?>
