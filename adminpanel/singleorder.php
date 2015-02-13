<?php
require_once('functions.php');
$current="Ekonomi";
require_once('header.php');
session_start();

$orderid = $_GET['id'];

if (!isset($_SESSION["status"])) {
    header("location:index.php");
}

if(isset($_POST["submit_logout"])) {
    session_unset();
    header("location:index.php");
}

if (isset($_GET['orderby'])) {
    $order = $_GET['orderby'];
    $sort = $_GET['sort'];
    $allordersstmt = $db->prepare("SELECT * FROM orders LEFT JOIN `order_details` ON orders.id = order_details.order_id WHERE orders.id = $orderid AND order_details.order_id = $orderid  ORDER BY $order $sort");
    $allordersstmt->execute();
}
else {
    $allordersstmt = $db->prepare("SELECT * FROM orders
LEFT JOIN `order_details` ON orders.id = order_details.order_id
LEFT JOIN products_in_stock ON order_details.products_id = products_in_stock.id
LEFT JOIN shoes ON products_in_stock.shoe_id = shoes.id
WHERE orders.id = $orderid AND order_details.order_id = $orderid
ORDER BY order_details.products_id ASC");
    $allordersstmt->execute();
}
$allordesrsstmt = $db->prepare("SELECT *, COUNT(order_details.products_id) FROM orders
LEFT JOIN `order_details` ON orders.id = order_details.order_id
LEFT JOIN users ON orders.user_id = users.id
WHERE orders.id = $orderid AND order_details.order_id = $orderid");
$allordesrsstmt->execute();
?>
<div id="wrapper">
    <div id="wrapcenter">
        <div id="leftmenu">
            <ul>
                <li><a href="finance.php">Alla best&auml;llningar</a></li>
            </ul>
        </div>
        <div id="listcontent">
            <h1 class="newproduct">Orderinformation</h1>
            <p>Orderdetaljer:</p>
            <table style="width:1400px;padding-bottom: 40px;" class="allproducts">
                <tr>
                    <th class="allproducts" style="width:100px;text-align: center;">Produktnummer<br /><a href="singleorder.php?order_id=<?php echo $orderid; ?>&orderby=orderdetails.productnumber&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="singleorder.php?order_id=<?php echo $orderid; ?>&orderby=orderdetails.productnumber&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:100px;text-align: center;">Antal<br /><a href="singleorder.php?order_id=<?php echo $orderid; ?>&orderby=amount&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="singleorder.php?order_id=<?php echo $orderid; ?>&orderby=amount&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:180px;text-align: center;">Pris (kr)<br /><a href="singleorder.php?order_id=<?php echo $orderid; ?>&orderby=price&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="singleorder.php?order_id=<?php echo $orderid; ?>&orderby=price&sort=desc">&#x25BC;</a></th>
                </tr>
                <?php $custres = $allordersstmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($custres as $custrow)
                {
                    ?>
                    <tr>
                        <td><?php echo $custrow['products_id']; ?></td>
                        <td>1</td>
                        <td><?php echo $custrow['price']; ?></td>
                    </tr>
                <?php
                } ?>
            </table>
            <p>Totala ordern:</p>
            <table style="width:1400px;padding-bottom: 40px;" class="allproducts">
                <tr>
                    <th class="allproducts" style="width:100px;text-align: center;">Ordernr</th>
                    <th class="allproducts" style="width:100px;text-align: center;">Kundnr</th>
                    <th class="allproducts" style="width:100px;text-align: center;">Antal</th>
                    <th class="allproducts" style="width:180px;text-align: center;">Summa (kr)</th>
                    <th class="allproducts" style="width:180px;text-align: center;">Best&auml;llningsdatum</th>
                </tr>
                <?php $custress = $allordesrsstmt->fetchAll(PDO::FETCH_UNIQUE);
                foreach($custress as $custyrow)
                {
                    ?>
                <tr>
                    <td><?php echo $custyrow['order_id']; ?></td>
                    <td><a href="singlecustomer.php?id=<?php echo $custyrow['id']; ?>" title="Kunddetaljer"><?php echo $custyrow['id']; ?></a></td>
                    <td><?php echo $custyrow['COUNT(order_details.products_id)']; ?></td>
                    <td><?php echo $custyrow['total_price']; ?></td>
                    <td><?php echo date ('d/m/Y', strtotime ($custyrow['created_at'])); ?></td>
                </tr>
            </table>
            <table style="width:1400px;padding-bottom: 40px;" class="allproducts">
                <tr>
                    <th class="allproducts" style="width:100px;text-align: center;">Ordernr</th>
                    <th class="allproducts" style="width:80px;text-align: center;">Kundnr</th>
                    <th class="allproducts" style="width:140px;text-align: center;">Namn</th>
                    <th class="allproducts" style="width:300px;text-align: center;">Fraktadress</th>
                    <th class="allproducts" style="width:180px;text-align: center;">Best&auml;llningsdatum</th>
                    <th class="allproducts" style="width:120px;text-align: center;">Skriv ut</th>
                    <th class="allproducts" style="width:120px;text-align: center;">Kontakta kund</th>
                </tr>
                <tr>
                    <td><?php echo $custyrow['order_id']; ?></td>
                    <td><a href="singlecustomer.php?customer_id=<?php echo $custyrow['order_id']; ?>" title="Kunddetaljer"><?php echo $custyrow['id']; ?></a></td>
                    <td><a href="singlecustomer.php?customer_id=<?php echo $custyrow['id']; ?>" title="Kunddetaljer"><?php echo $custyrow['l_name'] . ", " . $custyrow['f_name']; ?></a></td>
                    <td><?php echo $custyrow['shipping_adress'] . ", " . $custyrow['shipping_postal_code'] . " " . $custyrow['shipping_postal_adress']; ?></td>
                    <td><?php echo date ('d/m/Y', strtotime ($custyrow['created_at'])); ?></td>
                    <td>Skriv ut ordern</td>
                    <td><a href="#" onclick="contactCustomer(<?php echo $custyrow['id'] . $custyrow['order_id']; ?>);">Kontakta</a></td>
                </tr>
                <tr id="<?php echo $custyrow['id'] . $custyrow['order_id']; ?>" style="display: none;width: 100%;">
                    <td colspan="9">
                        <form>
                            <div style="display: block;padding:10px;background: url('../imgs/cream_pixels.png');">
                                <h1>Kontakta kund</h1>
                                <div style="display: block;padding:20px;">
                                    <textarea style="width:80%;padding:5px;font-size:16px;" rows="10"></textarea>
                                </div>
                                <div style="display: block;padding:5px;width:77%;text-align: left;margin: 0 auto;">
                                    <div style="display:inline-block;">
                                        <span style="margin-right:10px;">Kundens e-mail:</span>
                                        <input type="text" name="customeremail[]" value="<?php
                                        echo $custyrow['email'];
                                        ?>" style="width:400px;padding:10px;font-size: 18px;">
                                    </div>
                                    <div style="display:inline-block;float:right;">
                                        <input type="submit" name="contactorder[]" value="Maila kund" style="width:150px;padding:9px;font-size:16px;">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                <?php
                } ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>