<?php
use app\models\User;
use app\models\Shoes;
use app\DB;

require_once 'app/start.php';

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
			
			
			<div id="single_item_page">
				
				<div id="product_image">
					<img src="img/shoes/img_01.png" alt="product" />
					
					<div id="more_images">
					
					</div>
					
					
				</div>
				
				<div id="product_info">
					<h2>Namn på sko</h2>
				</div>
				
				<div id="releted_products">
				
				</div>
				
				<div id="environmental_stuff">
				
				</div>
				
			</div>	

		</div>
