		<nav class="menu">
		    <ul class="active">
				<?php
				// Om besökaren är inne på den engelska sidan ska meny på engelska visas
				if (getPath() == "/en/index.php") {
				?>
					<style>
						nav li {
							margin-right: 21.3%;
						}
					</style>
					<li<?php if (getPath() == "/en/index.php") { ?> class="current"<?php } ?>>
					<a href='#'><i class="fa fa-home" aria-hidden="true"></i> Home</a>
					</li>
					<li<?php if (getPath() == "/resor.php") { ?> class="current"<?php } ?>>
						<a href='#'><i class="fa fa-plane" aria-hidden="true"></i> Tours</a>
					</li>
					<li<?php if (getPath() == "/kontakt.php") { ?> class="current"<?php } ?>>
						<a href='#'><i class="fa fa-envelope" aria-hidden="true"></i> Contact</a>
					</li>
				<?php
				}
				// Meny på svenska skrivs ut
				else {
				?>
				<li<?php if (getPath() == "/index.php") { ?> class="current"<?php } ?>>
					<a href='index.php'><i class="fa fa-home" aria-hidden="true"></i> Hem</a>
				</li>
				<li<?php if (getPath() == "/resor.php") { ?> class="current"<?php } ?>>
					<a href='resor.php'><i class="fa fa-plane" aria-hidden="true"></i> Resor</a>
				</li>
				<li<?php if (getPath() == "/kontakt.php") { ?> class="current"<?php } ?>>
					<a href='kontakt.php'><i class="fa fa-envelope" aria-hidden="true"></i> Kontakt</a>
				</li>
				<?php
				}
				?>
		    </ul>
		    <a class="toggle-nav" href="#">&#9776;</a>
		</nav>