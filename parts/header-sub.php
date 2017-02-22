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
<header itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">
	<a href="#page" class="skipLink">Skip to main content</a>
	<div id="mobile-nav">
		<div class="row">
			<div class="small-12 large-4 columns centered blue_bg">
				<div class="mobile-logo centered"><a href="<?php echo network_site_url(); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/ksas-logo-horizontal.png" alt="jhu logo"></a></div>
				<h1 class="white capitalize"><?php echo $program_name . ' Program'; ?></h1>
			</div>
		</div>
	</div>
	<div id="desktop-nav">
		<?php get_template_part( '/parts/offcanvas' ); ?>
		<div class="row">
			<div class="small-12 columns" id="logo_nav">
				<div class="medium-3 columns">
					<li class="logo"><a href="<?php echo network_home_url(); ?>" title="Krieger School of Arts & Sciences"><img src="<?php echo get_template_directory_uri() ?>/assets/images/ksas-logo.png" alt="jhu logo"></a></li>
				</div>
				<div class="medium-9 columns">
					<h1 itemprop="headline">
						<a class="white" href="<?php echo site_url('/') . $program_slug; ?>">
							<span class="small" itemprop="headline"><?php echo get_bloginfo ( 'title' ); ?></span>
							<span class="capitalize" itemprop="headline"><?php echo $program_name . ' Program'; ?></span>
						</a>
					</h1>
				</div>
			</div>
		</div>
		<div class="row hide-for-print" id="<?php echo $program_slug; ?>" aria-labelledby="main_nav">
			<div class="small-3 columns program">
				<label for="program_switch" class="screen-reader-text">Select Program</label>
				<select id="program_switch">
					<option>Switch Program &#9662;</option>
					<option value="<?php echo $home_url; ?>">Department Home</option>
					<?php if ( $count_programs > 0 ) { foreach ( $programs as $program ) { ?>
							<option value="<?php echo $home_url . '/' . $program->slug . '/' . $url; ?>"><?php echo $program->name; ?></option>
					<?php } } ?>
				</select>
			</div>
			<nav class="small-9 columns hide-for-print" aria-label="Main Menu" id="main_nav" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">	
				<?php $program_menu = wp_nav_menu( array(
						'menu' => $program_slug,
						'menu_class' => 'nav-bar',
						'fallback_cb' => 'foundation_page_menu',
						'walker' => new foundation_navigation(),
						'items_wrap' => '<ul id="%1$s" class="%2$s" aria-label="Main menu">%3$s</ul>',
						'depth' => 2,
						'echo' => 0  ));
				echo $program_menu; ?>
			</nav>
		</div>
	</div>

</header>
