<?php get_header(); ?>
<main>

<?php
/********SET VARIABLES**************/
	$theme_option = flagship_sub_get_global_options();
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
/********SLIDER QUERY**************/
	$slider_query = new WP_Query(array(
		'post_type' => 'slider',
		'tax_query' => array(array(
				'taxonomy' => 'program',
				'field' => 'slug',
				'id' => array($all_programs),
				'operator' => 'NOT IN'
				)),
		'posts_per_page' => '1'));
/********NEWS QUERY**************/
	$news_query_cond = $theme_option['flagship_sub_news_query_cond'];
	$news_quantity = $theme_option['flagship_sub_news_quantity'];
		if ( false === ( $news_query = get_transient( 'news_mainpage_query' ) ) ) {
			if ($news_query_cond === 1) {
				$news_query = new WP_Query(array(
					'post_type' => 'post',
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field' => 'slug',
							'terms' => array( 'books' ),
							'operator' => 'NOT IN'
						)
					),
					'posts_per_page' => $news_quantity));
			} else {
				$news_query = new WP_Query(array(
					'post_type' => 'post',
					'posts_per_page' => $news_quantity));
			}
		set_transient( 'news_mainpage_query', $news_query, 2592000 );
		}
	/********BEGIN SLIDER**************/
if ( $slider_query->have_posts() ) : ?>
<div class="row hide-for-mobile" aria-label="<?php echo get_bloginfo( 'title' ); ?> Highlights">
	<div id="slider" class="small-12 columns no-gutter">
		<?php while ($slider_query->have_posts()) : $slider_query->the_post(); ?>
		<div class="slide row">
			<summary class="medium-4 medium-offset-8 columns vertical" id="caption">
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
<div class="row sidebar_bg radius10" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
	<div class="small-12 columns">
		<div class="row">
			<div class="large-3 columns radius-top" id="program-tab">
				<h4>Programs of Study</h4>
			</div>
		</div>
	</div>
	<div class="small-12 large-8 columns wrapper radius-left offset-topgutter" id="page">
		<div class="row">
			<div class="small-12 columns program-buttons">
				<?php foreach ($program_slugs as $program_slug) { ?>
				<div class="button <?php echo $program_slug; ?>">
					<a href="<?php echo site_url() . '/' . $program_slug; ?>">
						<?php echo $program_slug; ?>
					</a>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="content">
			<?php the_content(); ?>
		</div>
		<?php endwhile; endif; ?>
		<?php if ( $news_query->have_posts() ) : ?>
		
		<h4><?php echo $theme_option['flagship_sub_feed_name']; ?></h4>
		
		<?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
		<div class="row">
			<article class="small-12 columns news-item" aria-labelledby="post-<?php the_ID(); ?>" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
				<h2 class="uppercase" itemprop="datePublished"><?php the_time( get_option( 'date_format' ) ); ?></h2>
				<h1 itemprop="headline">
				<a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title();?></a>
				</h1>
				<div class="entry-content" itemprop="text">
					<?php if ( has_post_thumbnail()) { ?>
					<?php the_post_thumbnail('thumbnail', array('class'	=> "floatleft", 'itemprop' => 'image')); ?>
					<?php } ?>
					<?php the_excerpt(); ?>
					<hr>
				</div>
			</article>
		</div>
		<?php endwhile; ?>
		<div class="row">
			<h5 class="news-item">
			<a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">
				View More <?php echo $theme_option['flagship_sub_feed_name']; ?>
			</a>
			</h5>
		</div>
		<?php endif; ?>
	</div>
	<!-- End content (left) section -->
	<!-- Begin Sidebar -->
	<aside class="large-4 small-12 columns hide-for-print" id="sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		<?php dynamic_sidebar( 'homepage-sb' ); ?>
	</aside>
	<!-- End Sidebar -->
</div>
</main>
<!-- End main -->
<?php get_footer(); ?>