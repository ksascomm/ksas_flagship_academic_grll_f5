	<aside class="large-4 small-12 columns hide-for-print" id="sidebar" itemscope="itemscope" itemtype="http://schema.org/WPSideBar"> 

	<!-- Begin Sidebar -->
		<!-- Start Featured Image -->
<?php
		if ( is_page() && has_post_thumbnail()  ) {
			wp_reset_query();
				the_post_thumbnail('full', array('class'	=> "offset-gutter radius-topright featured hide-for-small"));
			 }
		 ?>
			<!-- END Featured Image --> 
<!-- Start Navigation for Sibling Pages -->	
			<?php
				$program_name = get_the_program_name($post);
				if(empty($program_name)) {$program_name = 'Main Menu';}
				if( is_page() ) {
					global $post;
				        $ancestors = get_post_ancestors( $post->ID ); // Get the array of ancestors
				        //If there are more than one display a menu of siblings
							if (count($ancestors) > 1 ) {
								$parent_page = get_post($post->post_parent);
								$parent_name = $parent_page->post_title;
							?>
							<div class="offset-gutter radius-topright" id="sidebar_header">
								<h5 class="white">Also in <span class="grey bold"><?php echo $parent_name ?></span></h5>
							</div>
							<?php
								wp_nav_menu( array(
									'menu' => $program_name,
									'menu_class' => 'nav',
									'container_class' => 'offset-gutter',
									'submenu' => $parent_name,
								));
							}
						//If there is only one ancestor display a menu of children
							elseif (count($ancestors) == 1 ) {
								$page_name = $post->post_title;
								$test_menu = wp_nav_menu( array(
									'menu' => $program_name,
									'menu_class' => 'nav',
									'fallback_cb' => 'false',
									'container_class' => 'offset-gutter',
									'items_wrap' =>  '<div class="radius-topright" id="sidebar_header"><h5 class="white">Also in <span class="grey bold">' . $page_name . '</span></h5></div><ul class="%2$s" role="navigation" aria-label="Sidebar Menu">%3$s</ul>',
									'submenu' => $page_name,
									
								));
								$tester = 'menu-item';
								$result = strpos($test_menu, $tester);
									if ($result === false) {
									} else {
									echo $test_menu;
									}
						}
						//Get the top-level page slug for sidebar/widget content conditionals
							$ancestor_id = ($ancestors) ? $ancestors[count($ancestors)-1]: $post->ID;
					        $the_ancestor = get_page( $ancestor_id );
					        $ancestor_slug = $the_ancestor->post_name;

			}
			?>
		<!-- End Navigation for Sibling Pages -->

		<!-- Page Specific Sidebar -->
		<?php if ( have_posts() && get_post_meta($post->ID, 'ecpt_page_sidebar', true) ) : while ( have_posts() ) : the_post();
				echo apply_filters('the_content', get_post_meta($post->ID, 'ecpt_page_sidebar', true));
			endwhile; endif; ?>
		<!-- END Page Specific Sidebar -->

		<!-- Start Widget Content -->
			<?php $program_slug = get_the_program_slug($post);
			if (is_page_template('template-program-frontpage.php')) {
				dynamic_sidebar($program_slug . '-sb');
			} 			?>


		<!-- End Widget Content -->
	</aside> <!-- End Sidebar -->
