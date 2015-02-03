<?php get_header(); ?>
<div class="row sidebar_bg radius10" id="page">
	<div class="small-12 large-8 columns wrapper radius-left offset-topgutter">
		<section class="content">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h2><?php the_title();?></h2>
				<?php the_content(); ?>
			<?php endwhile; endif; ?>	
		</section>
	</div>	<!-- End main content (left) section -->
<?php get_template_part('parts', 'sidebar'); ?>
</div> <!-- End #landing -->
<?php get_footer(); ?>
