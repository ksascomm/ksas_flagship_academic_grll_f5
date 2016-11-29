<?php
/*
Template Name: People Directory
*/
?>	

<?php get_header(); 
	$theme_option = flagship_sub_get_global_options();
	$roles = get_terms('role', array(
						'orderby' 		=> 'slug',
						'order'			=> 'ASC',
						'hide_empty'    => true,
						)); 
	$filters = get_terms('filter', array(
						'orderby'       => 'name', 
						'order'         => 'ASC',
						'hide_empty'    => true, 
						));
	$role_slugs = array();
	$filter_slugs = array();
	foreach($roles as $role) {
		$role_slugs[] = $role->slug;
	}
	$role_classes = implode(' ', $role_slugs);
	foreach($filters as $filter) {
		$filter_slugs[] = $filter->slug;
	}
	$filter_classes = implode(' ', $filter_slugs);
	?>
<div class="row wrapper radius10" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
	<div class="content row">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<h1 class="page-title"><?php the_title();?></h1>
		<?php endwhile; endif; ?>
		<?php $theme_option = flagship_sub_get_global_options();
				if ( $theme_option['flagship_sub_directory_search']  == '1' ) { get_template_part('/parts/directory-search'); } ?>
	</div>



	<div class="row" id="fields_container">
		<ul class="large-12 columns" id="directory">
		<?php foreach($roles as $role) {
			$role_slug = $role->slug;
			$role_name = $role->name;
			if ($role_slug !== 'graduate' && $role_slug !== 'job-market-candidate' && $role_slug !== 'graduate-student') {
			if ( false === ( $people_query = get_transient( 'people_query_' . $role_slug ) )) {				
				$people_query = new WP_Query(array(
						'post_type' => 'people',
						'role' => $role_slug,
						'meta_key' => 'ecpt_people_alpha',
						'orderby' => 'meta_value',
						'order' => 'ASC',
						'posts_per_page' => '-1'));
				set_transient( 'people_query_' . $role_slug, $people_query, 2592000 );
			} 				        	
				if ($people_query->have_posts() ) : ?>	
				<li class="person sub-head quicksearch-match <?php echo $role->slug; ?>"><h2 class="black capitalize"><?php echo $role_name; ?></h2></li>
				<?php while ($people_query->have_posts()) : $people_query->the_post(); ?>
					<?php if ( get_post_meta($post->ID, 'ecpt_bio', true) ) { get_template_part('/parts/hasbio-loop'); } else { get_template_part('/parts/nobio-loop'); } ?>
				<?php endwhile; endif; } } wp_reset_postdata(); ?>
				<!-- Page Content -->
			<?php if ( $theme_option['flagship_sub_directory_search']  == '1' ) { ?>
			<div class="row" id="noresults">
				<div class="small-4 small-centered columns">
				</div>
			</div>
			<?php } ?>
		</ul>
	</div>

	<div class="row">
		<div class="large-12 columns">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();  the_content(); endwhile; endif; ?>
		</div>
	</div>	

</div> <!-- End content wrapper -->
<?php get_footer(); ?>