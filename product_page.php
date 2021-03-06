<?php

use app\models\User;
use app\models\Shoes;
use app\DB;

require_once 'app/start.php';

?>

			<?php include("incl/header.php"); ?>
      
      			<div id="product_content">
      			
				<div id="product_categories">
					<ul>
						<li> Kängor </li>
						<li> Sneakers </li>
						<li> Läder </li>
						<li> Skinn </li>
						<li> Man  </li>
						<li> Kvinna </li>
					</ul>
				</div>

				<div id="products">
				
					<table>
						<tr>
							<?php
								$rowNumber = 1;
								foreach ($shoes->all() as $shoe) {


									echo "<td><a href='single_item_page.php?product-id=" . $shoe->id . "'>
											<p>
												<img src='img/shoes/$shoe->pic1' alt='shoe1'/>
											</p>
											<p>
												<span class='product_title'> $shoe->product_name </span><br /> <span class='product_price'> $shoe->price:- </span>
											</p></a>

											<form method='post'>
												<p>
													<select class='options'>
														<option value='40'> Strl </option>
														<option> 40 </option>
														<option> 41 </option>
														<option> 42 </option>
														<option> 43 </option>
													</select>
													<input class='add-to-cart' type='submit' name='add_to_cart' value='Lägg i varukorg' />
													<input type='hidden' name='shoe_id' value='$shoe->id' />
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
			</div>
			
			<?php include("incl/footer.php"); ?>