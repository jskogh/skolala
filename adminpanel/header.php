<html>
<head>
    <title>EcoShoes - Admin</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <script src=js/jquery-2.1.3.min.js></script>
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/functions.js"></script>
</head>
<body>
<div id="navigation">
    <div id="nav_menu">
        <a href="administration.php"<?php if ($current=="Hem")
            echo " style='text-decoration: underline'"; ?>>Hem</a>
        <a href="finance.php"<?php if ($current=="Ekonomi")
            echo " style='text-decoration: underline'"; ?>>Ekonomi</a>
        <a href="products.php"<?php if ($current=="Produkter")
            echo " style='text-decoration: underline'"; ?>>Produkter</a>
        <a href="customers.php"<?php if ($current=="Kunder")
            echo " style='text-decoration: underline'"; ?>>Kunder</a>
        <a href="stats.php"<?php if ($current=="Statistik")
            echo " style='text-decoration: underline'"; ?>>Statistik</a>
        <a href="newsletter.php"<?php if ($current=="Nyhetsbrev")
            echo " style='text-decoration: underline'"; ?>>Nyhetsbrev</a>
    </div>
    <div id="nav_logout">
        <form method="post">
            <input type="submit" value="Logga ut" name="submit_logout" class="logout"/>
        </form>
    </div>
</div>