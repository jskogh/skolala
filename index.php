<?php

use app\models\User;
	use app\models\Shoes;
	use app\DB;
	
require_once 'app/start.php'; // all pages should include this.

// using the included header.php to catch stuff and initialize objects.

?>

			<?php include("incl/header.php"); ?>

			<div id="content">
				
				<div id="about_link">
					<img src="img/frontpage/alt_header.jpg" alt="slogan" />
				</div>
				<!-- 
				<div id="shoes_link">
					<img src="img/frontpage/shoes.jpg" alt="shoes" />
				</div>
				-->
				
				<div id="four_columns">
					<div id="plant_tree">
						<div id="plant_tree_text">
							<p>Kompensera för ditt köpt, <br /> plantera ett träd </p>
						</div>
					</div>
				</div>
								
				<div id="environment_link">
				
				</div>
				
					
				<div id="social_media_container">
		
					<div id="social_media_logos">
						<p> 
							<img src="img/logos1/twitter1.png" alt ="twitter" /> 
							<img src="img/logos1/facebook1.png" alt ="twitter" /> 
							<img src="img/logos1/instagram1.png" alt ="twitter" /> 
							<img src="img/logos1/pinterest1.png" alt ="twitter" /> 
							
						</p>
					</div>
					
					<div id="newsletter">
						
						<form>
							<p>Håll dig uppdaterad med våra nyhetsmail 
							<input type="text" name="news_letter_email" placeholder="Din mailadress" />
							<input type="submit" value="Sign up!" name="newsletter" />
							</p>
						</form>
					</div>
				</div>
			</div>  <!-- end wrapper -->

	</body>