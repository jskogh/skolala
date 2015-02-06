<?php
use app\models\User;
use app\models\Shoes;
use app\DB;

require_once 'app/start.php';

?>

    <?php include("incl/header.php"); ?>
    
    <div id="about">
    	<div id="about_link">
			<img src="img/frontpage/forest_3_1.jpg" alt="about_image" />
		</div>
    	
    	<div id="about_text">
    		<p class="about_title"> Om oss</p>
    		<p>
    			Vi, som återförsäljare av ekologiska skor, profilerar oss själva som en ekologisk helhetslösning. Vi säljer enbart skor från märken som har bevisat för oss att de är pålitliga och att de delar våra värderingar gällande naturen och vår framtid. 
    		</p>
    		
    		<p class="margin_top">
    			De skor vi säljer är antingen gjorda på ekologiska produkter eller på återvunnet material.
    		</p>
    		<br>
    		<p>Läs mer om vår filosofi <a class="green" href="philosophy.php">här</a>
    		</p>
    	</div>
    	
    	<div id="contact_field"> 
    		<p class="about_title"> Kontakt</p>
    		<p><span class="bold"> Mail:</span> <br /> info@skolala.se</p>
    		<br/>
    		<p><span class="bold"> Telefon: </span><br /> 073-3333333</p>
    		<br/>    		
    		<p><span class="bold"> Adress: </span><br />Skolalavägen 23 <br />
	    		70222 Stockholm
    		</p>

    	</div>
    
    </div>
    
    <?php include("incl/footer.php"); ?>