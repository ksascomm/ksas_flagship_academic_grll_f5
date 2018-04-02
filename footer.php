<footer itemscope="itemscope" itemtype="http://schema.org/WPFooter">
  	<div class="row hide-for-print">
		<nav class="small-10 medium-3 columns" id="quicklinks" aria-label="Quicklinks Menu" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
  		<?php //Check Theme Options for Quicklinks setting
	  		$theme_option = flagship_sub_get_global_options();
	  		if ( $theme_option['flagship_sub_quicklinks']  == '1' ) {
	  				global $switched;
	  				$quicklinks_id = $theme_option['flagship_sub_quicklinks_id'];
	  				switch_to_blog($quicklinks_id); }

				//Quicklinks Menu
		  		wp_nav_menu( array( 
					'theme_location' => 'quick_links', 
					'menu_class' => 'nav-bar', 
					'fallback_cb' => 'foundation_page_menu', 
					'container' => 'false', 
					'walker' => new foundation_navigation() ) ); 

			//Return to current site
			if ( $theme_option['flagship_sub_quicklinks']  == '1' ) { restore_current_blog(); }
		 ?>
		</nav>
		<!-- Footer Links -->
		<div class="medium-4 columns" role="navigation" aria-labelledby="menu-footer-links">
			<ul id="menu-footer-links" class="inline-list hide-for-small-only" role="menu">
				<li role="menuitem"><a href="<?php echo get_site_url(); ?>/sitemap/">Sitemap</a></li>
				<li role="menuitem"><a href="https://jobs.jhu.edu/">Employment</a></li>
				<li role="menuitem"><a href="https://www.jhu.edu/alert/">Emergency Alerts & Info</a></li>
			</ul>
		</div>
		<!-- Social Media -->
		<div class="small-12 medium-5 columns" id="social-media" role="navigation" aria-labelledby="social-media">
			<ul class="inline-list">
				<li><a href="http://facebook.com/JHUArtsSciences"><span class="fa fa-facebook-official fa-2x"></span><span class="screen-reader-text">Facebook</span></a></li>
				<li><a href="https://www.instagram.com/JHUArtsSciences/"><span class="fa fa-instagram fa-2x"></span><span class="screen-reader-text">Instagram</span></a></li>
				<li><a href="https://twitter.com/JHUArtsSciences"><span class="fa fa-twitter fa-2x"></span><span class="screen-reader-text">Twitter</span></a></li>
				<li><a href="https://www.youtube.com/user/jhuksas"><span class="fa fa-youtube-square fa-2x"></span><span class="screen-reader-text">YouTube</span></a></li>
			</ul>
		</div>
	</div>
	<!-- Copyright and Address -->
	<div class="row" id="copyright" role="contentinfo">
  		<p>&copy; <?php print date('Y'); ?> Johns Hopkins University, <?php echo $theme_option['flagship_sub_copyright'];?></p>
  	</div>
  	<div class="row">
	  	<div class="small-12 small-centered medium-4 columns hide-on-print">
  				<a href="http://www.jhu.edu" title="Johns Hopkins University"><img src="<?php echo get_template_directory_uri() ?>/assets/images/university.jpg" / alt="Johns Hopkins University logo"></a>
  		</div>
  	</div>
</footer>

<?php wp_footer(); 
  locate_template('/parts/script-initiators.php', true, false); ?>
  
  	<script>
  	var $q = jQuery.noConflict();
  	 $q(function(){
      // bind change event to select
      $q('#program_switch').bind('change', function () {
          var url = $q(this).val(); // get selected value
          if (url) { // require a URL
             window.open(url,'_top');
          }
          return false;
      });
    });
    </script>
	</body>
</html>
