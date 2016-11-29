<?php get_header(); $program_slug = get_the_program_slug($post);?>
<div class="row sidebar_bg radius10" id="page">
	<div class="small-8 columns wrapper radius-left offset-topgutter">
		<?php locate_template('parts/nav-breadcrumbs.php', true, false);
		$theme_option = flagship_sub_get_global_options(); ?>
			<main class="content post-archive" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
				<h1 class="page-title capitalize"><?php echo $program_name . ' ' . $theme_option['flagship_sub_feed_name']; ?> Archive</h1>
				<?php while (have_posts()) : the_post(); ?>
				<article role="article" aria-labelledby="post-<?php the_ID(); ?>" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">	
					<h3 itemprop="datePublished"><?php the_date(); ?></h3>
					<h2 itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
						<?php if ( has_post_thumbnail()) { ?> 
							<?php the_post_thumbnail('thumbnail', array('class'	=> "floatleft", 'itemprop' => 'image')); ?>
						<?php } ?>
					<?php the_excerpt(); ?>
				</article>
						<hr>
					<?php endwhile; ?>
				<div class="row">
					<?php flagship_pagination(); ?>
				</div>
			</main>
	</div>	<!-- End main content (left) section -->
<?php locate_template('parts/sidebar.php', true, false); ?>
</div> <!-- End #landing -->
<?php get_footer(); ?>
