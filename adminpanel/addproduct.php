<?php
    require_once('functions.php');
$current="Produkter";
require_once('header.php');
    session_start();

    if (!isset($_SESSION["status"])) {
        header("location:index.php");
    }

    if(isset($_POST["submit_logout"])) {
        session_unset();
        session_destroy();
        header("location:index.php");
    }

//Echoes the highest value from the productnumber-column, ie the last inserted product.
// With an added "+1" in the DOM it gives the next productnumber IF THAT IS HOW NISSEMAN WANTS IT.

$latestprodnumber = $db->prepare("SELECT MAX(id) as maxGroup FROM shoes");
$latestprodnumber->execute();
$lpn = $latestprodnumber->fetch(PDO::FETCH_ASSOC);

$catstm = $db->prepare("SELECT * FROM categories");
$catstm->execute();


?>
<div id="wrapper">
    <div id="wrapcenter">
        <div id="leftmenu">
            <ul>
                <li><a href="products.php">Alla produkter</a></li>
                <li><a href="products.php?status=ok">Aktiverade produkter</a></li>
                <li><a href="products.php?stock=0">Slut i lager</a></li>
                <li><a href="products.php?status=deactivated">Avaktiverade produkter</a></li>
                <li><a href="addproduct.php">L&auml;gg till ny produkt</a></li>
            </ul>
        </div>
    <div id="listcontent">
        <h1 class="newproduct">L&auml;gg till ny produkt</h1>
        <form method="post">
            <div id="whatever" style="width: 1280px;margin:0 auto; text-align: left;display: block;">
                <div id="what_imgs" style="display: inline-block;">
            <table style="margin-top: 10px;">
                <tr>
                    <td><span>Produktnummer:</span></td>
                    <td><span>Produktnamn:</span></td>
                    <td><span>Storlek:</span></td>
                    <td><span>M&auml;rke:</span></td>
                    <td><span>Pris (i kr):</span></td>
                    <td>Saldo:</td>
                </tr>
                <tr>
                    <td><input type="text" placeholder="Produktnummer" name="productnumber" class="addproduct" value="<?php echo $lpn['maxGroup']+1; ?>" /></td>
                    <td><input type="text" placeholder="Produktnamn" name="product_name" class="addproduct" /></td>
                    <td><input type="text" placeholder="size" name="size" class="addproduct" /></td>
                    <td><input type="text" placeholder="M&auml;rke" name="brand" class="addproduct" /></td>
                    <td><input type="text" placeholder="Pris" name="price" class="addproduct"/></td>
                    <td><input type="text" placeholder="Stock" name="stock" class="addproduct" value=""/></td>
                </tr>
            </table>
                    <table id="images" style="display: inline-block;width:240px;vertical-align: bottom;">
                        <tr>
                            <td>M&auml;rke</td>
                            <td>Status</td>
                            <td>Bild #1:</td>
                            <td>Bild #2:</td>
                            <td>Bild #3:</td>
                            <td>Bild #4:</td>
                        </tr>
                        <tr>
                            <td>
                                <select name="brand" style="width:170px;">
                                    <option value="1">Nike</option>
                                    <option value="2">Adidas</option>
                                </select>
                            </td>
                            <td>
                                <select name="status" style="width:180px;">
                                    <option value="ok">Redo</option>
                                    <option value="waiting">V&auml;ntar</option>
                                    <option value="out of stock">Slut i lager</option>
                                    <option value="deactivated">Totalt Avaktiverad</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" placeholder="Bild #1" name="pic1" class="addproduct" value="" />
                            </td>
                            <td>
                                <input type="text" placeholder="Bild #2" name="pic2" class="addproduct" value=""/>
                            </td>
                            <td>
                                <input type="text" placeholder="Bild #3" name="pic3" class="addproduct" value="" />
                            </td>
                            <td>
                                <input type="text" placeholder="Bild #4" name="pic4" class="addproduct" value="" />
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div id="whatever2" style="width: 1280px;margin:0 auto; text-align: left;display: block;">
                <div style="display: inline-block;width:400px;vertical-align: top;padding-right: 20px;">
                    <p style="font-size: 18px;">Kategorier:</p>
                    <?php $catresult = $catstm->fetchAll();
                        foreach($catresult as $catrow)
                        {
                    ?>
                    <div style="display: inline-block;min-width:150px;">
                        <input type="checkbox" name="categories[]" value="<?php echo $catrow['category']; ?>"> <?php echo $catrow['category']; ?>
                    </div>
                    <?php } ?>
                </div>
                <div style="width:400px;display: inline-block;vertical-align: top;padding: 0;">
                    <p style="font-size: 18px;">Beskrivning:</p>
                    <textarea name="description" placeholder="Beskrivning..." cols="55" rows="7" style="font-size: 18px;"></textarea>
                </div>
            </div>
            <div style="text-align: center;width: 1300px;">
                <input type="submit" value="Spara produkt till databasen" name="addproduct" class="submitnewproduct"/>
            </div>
        </form>
    </div>
    </div>
    </div>
</body>
</html>