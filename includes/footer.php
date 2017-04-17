			</section><!-- Huvudsektion slut -->
		</main>
		<!-- Sidfot -->
		<footer>
			<div id="footerSection">
				<a href="
				<?php if (getPath() == "/en/index.php") { 
                    __DIR__; ?>/en/<?php } ?>index.php"><img src="<?php __DIR__; ?>/images/logo-white.png" alt="Adventour">
                </a>
				<p>Vägen 1<br>
				111 11 Staden</p>
				<p><a href="mailto:info@adventour.com">info@adventour.com</a><br>
				Ring: 01-234 56 78 (vardagar kl. 9-17)</p>
			</div>
		</footer><!-- Sidfot slut -->
        <!-- JS-filer -->
        <script src="<?php __DIR__; ?>/script/no-js.js"></script>
        <script src="<?php __DIR__; ?>/script/script.js"></script>
        <!-- Lightbox -->
        <script src="<?php __DIR__; ?>/script/lightbox/js/lightbox.js"></script>
        <!-- Google maps -->
        <?php
        if (getPath() != "/en/index.php" && getPath() != "/index.php" && getPath() != "/resor.php") {
        ?>
        	<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
        <?php
        }
        ?>
	</body>
</html>