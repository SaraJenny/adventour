<?php
/*
* Sara Petersson - Webbanvändbarhet, DT068G
* 
*/

// Undersidans titel
$page_title = "Ditt livs upplevelse";
// Hämtar in headern
include("includes/header.php");
?>
<!-- Welcome blurb -->
<section id="teaser">
	<h2>Ditt livs<br><span class="em">upplevelse</span></h2>
	<p>Vi anordnar <span class="em">drömresor</span> av alla slag, från matresor i Italien till hisnande klättringsresor i Anderna.</p>
</section>
<main>
	<section id="mainContent">
		<!-- Bildsektion -->
		<section class="imageSection">
			<a href="#">
				<figure class="fade">
					<img src="<?php __DIR__; ?>/images/travels/florence_540x260.jpg" alt="">
					<figcaption>Fotoresa till Florens</figcaption>
				</figure>
			</a>
			<a href="#">
				<figure class="fade">
					<img src="<?php __DIR__; ?>/images/travels/lemur_360x260.jpg" alt="">
					<figcaption>Djurmöten på<br>Madagaskar</figcaption>
				</figure>
			</a>
			<a href="resa.php?id=4">
				<figure class="fade">
					<img src="<?php __DIR__; ?>/images/travels/rock_360x260.jpg" alt="">
					<figcaption>Vandring<br>i skotska<br>högländerna</figcaption>
				</figure>
			</a>
			<a href="#">
				<figure class="fade">
					<img src="<?php __DIR__; ?>/images/travels/bird_540x260.jpg" alt="">
					<figcaption>Fågelskådning i Peru</figcaption>
				</figure>
			</a>
		</section><!-- /.imageSection -->
		<!-- Kommande resor-->
		<section id="upcoming">
			<h3>Kommande resor</h3>
			<a href="#" class="date">2016-06-09</a>
			<p>Safari i Serengeti</p>
			<a href="#" class="date">2016-06-11</a>
			<p>Borneo-äventyret</p>
			<a href="resa.php?id=5" class="date">2016-06-15</a>
			<p>Vandring på Inkaleden</p>
			<a href="resa.php?id=3" class="date">2016-06-18</a>
			<p>Expedition Grönland</p>
			<a href="#" class="date">2016-06-23</a>
			<p>Fågelskådning i Peru</p>
			<a href="resa.php?id=4" class="date">2016-06-30</a>
			<p>Vandringsresa till Skottland</p>
		</section><!-- /#upcoming -->
		<!-- Instagram -->
		<aside id="instagram">
			<h3>#adventour</h3>
			<!-- SnapWidget -->
			<iframe src="https://snapwidget.com/embed/182134" class="snapwidget-widget" title="Twitter"></iframe>
		</aside>
<?php
include("includes/footer.php");