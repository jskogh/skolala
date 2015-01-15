<?php
	use app\models\User;
	use app\models\Shoes;
	use app\DB;
	
	require_once 'app/start.php';
	


$shoes = new Shoes();

?>


			<?php include("incl/header.php"); ?>

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
							<?php
								$rowNumber = 1;

								foreach ($shoes->all() as $shoe) {


									echo "<td>
											<p>
												<img src='img/shoes/$shoe->pic1' alt='shoe1'/>
											</p>
											<p>
												<span class='product_title'> $shoe->product_name </span> <span class='product_price'> $shoe->price:- </span>
											</p>


												<form method='post'>
												<p>
													<input type='hidden' name='shoe_id' value='$shoe->id' />
													<input type='submit' name='add_to_cart' value='Lägg i varukorg' />
													</p>
												</form>

										</td>";
										if ( $rowNumber % 3 === 0) { // create new <tr> every third shoe
											echo "</tr><tr>";
										}

								$rowNumber++;
							}
							?>
						</tr>
						
					</table>
					
				</div>
			
			</div>  <!-- end wrapper -->
			
		</body>