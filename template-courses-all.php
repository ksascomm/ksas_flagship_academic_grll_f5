<?php
/*
Template Name: ISIS Courses (All GRLL Depts)
*/
?>
<?php get_header(); ?>

<?php // Load Zebra Curl
	require_once TEMPLATEPATH . "/assets/functions/Zebra_cURL.php";
	//Set query sting variables
		$theme_option = flagship_sub_get_global_options();
		$department_unclean = $theme_option['flagship_sub_isis_name'];
		$department = str_replace(' ', '%20', $department_unclean);
		$department = str_replace('&', '%26', $department);
		//$fall = 'fall%202016';
		$spring = 'spring%202017';
		$intersession = 'intersession%202017';
		$approval = 'approval%20required';
		$closed = 'closed';
		$open = 'open';
		$waitlist = 'waitlist%20only';
		$key = 'DZkN4QOJGaDKVg6Du1911u45d4TJNp6I';

	//Create first Zebra Curl class
		$course_curl = new Zebra_cURL();
		$course_curl->option(array(
		    CURLOPT_TIMEOUT         =>  60,
		    CURLOPT_CONNECTTIMEOUT  =>  60,
		));
		$cache_dir = TEMPLATEPATH . "/assets/functions/cache/";
		$course_curl->cache($cache_dir, 2592000);

	//Create API Url calls
		$courses_spring_url = 'https://isis.jhu.edu/api/classes?key=' . $key . '&School=Krieger%20School%20of%20Arts%20and%20Sciences&Term=' . $spring . '&Department=AS%20' . $department . '&status=' . $open . '&status=' . $approval . '&status=' . $closed . '&status=' . $waitlist;
		$courses_fall_url = 'https://isis.jhu.edu/api/classes?key=' . $key . '&School=Krieger%20School%20of%20Arts%20and%20Sciences&Term=' . $fall . '&Department=AS%20' . $department . '&status=' . $open . '&status=' . $approval . '&status=' . $closed . '&status=' . $waitlist;
		$courses_intersession_url = 'https://isis.jhu.edu/api/classes?key=' . $key . '&School=Krieger%20School%20of%20Arts%20and%20Sciences&Term=' . $intersession . '&Department=AS%20' . $department. '&status=' . $open . '&status=' . $approval . '&status=' . $closed . '&status=' . $waitlist;
		$courses_call = array($courses_spring_url, $courses_fall_url, $courses_intersession_url);

	//Course display callback function
		function display_courses($result) {
		    $result->body = json_decode(html_entity_decode($result->body));
			$title = $result->body[0]->{'Title'};
			$term = $result->body[0]->{'Term'};
			$subdept = $result->body[0]->{'SubDepartment'};
			$meetings = $result->body[0]->{'Meetings'};
			$status = $result->body[0]->{'Status'};
			$course_number = $result->body[0]->{'OfferingName'};
			$clean_course_number = preg_replace('/[^A-Za-z0-9\-]/', '', $course_number);
			$credits = $result->body[0]->{'Credits'};
			$instructor = $result->body[0]->{'InstructorsFullName'};
			$description = $result->body[0]->{'SectionDetails'}[0]->{'Description'};
      // show everything
      echo '<dd class="accordion-navigation ' . $term . '"><a href="#course' . $clean_course_number . '"><h5><span class="course-number">' . $course_number . '</span> - ' . $title . '<i class="fa fa-caret-down"></i><i class="fa fa-caret-up"></i></h5></a>';
      echo '<div id="course' . $clean_course_number . '" class="content"><p>' . $description . '</p>';
      echo '<p><strong>Credits: </strong>' . $credits . '<br><strong>Instructor: </strong>' . $instructor . '<br><strong>Term: </strong>' . $term . '<br><strong>Meetings: </strong>' . $meetings . '<br><strong>Status: </strong>' . $status .'</p>';
      echo '</div></dd>';

		}
	//ISIS Call callback function
		function parse_courses($result) {
			$key = 'DZkN4QOJGaDKVg6Du1911u45d4TJNp6I';
			$result->body = json_decode(html_entity_decode($result->body));
			$course_data = array();
				foreach($result->body as $course) {
					$section = $course->{'SectionName'};
					$level = $course->{'Level'};
					$parent = the_parent_title();

					if($section === '01' && (
								strpos($level, $parent) !== false
							||  ($level === "") !== false
							||  strpos($level, 'Independent Academic Work') !== false
						)
						)    {
						$number = $course->{'OfferingName'};
						$clean_number = preg_replace('/[^A-Za-z0-9\-]/', '', $number);
						$dirty_term = $course->{'Term'};
						$clean_term = str_replace(' ', '%20', $dirty_term);
						$details_url = 'https://isis.jhu.edu/api/classes/' . $clean_number . '01/' . $clean_term . '?key=' . $key;
						$course_data[] = $details_url;
					}
				}
			$curl = new Zebra_cURL();
			$curl->option(array(
			    CURLOPT_TIMEOUT         =>  60,
			    CURLOPT_CONNECTTIMEOUT  =>  60,
			));
			$curl->cache($cache_dir, 2592000);
			$curl->get($course_data, 'display_courses');

		}
?>

<div class="row sidebar_bg radius10" id="page" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
	<div class="small-12 large-8 columns wrapper radius-left offset-topgutter">
		<?php locate_template('parts/nav-breadcrumbs.php', true, false); ?>
		<div class="content">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h1 class="page-title"><?php the_title();?></h1>
				<?php the_content(); ?>

			<?php endwhile; endif;  ?>
					<div id="fields_search" class="panel radius10">			
						<div class="row filter option-set" data-filter-group="term">
								<div class="button radio"><a href="#" data-filter="*" class="selected" onclick="ga('send', 'event', 'ISIS', 'Courses', 'All');">View All</a></div>
								<div class="button radio"><a href="#" data-filter=".Intersession" onclick="ga('send', 'event', 'ISIS', 'Courses', 'Intersession');">Intersession 2017 Courses</a></div>
								<div class="button radio"><a href="#" data-filter=".Spring" onclick="ga('send', 'event', 'ISIS', 'Courses', 'Fall');">Spring 2017 Courses</a></div>
								<h5 class="inline"><a href="#" class="acc_expandall" onclick="ga('send', 'event', 'ISIS', 'Courses', 'Expand All');">[Expand All]</a></h5>
						</div>
					<div class="row">
						<div class="directory-search">
							<span class="fa fa-search fa-2x" aria-hidden="true"></span>
						</div>
						<input type="text" name="search" id="id_search"  placeholder="Search by course number, title, and keyword" />
							<label for="id_search" class="screen-reader-text">
								Search by course number, title, and keyword
							</label>
					</div>
							<div class="row">
								<h4>Filter By Department</h4>
								<div class="row filter option-set" data-filter-group="program">
									<div class="button radio"><a href="#" data-filter=".French">French</a></div>
									<div class="button radio"><a href="#" data-filter=".German">German</a></div>
									<div class="button radio"><a href="#" data-filter=".Semitic">Hebrew</a></div>
									<div class="button radio"><a href="#" data-filter=".Italian">Italian</a></div>
									<div class="button radio"><a href="#" data-filter=".Portuguese">Portuguese</a></div>
									<div class="button radio"><a href="#" data-filter=".Spanish">Spanish</a></div>
								</div>
							</div>
		</div>

    <dl class="expander accordion courses" data-accordion>
    <?php $course_curl->get($courses_call, 'parse_courses'); ?>
    </dl>

		</div>
	</div>	<!-- End main content (left) section -->
<?php locate_template('parts/sidebar.php', true, false); ?>
</div> <!-- End #landing -->
<?php get_footer(); ?>
