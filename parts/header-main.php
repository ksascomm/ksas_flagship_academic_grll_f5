<header itemscope="itemscope" itemtype="http://schema.org/WPHeader" role="banner">
	<?php
		$home_url = site_url();
		$program_slug = get_the_program_slug($post);
			$programs = get_terms('program', array(
					'orderby'       => 'name',
					'order'         => 'ASC',
					'hide_empty'    => false,
					));

			$count_programs =  count($programs); ?>

			<div id="mobile-nav" class="blue_bg">
				<div class="row">
					<div class="small-12 large-4 columns centered">
						<div class="mobile-logo centered"><a href="<?php echo network_site_url(); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/ksas-logo-horizontal.png" alt="jhu logo"></a></div>
							<h1 class="white" itemprop="headline"><?php echo get_bloginfo( 'title' ); ?></h1>
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
					<h1 itemprop="headline"><a class="white" href="<?php echo site_url(); ?>"><span class="small" itemprop="description"><?php echo get_bloginfo ( 'description' ); ?></span><?php echo get_bloginfo( 'title' ); ?></a></h1>
				</div>			

					</div>
				</div>
				<div class="row hide-for-print" id="navs" role="navigation" aria-labelledby="main_nav">
					<div class="small-3 columns program">
						<label for="program_switch" class="screen-reader-text">Select Program</label>
						<select id="program_switch">
							<option>Select Program &#9662;</option>
							<option value="<?php echo $home_url; ?>">Department Home</option>
							<?php if ( $count_programs > 0 ) { foreach ( $programs as $program ) { ?>
									<option value="<?php echo $home_url . '/' . $program->slug; ?>"><?php echo $program->name; ?></option>
							<?php } } ?>
						</select>
					</div>
					<?php wp_nav_menu( array(
					'theme_location' => 'main_nav',
					'menu_class' => 'nav-bar',
					'container' => 'nav',
					'container_id' => 'main_nav',
					'container_class' => 'small-9 columns',
					'fallback_cb' => 'foundation_page_menu',
					'items_wrap' => '<ul id="%1$s" class="%2$s" role="navigation" aria-label="Main menu">%3$s</ul>',
					'walker' => new foundation_navigation(),
					'depth' => 2  )); ?>
				</div>
			</div>
</header>
