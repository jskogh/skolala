<?php
use app\models\User;
use app\models\Shoes;
use app\DB;

require_once 'app/start.php';

$shoes = new Shoes();

?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title> Skolala || Ekologiska skor </title>
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link href="css/reset.css" rel="stylesheet" type="text/css" />
		<script src="js/slideshow.js" > </script>
	</head>
	
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="logo">
					<!-- <img src="img/logo.png" alt="logotype" width="105px" height="115px"/> -->
					<h1>Skolala</h1>
				</div>
				
				<div id="navbar">
				
					<ul>
						<li href="">Boats</li>
						<li href="">Sneakers</li>
						<li href="">Sale</li>

					</ul>
					
					<div id="shopping_cart">
					
					</div>
					
				</div>
				
			</div>
			
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
							<td> <img src="img/shoes/img_01.png" alt="shoe1" /> </td>
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
			
			</div>