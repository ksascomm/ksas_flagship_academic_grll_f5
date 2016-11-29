<?php get_header();
	$program_slug = get_the_program_slug($post);
?>
<div class="row wrapper radius10" id="page" role="main">
	<div class="small-12 columns">
		<?php locate_template('parts/nav-breadcrumbs.php', true, false); ?>
		<div class="content news">
			<h1 class="page-title capitalize"><?php echo $program_slug; ?> Faculty Books</h1>
			<?php
			 if ( have_posts() ) : while (have_posts()) : the_post(); ?>
			 <article id="post-<?php the_ID(); ?>" role="article" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">	
					<?php if ( has_post_thumbnail()) { ?>
						<?php the_post_thumbnail('medium', array('class'	=> "floatleft", 'itemprop' => 'image')); ?>
					<?php } ?>
					<?php $faculty_post_id = get_post_meta($post->ID, 'ecpt_pub_author', true);
						  $faculty_post_id2 = get_post_meta($post->ID, 'ecpt_pub_author2', true); ?>
				<ul class="no-bullet">
					<li><h2><?php the_title(); ?></h2></li>
					<li>
					<?php if ( get_post_meta($post->ID, 'ecpt_pub_date', true) ) :?> 
						<?php echo get_post_meta($post->ID, 'ecpt_pub_date', true);  ?>,
					<?php endif; ?>
					<?php if ( get_post_meta($post->ID, 'ecpt_publisher', true) ) :?>
						<?php echo get_post_meta($post->ID, 'ecpt_publisher', true); ?> 
					<?php endif; ?>	
					</li>
					<li>
						<a href="<?php echo get_permalink($faculty_post_id); ?>">
							<?php echo get_the_title($faculty_post_id); ?>, 
								<?php if ( get_post_meta($post->ID, 'ecpt_pub_role', true)) :?> 
									<?php echo get_post_meta($post->ID, 'ecpt_pub_role', true);?>
								<?php endif; ?>
						</a>
					</li>
					<li><?php if (get_post_meta($post->ID, 'ecpt_author_cond', true) == 'on') { ?><br>
						<a href="<?php echo get_permalink($faculty_post_id2); ?>">
						<?php echo get_the_title($faculty_post_id2); ?>,&nbsp;
							<?php echo get_post_meta($post->ID, 'ecpt_pub_role2', true); ?>
						</a>
						<?php } ?>
					</li>
					<li><?php if ( get_post_meta($post->ID, 'ecpt_pub_link', true) ) :?> 
						<a href="http://<?php echo get_post_meta($post->ID, 'ecpt_pub_link', true); ?>">
							Purchase Online <span class="fa fa-external-link-square"></span>
						</a>
						<?php endif; ?>
					</li>
				</ul>
				<?php the_content(); ?>
			</article>	
				<hr>
			<?php endwhile; endif; ?>
		<div class="row">
			<?php flagship_pagination(); ?>
		</div>
		</div>
	</div>	<!-- End main content (left) section -->
</div> <!-- End #landing -->
<?php get_footer(); ?>
