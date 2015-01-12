<?php
use app\models\User;
use app\models\Shoes;
use app\DB;

require_once 'app/start.php';

$test = new User();
$db = DB::get();

$shoe = new Shoes();

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title> Skolala || Ekologiska skor </title>
		<link href="css/main.css" rel="stylesheet" type="text/css" />
		<link href="css/reset.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
		<div id="wrapper">
			<div id="header">

				<div id="logo">	<!-- <img src="img/logo.png" alt="logotype" width="105px" height="115px"/> -->
				<h1>Skolala</h1>
				</div>	

			
				<div id="navbar">
					
					<ul>
						<li href="">Boots</li>
						<li href="">Sneakers</li>
						<li href="">Sale</li>
						
					</ul>
						
					<div id="shopping_cart">
						
					</div>
					
				</div>
			
			</div>
			
			
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
				
					<table>
						<tr>
							<td> <img src="img/frontpage/top_sales.jpg" alt="top_sales" /> </td>
							<td> <img src="img/frontpage/plant_tree.jpg" alt="plant_tree" /> </td>
							<td> <img src="img/frontpage/top_sales.jpg" alt="top_sales" /> </td>
							<td> <img src="img/frontpage/plant_tree.jpg" alt="plant_tree" /> </td>
						</tr>
					</table>
					
				</div>
				<!-- <div id="two_categories_top">
					
					<a href="#">
						<div id="category_one">
							<h2>Urban </h2>
							</div>
					</a>
					<a href="#">
						<div id="category_two">
							<h2>Adventure </h2>
						</div>
					</a>
				</div>
				
				
				<div id="top_offers">
					<h2 class="offers"> BUY A PAIR OF SHOES WITHOUT MAKING ANY HARM </h2>
				</div>
			
				
				<div id="environment_link">
				
				</div>
				
				-->
					
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
			</div>
			
			<div id="footer"
			
		</div>
	</body>