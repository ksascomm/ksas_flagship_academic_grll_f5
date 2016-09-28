<?php get_header(); $program_slug = get_the_program_slug($post);?>
<div class="row sidebar_bg radius10" id="page">
	<div class="small-8 columns wrapper radius-left offset-topgutter">
		<?php locate_template('parts/nav-breadcrumbs.php', true, false);
		$theme_option = flagship_sub_get_global_options(); ?>
		<div class="content">
		<h1 class="page-title capitalize"><?php echo $program_name . ' ' . $theme_option['flagship_sub_feed_name']; ?> Archive</h1>
		<?php
		while (have_posts()) : the_post(); ?>
			<a href="<?php the_permalink(); ?>">
				<h6><?php the_date(); ?></h6>
				<h5><?php the_title();?></h5>
					<?php if ( has_post_thumbnail()) { ?> 
						<?php the_post_thumbnail('thumbnail', array('class'	=> "floatleft")); ?>
					<?php } ?>
				<?php the_excerpt(); ?>
			</a>
				<hr>
			<?php endwhile; ?>
		<div class="row">
			<?php flagship_pagination(); ?>
		</div>
		</div>
	</div>	<!-- End main content (left) section -->
<?php locate_template('parts/sidebar.php', true, false); ?>
</div> <!-- End #landing -->
<?php get_footer(); ?>
