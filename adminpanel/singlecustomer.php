<?php
require_once('functions.php');
$current="Kunder";
require_once('header.php');
session_start();

if (!isset($_SESSION["status"])) {
    header("location:index.php");
}

if(isset($_POST["submit_logout"])) {
    session_unset();
    header("location:index.php");
}

$customerid = $_GET['id'];

if (isset($_GET['orderby'])) {
    $order = $_GET['orderby'];
    $sort = $_GET['sort'];
    $allordersstmt = $db->prepare("SELECT *, orders.id as orderid FROM `users` LEFT JOIN `orders` ON users.id = orders.user_id WHERE users.id = $customerid AND orders.user_id = $customerid ORDER BY $order $sort");
    $allordersstmt->execute();
}
else {
    $allordersstmt = $db->prepare("SELECT *, orders.id as orderid FROM `users` LEFT JOIN `orders` ON users.id = orders.user_id WHERE users.id = $customerid AND orders.user_id = $customerid ORDER BY orders.created_at DESC");
    $allordersstmt->execute();
}
$allordesrsstmt = $db->prepare("SELECT *, COUNT(orders.user_id) FROM users LEFT JOIN orders ON users.id = orders.user_id WHERE users.id = $customerid");
$allordesrsstmt->execute();
?>
<div id="wrapper">
    <div id="wrapcenter">
        <div id="leftmenu">
            <ul>
                <li><a href="customers.php">Alla kunder</a></li>
            </ul>
        </div>
        <div id="listcontent">
            <h1 class="newproduct">Kundinformation</h1>
            <p>Kundinformation:</p>
            <table style="width:1400px;padding-bottom: 40px;" class="allproducts">
                <tr>
                    <th class="allproducts" style="width:100px;text-align: center;">Kundnr</th>
                    <th class="allproducts" style="width:300px;text-align: center;">Namn</th>
                    <th class="allproducts" style="width:200px;text-align: center;">E-mail</th>
                    <th class="allproducts" style="width:140px;text-align: center;">Telefon</th>
                    <th class="allproducts" style="width:260px;text-align: center;">Adress</th>
                    <th class="allproducts" style="width:180px;text-align: center;">Reg-datum</th>
                    <th class="allproducts" style="width:160px;text-align: center;">Antal ordrar</th>
                    <th class="allproducts" style="width:120px;text-align: center;">Kontakta kund</th>
                </tr>
                <?php $custress = $allordesrsstmt->fetchAll(PDO::FETCH_UNIQUE);
                foreach($custress as $custyrow) {
                    ?>
                    <tr>
                        <td><?php echo $custyrow['id']; ?></td>
                        <td><?php echo $custyrow['l_name'] . ", " . $custyrow['f_name']; ?></td>
                        <td><?php echo $custyrow['email']; ?></td>
                        <td><?php echo $custyrow['phone']; ?></td>
                        <td><?php echo $custyrow['adress'] . ", " . $custyrow['postal_code'] . " " . $custyrow['postal_adress']; ?></td>
                        <td><?php echo date ('d/m/Y', strtotime ($custyrow['created_at'])); ?></td>
                        <td><?php echo $custyrow['COUNT(orders.user_id)']; ?></td>
                        <td><a href="#" onclick="contactCustomer(<?php echo $customerid; ?>);" title="Kontakta kund">Kontakta</a></td>
                    </tr>
                    <tr id="<?php echo $customerid; ?>" style="display: none;width: 100%;">
                        <td colspan="10">
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
                                            echo $custyrow['email']
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
                }
                ?>
            </table>
            <p>Kundens ordrar:</p>
            <table style="width:1400px;padding-bottom: 40px;" class="allproducts">
                <tr>
                    <th class="allproducts" style="width:100px;text-align: center;">Kundnr<br /><a href="singlecustomer.php?id=<?php echo $customerid; ?>&orderby=users.id&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="singlecustomer.php?id=<?php echo $customerid; ?>&orderby=users.id&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:300px;text-align: center;">Namn<br /><a href="singlecustomer.php?id=<?php echo $customerid; ?>&orderby=l_name&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="singlecustomer.php?id=<?php echo $customerid; ?>&orderby=l_name&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:200px;text-align: center;">E-mail<br /></th>
                    <th class="allproducts" style="width:140px;text-align: center;">Telefon</th>
                    <th class="allproducts" style="width:260px;text-align: center;">Fraktadress</th>
                    <th class="allproducts" style="width:160px;text-align: center;">Ordernr<br /><a href="singlecustomer.php?id=<?php echo $customerid; ?>&orderby=orders.id&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="singlecustomer.php?id=<?php echo $customerid; ?>&orderby=orders.id&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:180px;text-align: center;">Best&auml;llningsdatum<br /><a href="singlecustomer.php?id=<?php echo $customerid; ?>&orderby=orders.created_at&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="singlecustomer.php?id=<?php echo $customerid; ?>&orderby=orders.created_at&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:120px;text-align: center;">Kontakta kund</th>
                </tr>
                <?php $custres = $allordersstmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($custres as $custrow)
                {
                    ?>
                    <tr>
                        <td><?php echo $custrow['id']; ?></td>
                        <td><?php echo $custrow['l_name'] . ", " . $custrow['f_name']; ?></td>
                        <td><?php echo $custrow['email']; ?></td>
                        <td><?php echo $custrow['phone']; ?></td>
                        <td><?php echo $custrow['shipping_adress'] . ", " . $custrow['shipping_postal_code'] . " " . $custrow['shipping_postal_adress']; ?></td>
                        <td><a href="singleorder.php?id=<?php echo $custrow['orderid']; ?>"><?php echo $custrow['orderid']; ?></a></td>
                        <td><?php echo date ('d/m/Y', strtotime ($custrow['created_at'])); ?></td>
                        <td><a href="#" onclick="contactCustomer(<?php echo $custrow['id'] . $custrow['orderid']; ?>);">Kontakta</a></td>
                    </tr>
                    <tr id="<?php echo $custrow['id'] . $custrow['orderid']; ?>" style="display: none;width: 100%;">
                        <td colspan="10">
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
                                            echo $custrow['email']
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