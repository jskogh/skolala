<?php
	use app\models\User;
	use app\models\Shoes;
	use app\DB;
	

	require_once 'app/start.php';



$shoes = new Shoes();
	

?>

				<?php include("incl/header.php"); ?>

				<div id="single_item_page">
				
					<div id="product">
				
						<div id="product_image">
							<img src="img/shoes/img_01.png" alt="product" />
							
							<div id="more_images">
								<img src="img/shoes/img_01_02.png" alt ="shoe1" /> 
								<img src="img/shoes/img_01_03.png" alt ="shoe2" /> 
								<img src="img/shoes/img_01.png" alt ="shoe3" /> 
							</div>
							
							
						</div>
						
						<div id="product_info">
							<p class="product_name"> SkoEtt </p>
							
							<p class="brand"> Märke: Kavat </p>
							
							<p class="materials"> Material: Läder, Skinn </p>
							
							<p class="about_product"> Massa om skon lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sed blandit sem. Nam lacinia quis sem tempus cursus. Duis sed ipsum nec sem laoreet vulputate. Maecenas porta, urna ac dapibus porttitor, massa quam placerat nisi, et mollis ligula mi ac purus. Phasellus risus est, dictum ac est sed, rutrum imperdiet ipsum. Curabitur ac lorem in sem egestas laoreet. Vestibulum tincidunt pharetra lacinia </p>
							
							<p class="environment_info"> Påverkan på miljön: 1478 blabla utsläppt </p>
							
							<p class="price"> 1299 SEK </p>
							
							<p class="options">
								<form>
									<select name="shoe_size">
										<option>40 </option>
										<option>41 </option>
										<option>42 </option>
										<option>43 </option>
									</select>
									<br />

									<input type="submit" value="Lägg till i varukorg" name="add_to_cart" />
								</form>
							</p>
							
							<div id="social_media_logos_single_item">
								<img src="img/logos1/twitter1.png" alt ="twitter" /> 
								<img src="img/logos1/facebook1.png" alt ="twitter" /> 
								<img src="img/logos1/instagram1.png" alt ="twitter" /> 
								<img src="img/logos1/pinterest1.png" alt ="twitter" /> 
							</div>
							
							<p> </p>
						</div>
						
					</div>
				
				<div id="releted_products">
				
				</div>
				
				<div id="environmental_stuff">
				
				</div>
				
			</div>	
			
		<?php include("incl/footer.php") ?>
