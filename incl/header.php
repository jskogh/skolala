<?php

use app\models\User;
use app\models\Shoes;
use app\DB;

$db = DB::get();

$shoe = new Shoes();

if ( ! $_SESSION['user'] ) {
	$_SESSION['user'] = 'visitor';
	$_SESSION['shopping_cart'] = [];
}

if ( isset($_POST['add_to_cart']) ) {
	$_SESSION['shopping_cart'][] = $shoes->get($_POST['shoe_id']);
}

if ( isset($_POST['remove_from_cart']) ) {

	$counter = 0;

	foreach ($_SESSION['shopping_cart'] as $shoeObj) {

		if (array_values($_SESSION['shopping_cart'])[$counter]->id == $_POST['shoe_id'] ) {
			$indexPos = array_keys($_SESSION['shopping_cart'])[$counter];
			unset($_SESSION['shopping_cart'][$indexPos]);
		}
		$counter++;
	}
}


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
