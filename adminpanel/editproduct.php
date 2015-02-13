<?php
require_once('functions.php');
session_start();

if (!isset($_SESSION["status"])) {
    header("location:index.php");
}

if(isset($_POST["submit_logout"])) {
    session_unset();
    session_destroy();
    header("location:index.php");
}

$product_id = $_GET['product_id'];
$db = new PDO("mysql:host=localhost;dbname=retrospecs", "root", "Martin");
$products = $db->prepare("SELECT * FROM products WHERE product_id = $product_id LIMIT 1");
$products->execute();

$colorsstm = $db->prepare("SELECT * FROM colors WHERE product_id = $product_id");
$colorsstm->execute();

$catstm = $db->prepare("SELECT * FROM categories");
$catstm->execute();

$materialsstm = $db->prepare("SELECT * FROM materials WHERE product_id = $product_id");
$materialsstm->execute();

$prodcatstm = $db->prepare("SELECT * FROM product_categories WHERE product_id = $product_id");
$prodcatstm->execute();


?>
<html>
<head>
    <title>Retrospecs - Bambas</title>
    <link rel="stylesheet" type="text/css" href="bambas.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        function addField(tableID) {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            if(rowCount < 50) {
                var row = table.insertRow(rowCount);
                var colCount = table.rows[0].cells.length;
                for(var i=0; i<colCount; i++) {
                    var newcell = row.insertCell(i);
                    newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                }
            }
            else {
                alert("Maximalt antal rader &auml;r 50...");
            }
        }

        function deleteField(tableID) {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {               // limit the user from removing all the fields
                        alert("Du kan inte ta bort alla rader...");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
        }
    </script>
</head>
<body>
<div id="navigation">
    <div id="nav_menu">
        <a href="bambas.php">Hem</a>
        <a href="finance.php">Ekonomi</a>
        <a href="allproducts.php" style="text-decoration: underline">Produkter</a>
        <a href="customers.php">Kunder</a>
        <a style="text-decoration: line-through;" href="newsletters.php">Nyhetsbrev</a>
        <a style="text-decoration: line-through;" href="support.php">Support</a>
        <a style="text-decoration: line-through;" href="stats.php">Statistik</a>
        <a style="text-decoration: line-through;" href="campaigns.php">Kampanjer</a>
    </div>
    <div id="nav_logout">
        <form method="post">
            <input type="submit" value="Logga ut" name="submit_logout" class="logout"/>
        </form>
    </div>
</div>
<div id="wrapper">
    <div id="wrapcenter">
        <?php $result = $products->fetchAll();
        foreach($result as $row)
        {
        ?>
        <div id="leftmenu">
            <ul>
                <li><a href="allproducts.php">Alla produkter</a></li>
                <li><a href="activatedproducts.php">Aktiverade produkter</a></li>
                <li><a href="waitingproducts.php">V&auml;ntande produkter</a></li>
                <li><a href="outofstockproducts.php">Slut i lager</a></li>
                <li><a href="deactivatedproducts.php">Avaktiverade produkter</a></li>
                <li><a href="addproduct.php">L&auml;gg till ny produkt</a></li>
                <li><a href="excel/upload.php">L&auml;gg till ny produkt via Excel</a></li>
                <li style="text-decoration: line-through;"><a href="searchproducts.php">S&ouml;k produkt</a></li>
                <li style="text-decoration: line-through;"><a href="searchbrands.php">S&ouml;k m&auml;rke</a></li>
            </ul>
        </div>
        <div id="listcontent">
            <h1 class="newproduct">Redigera produkt</h1>
            <form method="post">
                <table style="margin-top: 10px;">
                    <tr>
                        <td><span>Produktnummer:</span></td>
                        <td><span>Produktnamn:</span></td>
                        <td><span>Bredd:</span></td>
                        <td><span>H&ouml;jd:</span></td>
                        <td><span>K&ouml;n:</span></td>
                        <td><span>M&auml;rke:</span></td>
                        <td><span>Pris (i kr):</span></td>
                        <td>Saldo:</td>
                    </tr>
                    <tr>
                        <td><input type="text" placeholder="Produktnummer" name="productnumber" class="addproduct" value="<?php echo $row['productnumber']; ?>" /></td>
                        <td><input type="text" placeholder="Produktnamn" name="productname" class="addproduct" value="<?php echo $row['productname']; ?>"/></td>
                        <td><input type="text" placeholder="Bredd" name="width" class="addproduct" value="<?php echo $row['width']; ?>" /></td>
                        <td><input type="text" placeholder="H&ouml;jd" name="height" class="addproduct" value="<?php echo $row['height']; ?>"/></td>
                        <td>
                            <select name="gender">
                                <option value="<?php echo $row['gender']; ?>"><?php echo $row['gender']; ?></option>
                                <option value="Unisex">Unisex</option>
                                <option value="Barn">Barn</option>
                            </select>
                        </td>
                        <td><input type="text" placeholder="M&auml;rke" name="brand" class="addproduct" value="<?php echo $row['brand']; ?>" /></td>
                        <td><input type="text" placeholder="Pris" name="price" size="8" class="addproduct" value="<?php echo $row['price']; ?>"/></td>
                        <td>
                            <input type="text" placeholder="Saldo" name="saldo" class="addproduct" value="<?php echo $row['saldo']; ?>" size="5"/>
                        </td>
                    </tr>
                </table>
                <div id="whatever" style="width: 1280px;margin:0 auto; text-align: left;display: block;">
                    <div id="what_color" style="display: inline-block;vertical-align: top;padding-top: 17px;">
                        <span style="font-size: 18px;">F&auml;rg:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: 18px;font-weight: 700;cursor: pointer;" onclick="addField('colortable');">+</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: 18px;font-weight: 700;cursor: pointer;" onclick="deleteField('colortable');">-</span><br />
                        <table id="colortable" style="display: inline-block; width: 180px;padding-top: 5px;"">
                            <?php $results = $colorsstm->fetchAll();
                            foreach($results as $colorrow) {
                            ?>
                        <tr>
                            <td><input type="checkbox" name="chk[]"></td>
                            <td>
                                    <select name="color[]" style="width:130px;">
                                        <option value="<?php echo $colorrow['colorname']; ?>"><?php echo $colorrow['colorname']; ?></option>
                                        <option value="Beige">Beige</option>
                                        <option value="Bl&aring;">Bl&aring;</option>
                                        <option value="Brun">Brun</option>
                                        <option value="Gul">Gul</option>
                                        <option value="Guld">Guld</option>
                                        <option value="Gr&aring;">Gr&aring;</option>
                                        <option value="Lila">Lila</option>
                                        <option value="Orange">Orange</option>
                                        <option value="Rosa">Rosa</option>
                                        <option value="R&ouml;d">R&ouml;d</option>
                                        <option value="Silver">Silver</option>
                                        <option value="Svart">Svart</option>
                                        <option value="Turkos">Turkos</option>
                                        <option value="Vit">Vit</option>
                                    </select>
                            </td>
                        </tr>
                                <?php
                                }
                                ?>

                        </table>
                    </div>
                    <div id="what_mater" style="display: inline-block;vertical-align: top;padding-top: 17px;">
                        <span style="font-size: 18px;">Material:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: 18px;font-weight: 700;cursor: pointer;"
                              onclick="addField('materialtable');">+</span>&nbsp;&nbsp;&nbsp;&nbsp;
                        <span style="font-size: 18px;font-weight: 700;cursor: pointer;"
                              onclick="deleteField('materialtable');">-</span><br/>
                        <table id="materialtable" style="display: inline-block; width: 170px;padding-top: 5px;">
                            <?php $materialresults = $materialsstm->fetchAll();
                                foreach($materialresults as $materialsrow) {
                            ?>
                                <tr>
                                    <td><input type="checkbox" name="chk[]"></td>
                                    <td>
                                        <select name="material[]" style="width:130px;">
                                            <option value="<?php echo $materialsrow['materialname']; ?>"><?php echo $materialsrow['materialname']; ?></option>
                                            <option value="Plast">Plast</option>
                                            <option value="Metall">Metall</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                        </table>
                    </div>

                    <div id="what_imgs" style="display: inline-block;">
                        <table id="images" style="display: inline-block;width:240px;vertical-align: bottom;">
                            <tr>
                                <td>Skick:</td>
                                <td>Status:</td>
                                <td>Frontbild:</td>
                                <td>Sidobild #1:</td>
                                <td>Sidobild #2:</td>
                                <td>Sidobild #3:</td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="condition" style="width:140px;">
                                        <option value="<?php echo $row['condition']; ?>"><?php echo $row['condition']; ?></option>
                                        <option value="Begagnad">Begagnad</option>
                                        <option value="Ny">Ny</option>
                                        <option value="Reparerad">Reparerad</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="status" style="width:160px;">
                                        <option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>
                                        <option value="Online">Online</option>
                                        <option value="V&auml;ntar">V&auml;ntar</option>
                                        <option value="Slut i lager">Slut i lager</option>
                                        <option value="Totalt Avaktiverad">Totalt Avaktiverad</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" size="16" placeholder="Frontbild" name="frontimg" class="addproduct"
                                           value="<?php echo $row['frontimg']; ?>"/>
                                </td>
                                <td>
                                    <input type="text" size="16" placeholder="Sidobild #1" name="sideimg1" class="addproduct"
                                           value="<?php echo $row['sideimg1']; ?>"/>
                                </td>
                                <td>
                                    <input type="text" size="16" placeholder="Sidobild #2" name="sideimg2" class="addproduct"
                                           value="<?php echo $row['sideimg2']; ?>"/>
                                </td>
                                <td>
                                    <input type="text" size="16" placeholder="Sidobild #3" name="sideimg3" class="addproduct"
                                           value="<?php echo $row['sideimg3']; ?>"/>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="whatever2" style="width: 1280px;margin:0 auto; text-align: left;display: block;">
                    <div style="display: inline-block;width:500px;vertical-align: top;">
                        <p style="font-size: 18px;">Kategorier:</p>
                        <?php $prodcatresult = $prodcatstm->fetchAll();
                        foreach ($prodcatresult as $prodcatrow) {
                            ?>
                            <div style="display: inline-block;min-width:150px;">
                                <input type="checkbox" name="categories[]" value="<?php echo $prodcatrow['categoryname']; ?>" checked="true"> <?php echo $prodcatrow['categoryname']; ?>
                            </div>
                        <?php
                        }
                        ?>
                        <br /><br/>
                        <?php $catresult = $catstm->fetchAll();
                            foreach ($catresult as $catrow) {
                        ?>
                            <div style="display: inline-block;min-width:150px;">
                                <input type="checkbox" name="categories[]" value="<?php echo $catrow['categoryname']; ?>"> <?php echo $catrow['categoryname']; ?>
                            </div>
                        <?php
                            }
                        ?>
                        <div id="what_condition" style="display: inline-block;vertical-align: top;padding-top: 17px;">
                            <table id="condtable" style="display: inline-block; width: 200px;padding-top: 5px;">
                                <tr>

                                </tr>
                                <tr>

                                </tr>
                            </table>

                        </div>
                    </div>
                    <div style="width:400px;display: inline-block;vertical-align: top;padding: 0;">
                        <p style="font-size: 18px;">Beskrivning:</p>
                        <textarea name="description" placeholder="Beskrivning..." cols="60" rows="7"
                                  style="font-size: 18px;"><?php echo $row['description']; ?></textarea>
                    </div>
                    <div style="text-align: center;">
                        <input type="submit" value="Spara produkt till databasen" name="editproduct" class="submitnewproduct"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    }
    ?>
</div>
</body>
</html>