<?php
/*
Template Name: Program Homepage
*/
?>
<?php get_header(); ?>


<main>

<?php /********SET VARIABLES**************/
	$theme_option = flagship_sub_get_global_options();
	$program_slug = get_the_program_slug($post);
/********SLIDER QUERY*************/
	$slider_query = new WP_Query(array(
		'post_type' => 'slider',
		'program' => $program_slug,
		'posts_per_page' => '1'));

/********NEWS QUERY**************/
	$news_quantity = $theme_option['flagship_sub_news_quantity']; $news_query_cond = $theme_option['flagship_sub_news_query_cond'];
	if ( false === ( $news_query = get_transient( 'news_' . $program_slug . '_query' ) ) ) {
	    if ($news_query_cond === 1) {
		    $news_query = new WP_Query(array(
		    	'post_type' => 'post',
		    	'tax_query' => array(
		    		'relation' => 'AND',
		    		array(
		    		    'taxonomy' => 'category',
		    		    'field' => 'slug',
		    		    'terms' => array('books'),
		    		    'operator' => 'NOT IN',
		    		),
		    		array(
		    		    'taxonomy' => 'program',
		    		    'field' => 'slug',
		    		    'terms' => $program_slug,
		    		)),
		    	'posts_per_page' => $news_quantity));
		} else {
		    $news_query = new WP_Query(array(
		    	'post_type' => 'post',
		    	'tax_query' => array(
		    		'relation' => 'OR',
		    		array(
		    		    'taxonomy' => 'category',
		    		    'field' => 'slug',
		    		    'terms' => $program_slug
		    		),
		    		array(
		    		    'taxonomy' => 'program',
		    		    'field' => 'slug',
		    		    'terms' => $program_slug,
		    		)),
		    	'posts_per_page' => $news_quantity));
		}
	    set_transient( 'news_' . $program_slug . '_query', $news_query, 2592000 );
	}
/********BEGIN SLIDER**************/
if ( $slider_query->have_posts() ) : ?>
	<div class="row hide-for-mobile" aria-label="<?php the_title(); ?> Program Highlights">
		<div id="slider" class="small-12 columns no-gutter">
			<?php while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
				<div class="slide row">
					<summary class="small-4 small-offset-8 columns vertical" id="caption">
						<div class="middle">
							<h1 class="white"><?php the_title(); ?></h1>
							<p class="white italic"><?php echo get_the_content(); ?></p>
						</div>
					</summary>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>

<div class="row sidebar_bg" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
	<div class="medium-12 large-8 columns wrapper toplayer" id="page">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
		<?php endwhile; endif; ?>

		<?php if ( $news_query->have_posts() ) : ?>
		<h4 class="capitalize"><?php echo $program_slug . ' ' . $theme_option['flagship_sub_feed_name']; ?></h4>
		<?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
		<div class="row">
			<article class="small-12 columns news-item" aria-labelledby="post-<?php the_ID(); ?>" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
				<h2 class="uppercase black" itemprop="datePublished"><?php the_time( get_option( 'date_format' ) ); ?></h2>
				<h1 itemprop="headline">
					<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title();?></a>
				</h1>
				<div class="entry-content" itemprop="text">		
					<?php if ( has_post_thumbnail()) { ?>
						<?php the_post_thumbnail('thumbnail', array('class'	=> "floatleft", 'itemprop' => 'image')); ?>
					<?php } ?>
					<?php the_excerpt(); ?>
				</div>	
				<hr>
			</article>
		</div>

		<?php endwhile; ?>
		<div class="row">
			<h5>
				<a href="<?php echo site_url('/program/') . $program_slug; ?>">
					View More <?php echo $theme_option['flagship_sub_feed_name']; ?>
				</a>
			</h5>
		</div>
		<?php endif; ?>



	</div>	<!-- End main content (left) section -->
<?php locate_template('parts/sidebar.php', true, false); ?>
</div> <!-- End #landing -->
</main>
<?php get_footer(); ?>
