<?php get_header();
	$program_slug = get_the_program_slug($post);
?>
<div class="row wrapper radius10" id="page" role="main">
	<div class="small-12 columns">
		<?php locate_template('parts-nav-breadcrumbs.php', true, false); ?>
		<section class="content">
			<h1 class="page-title capitalize"><?php echo $program_slug; ?> Faculty Books</h1>
			<?php
			 if ( have_posts() ) : while (have_posts()) : the_post(); ?>
					<?php if ( has_post_thumbnail()) { ?>
						<?php the_post_thumbnail('medium', array('class'	=> "floatleft")); ?>
					<?php } ?>
					<?php $faculty_post_id = get_post_meta($post->ID, 'ecpt_pub_author', true);
						  $faculty_post_id2 = get_post_meta($post->ID, 'ecpt_pub_author2', true); ?>
				<?php if ( get_post_meta($post->ID, 'ecpt_pub_link', true) ) :?>
					<a href="http://<?php echo get_post_meta($post->ID, 'ecpt_pub_link', true); ?>">
				<?php endif; ?>
						<h5><?php the_title();?></h5>
				<?php if ( get_post_meta($post->ID, 'ecpt_pub_link', true) ) :?></a><?php endif; ?>
				<h6>
					<?php if ( get_post_meta($post->ID, 'ecpt_pub_date', true) ) : echo get_post_meta($post->ID, 'ecpt_pub_date', true);  endif; ?>
					<?php if ( get_post_meta($post->ID, 'ecpt_publisher', true) ) :?>, <?php echo get_post_meta($post->ID, 'ecpt_publisher', true);  endif; ?>
				</h6>
				<p><b><a href="<?php echo get_permalink($faculty_post_id); ?>"><?php echo get_the_title($faculty_post_id); ?>
				<?php if ( get_post_meta($post->ID, 'ecpt_pub_role', true)) :?>, <?php echo get_post_meta($post->ID, 'ecpt_pub_role', true); endif; ?>
				</a></b>
				<?php if (get_post_meta($post->ID, 'ecpt_author_cond', true) == 'on') { ?><br>
					<b><a href="<?php echo get_permalink($faculty_post_id2); ?>"><?php echo get_the_title($faculty_post_id2); ?>,&nbsp;<?php echo get_post_meta($post->ID, 'ecpt_pub_role2', true); ?>
					</a></b>
				<?php } ?>
				</p>
				<?php the_content(); ?>
				<hr>
			<?php endwhile; endif; ?>
		<div class="row">
			<?php flagship_pagination(); ?>
		</div>
		</section>
	</div>	<!-- End main content (left) section -->
</div> <!-- End #landing -->
<?php get_footer(); ?>
