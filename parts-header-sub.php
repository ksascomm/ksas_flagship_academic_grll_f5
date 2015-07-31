<?php
	$home_url = site_url();
	$program_slug = get_the_program_slug($post);
	$program_name = get_the_program_name($post);
    $page = get_queried_object_id();
    $ancestors = get_post_ancestors( $page );
    $page_object = get_post($page);
    if (count($ancestors) == 1 ) {$url = $page_object->post_name . '/';} else $url = '';
    $programs = get_terms('program', array(
    		'orderby'       => 'name',
    		'order'         => 'ASC',
    		'hide_empty'    => false,
    		));

    $count_programs =  count($programs); ?>
<header>
	<div class="row hide-for-print">
					<div id="search-bar" class="small-12 large-5 large-offset-7 columns">
						<div class="row">
							<div class="small-6 columns">
							<?php $theme_option = flagship_sub_get_global_options();
									$collection_name = $theme_option['flagship_sub_search_collection'];
							?>

							<form method="GET" action="<?php echo site_url('/search'); ?>">
								<input type="submit" class="icon-search" value="&#xe004;" />
								<input type="text" name="q" placeholder="Search this site" />
								<input type="hidden" name="site" value="<?php echo $collection_name; ?>" />
							</form>
							</div>
								<?php wp_nav_menu( array(
									'theme_location' => 'search_bar',
									'menu_class' => '',
									'fallback_cb' => 'foundation_page_menu',
									'container' => 'div',
									'container_id' => 'search_links',
									'container_class' => 'small-6 columns links inline',
									'depth' => 1,
									'items_wrap' => '%3$s', )); ?>
						</div>
					</div>	<!-- End #search-bar	 -->
		</div>
		<div id="mobile-nav">
				<div class="row">
					<div class="small-12 large-4 columns centered blue_bg">
					<div class="mobile-logo centered"><a href="<?php echo network_site_url(); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/ksas-logo-horizontal.png" alt="jhu logo"></a></div>
					<h2 class="white capitalize" align="center"><?php echo $program_name . ' Program'; ?></h2>
					</div>
				</div>
			</div>
			<div id="desktop-nav">
				<div class="row">
					<div class="small-12 columns" id="logo_nav">
						<div class="medium-3 columns">
							<li class="logo"><a href="<?php echo network_home_url(); ?>" title="Krieger School of Arts & Sciences"><img src="<?php echo get_template_directory_uri() ?>/assets/images/ksas-logo.png" alt="jhu logo"></a></li>
						</div>
						<div class="medium-9 columns">
							<a href="<?php echo site_url('/') . $program_slug; ?>"><h1 class="white"><span class="small"><?php echo get_bloginfo ( 'title' ); ?></span>	<span class="capitalize">				<?php echo $program_name . ' Program'; ?></span></h1></a>
						</div>
					</div>
				</div>
				<div class="row hide-for-print" id="<?php echo $program_slug; ?>">
					<div class="small-3 columns program">
						<select id="program_switch">
							<option>Switch Program &#9662;</option>
					<option value="<?php echo $home_url; ?>">Department Home</option>
					<?php if ( $count_programs > 0 ) { foreach ( $programs as $program ) { ?>
							<option value="<?php echo $home_url . '/' . $program->slug . '/' . $url; ?>"><?php echo $program->name; ?></option>
					<?php } } ?>
						</select>
					</div>
					<?php
				
						$program_menu = wp_nav_menu( array(
							'menu' => $program_slug,
							'menu_class' => 'nav-bar',
							'container' => 'nav',
							'container_id' => 'main_nav',
							'container_class' => 'small-9 columns',
							'fallback_cb' => 'foundation_page_menu',
							'walker' => new foundation_navigation(),
							'depth' => 2,
							'echo' => 0  ));

					echo $program_menu; ?>
				</div>
			</div>

</header>
