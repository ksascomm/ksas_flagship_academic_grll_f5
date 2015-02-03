<header>
	<?php
		$home_url = site_url();
		$program_slug = get_the_program_slug($post);
			$programs = get_terms('program', array(
					'orderby'       => 'name',
					'order'         => 'ASC',
					'hide_empty'    => false,
					));

			$count_programs =  count($programs); ?>
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
					<div class="mobile-logo centered"><a href="http://krieger.jhu.edu">Home</a></div>
					<h2 class="white" align="center"><?php echo get_bloginfo( 'title' ); ?></h2>
					</div>
				</div>
			</div>
			<div id="desktop-nav">
				<div class="row">
					<div class="small-12 columns" id="logo_nav">
						<li class="logo"><a href="http://krieger.jhu.edu" title="Krieger School of Arts & Sciences">Krieger School of Arts & Sciences</a></li>

						<a href="<?php echo site_url(); ?>"><h1 class="white"><span class="small"><?php echo get_bloginfo ( 'description' ); ?></span>
							<?php echo get_bloginfo( 'title' ); ?></h1></a>

					</div>
				</div>
				<div class="row hide-for-print" id="navs">
					<div class="small-3 columns program">
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
					'walker' => new foundation_navigation(),
					'depth' => 2  )); ?>
				</div>
			</div>
</header>
