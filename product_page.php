<?php
	use app\models\User;
	use app\models\Shoes;
	use app\DB;
	

	require_once 'app/start.php';



$shoes = new Shoes();
	

?>


			<?php 	include("incl/header.php"); ?>

            <div id="slideshow">
    	        <img id="slideshowImg" src="img/slideshow/01.png" name="slideshow" />
            </div>
			
			<div id="product_content">
				<div id="product_categories">
					<ul>
						<li> <h3> Rubrik1 </h3> </li>
						<li> Underrubrik </li>
						<li> Underrubrik </li>
						<li> Underrubrik </li>
					</ul>
					
					<ul>
						<li> <h3> Rubrik1 </h3> </li>
						<li> Underrubrik </li>
						<li> Underrubrik </li>
						<li> Underrubrik </li>
					</ul>
				</div>
				
				<div id="products">
				
					<table>
						<tr>
							<?php foreach ($shoes->all() as $shoe) {

								echo "<td><img src='img/shoes/" . $shoe->pic1 . "'" .  "alt='shoe1'/></td>";
							}
							?>
							<td>
								<p>
									<img src="img/shoes/img_01.png" alt="shoe1" /> 
								</p>
								
								<p>
									<span class="product_title"> Sko ett </span> <span class="product_price"> 1199:- </span>
								</p>
								
								<p>
									<input type="submit" name="add_to_cart_product_page" value="Lägg i varukorg" /> 
								</p>
							</td>
							
							<td> <img src="img/shoes/img_02.png" alt="shoe1" /> </td>
						</tr>
						
						<tr> 
							<td> <img src="img/shoes/img_01.png" alt="shoe1" /> </td>
							<td> <img src="img/shoes/img_02.png" alt="shoe1" /> </td>
							<td> <img src="img/shoes/img_01.png" alt="shoe1" /> </td>
							<td> <img src="img/shoes/img_02.png" alt="shoe1" /> </td>
						</tr>
						
						<tr> 
							<td> <img src="img/shoes/img_01.png" alt="shoe1" /> </td>
							<td> <img src="img/shoes/img_02.png" alt="shoe1" /> </td>
							<td> <img src="img/shoes/img_01.png" alt="shoe1" /> </td>
							<td> <img src="img/shoes/img_02.png" alt="shoe1" /> </td>
						</tr>
						
					</table>
					
				</div>
			
			</div>  <!-- end wrapper -->
			
		</body>