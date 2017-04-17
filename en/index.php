<?php
/*
* Sara Petersson - Webbanvändbarhet, DT068G
* 
*/

// Undersidans titel
$page_title = "Adventure of your life";
// Hämtar in headern
include("../includes/header.php");
?>
<!-- Welcome blurb -->
<section id="teaser">
	<h2><span class="em">Adventure</span><br> of your life</h2>
	<p>We offer journeys of a <span class="em">lifetime</span>. Taste your way through Italy or join us on an adventurous climbing trip to Peru.</p>
</section><!-- /Welcome blurb -->
<main>
	<section id="mainContent">
		<!-- Bildsektion -->
		<section class="imageSection">
			<a href="#">
				<figure class="fade">
					<img src="<?php __DIR__; ?>/images/travels/florence_540x260.jpg" alt="">
					<figcaption>Photojourney to Florence</figcaption>
				</figure>
			</a>
			<a href="#">
				<figure class="fade">
					<img src="<?php __DIR__; ?>/images/travels/lemur_360x260.jpg" alt="">
					<figcaption>Animal encounters<br> in Madagascar</figcaption>
				</figure>
			</a>
			<a href="#">
				<figure class="fade">
					<img src="<?php __DIR__; ?>/images/travels/rock_360x260.jpg" alt="">
					<figcaption>Trekking in<br>the Highlands</figcaption>
				</figure>
			</a>
			<a href="#">
				<figure class="fade">
					<img src="<?php __DIR__; ?>/images/travels/bird_540x260.jpg" alt="">
					<figcaption>Bird watching in Peru</figcaption>
				</figure>
			</a>
		</section><!-- /.imageSection -->
		<!-- Kommande resor -->
		<section id="upcoming">
			<h3>Upcoming travels</h3>
			<a href="#" class="date">2016-06-09</a>
			<p>Safari in Serengeti</p>
			<a href="#" class="date">2016-06-11</a>
			<p>Adventures of Borneo</p>
			<a href="#" class="date">2016-06-15</a>
			<p>Hiking the Inca trail</p>
			<a href="#" class="date">2016-06-18</a>
			<p>Expedition Greenland</p>
			<a href="#" class="date">2016-06-23</a>
			<p>Bird watching in Peru</p>
			<a href="#" class="date">2016-06-30</a>
			<p>Trekking in Scotland</p>
		</section><!-- /#upcoming -->
		<!-- Instagram -->
		<aside id="instagram">
			<h3>#adventour</h3>
			<!-- SnapWidget -->
			<iframe src="https://snapwidget.com/embed/171719" class="snapwidget-widget"></iframe>
		</aside><!-- /#instagram -->
<?php
include("../includes/footer.php");