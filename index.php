<?php

use app\models\User;
	use app\models\Shoes;
	use app\DB;
	
require_once 'app/start.php'; // all pages should include this.

// using the included header.php to catch stuff and initialize objects.

?>

			<?php include("incl/header.php"); ?>

			<div id="content">
				
				<div id="top_content">
					Shoes Eco <br/>
					<a href="product_page.php">Börja här </a>
				</div>
				
				<div id="environment_link">
					<p> Miljötips #1 : </p>
					<p class="margin_bottom"> Lämna dina gamla och hela saker till second hand eller sälj dem på internet istället för att slänga dem. </p> 
					<p> <a href="blogg.php">läs mer på vår miljöblogg </a></p>
				</div>
				
				<div id="philosophy">
					<p> vår filosofi </p>
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
			
							
				
				<!-- <div id="two_col">
				
					<div id="philosophy"
						<p> vår filosofi </p>
					</div>
					
					<div id="blogg">
						<p> miljöbloggen </p>
					</div>
				
				</div> 
				
				<div id="four_columns">
					<div id="plant_tree">
						<div id="plant_tree_text">
							<p>Kompensera för ditt köpt, <br /> plantera ett träd </p>
						</div>
					</div>
				</div>
					-->
	
				
			<?php include("incl/footer.php"); ?>
				
				