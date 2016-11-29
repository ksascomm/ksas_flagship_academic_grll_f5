<?php
/*
Template Name: Faculty Books
*/
?>
<?php get_header();
	$program_slug = get_the_program_slug($post);
	$all_programs = get_terms('program', array('orderby' => 'slug', 'fields' => 'ids'));
	$all_programs = implode(",", $all_programs);
	$program_names = get_terms('program', array('orderby' => 'names', 'fields' => 'all', 'hide_empty' => false));
	if ( $program_names && ! is_wp_error( $program_names ) ) {
		$program_slugs = array();
			foreach ( $program_names as $program_name ) {
				$program_slugs[] = $program_name->slug;
			}
	}

?>
<div class="row wrapper radius10" id="page" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
	<div class="small-12 columns">
		<?php locate_template('parts/nav-breadcrumbs.php', true, false); ?>
		<div class="content news">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<div class="row">
				<div class="small-12 columns">
					<?php foreach ($program_slugs as $program_slug) { ?>
						<div class="button <?php echo $program_slug; ?>"><a href="<?php echo site_url() . '/category/books/?program=' . $program_slug; ?>" class="capitalize"><?php echo $program_slug; ?></a></div>
					<?php } ?>
				</div>
			</div>

			<?php
			$paged = (get_query_var('paged')) ? (int) get_query_var('paged') : 1;
			if ( false === ( $faculty_books_query = get_transient( 'faculty_books_query_' . $paged ) ) ) {
				// It wasn't there, so regenerate the data and save the transient
				$faculty_books_query = new WP_Query(array(
					'post_type' => 'post',
					'category_name' => 'books',
					'posts_per_page' => 10,
					'paged' => $paged
					));
					set_transient( 'faculty_books_query_' . $paged, $faculty_books_query, 2592000 );
			}
			 if ( $faculty_books_query->have_posts() ) : while ($faculty_books_query->have_posts()) : $faculty_books_query->the_post(); ?>
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
			<?php flagship_pagination($faculty_books_query->max_num_pages); ?>
		</div>
		</div>
	</div>	<!-- End main content (left) section -->
</div> <!-- End #landing -->
<?php get_footer(); ?>
