<?php
	use app\models\User;
	use app\models\Shoes;
	use app\DB;
	
require_once 'app/start.php';
$shoes = new Shoes();

if ( isset($_GET['product-id']) ) {
	$product_id = $_GET['product-id'];
}

?>

				<?php include("incl/header.php"); ?>

				<div id="single_item_page">
				
					<div id="product">
				
						<div id="product_image">
							<img src="img/shoes/<?php echo $shoes->get($product_id)->pic1 ?>" alt="product" />
							
							<div id="more_images">
								<img src="img/shoes/<?php echo $shoes->get($product_id)->pic1 ?>" alt ="shoe1" />
								<img src="img/shoes/<?php echo $shoes->get($product_id)->pic1 ?>" alt ="shoe2" />
								<img src="img/shoes/<?php echo $shoes->get($product_id)->pic1 ?>" alt ="shoe3" />
							</div>
							
							
						</div>
						
						<div id="product_info">
							<p class="product_name"> <?php echo $shoes->get($product_id)->product_name ?> </p>
							
							<p class="brand"> Märke: <?php echo $shoes->get($product_id)->brand_name ?> </p>
							
							<p class="categories"> Kategori: <?php echo $shoes->get($product_id)->categories ?> </p>
							
							<p class="about_product"> <?php echo $shoes->get($product_id)->description ?> </p>
							
							<p class="environment_info"> Påverkan på miljön: 1200 microgram utsläppt </p>
							
							<p class="price"> <?php echo $shoes->get($product_id)->price ?> SEK </p>
							
							<p class="options">
								<form>
									<select name="shoe_size">
										<option value='40'> Strl </option>
										<option> 40 </option>
										<option> 41 </option>
										<option> 42 </option>
										<option> 43 </option>
									</select>


									<input class='add-to-cart' type='submit' name='add_to_cart' value='Lägg i varukorg' />
									<input type='hidden' name='shoe_id' value='<?php echo $shoes->get($product_id)->id ?>' />
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
