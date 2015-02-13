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

if (isset($_GET['orderby'])) {
    $order = $_GET['orderby'];
    $sort = $_GET['sort'];
    // $allordersstmt = $db->prepare("SELECT * FROM customers ORDER BY $order $sort");
    $allcuststm = $db->prepare("SELECT *, COUNT(orders.id) as totalorders FROM `users` LEFT JOIN `orders` ON users.id = orders.user_id WHERE users.id !='26' GROUP BY users.id ORDER BY $order $sort");
    $allcuststm->execute();
}
else if (isset($_GET['orderbyorders'])) {
    $sort = $_GET['sort'];
// $allordersstmt = $db->prepare("SELECT * FROM customers ORDER BY $order $sort");
    $allcuststm = $db->prepare("SELECT *, COUNT(orders.id) as totalorders FROM `users` LEFT JOIN `orders` ON users.id = orders.user_id WHERE users.id !='26' GROUP BY users.id ORDER BY totalorders $sort");
    $allcuststm->execute();
}

/*else {
    $allcuststm = $db->prepare("SELECT *, SUM(orders.unpaid), COUNT(orders.order_id), SUM(orders.paid) FROM `users` LEFT JOIN `orders` ON customers.customer_id = orders.customer_id GROUP BY customers.customer_id ORDER BY creationtime DESC");
    $allcuststm->execute();
}*/

else {
    $allcuststm = $db->prepare("SELECT *, COUNT(orders.id) as totalorders FROM `users` LEFT JOIN `orders` ON users.id = orders.user_id WHERE users.id !='26' GROUP BY users.id ORDER BY users.created_at DESC");
    $allcuststm->execute();
}
?>
<div id="wrapper">
    <div id="wrapcenter">
        <div id="leftmenu">
            <ul>
                <li><a href="customers.php">Alla kunder</a></li>
            </ul>
        </div>
        <div id="listcontent">
            <h1 class="newproduct">Alla kunder</h1>
            <table style="width:1400px;padding-bottom: 40px;" class="allproducts">
                <tr>
                    <th class="allproducts" style="width:100px;text-align: center;">Kundnr<br /><a href="customers.php?orderby=users.id&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="customers.php?orderby=users.id&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:300px;text-align: center;">Namn<br /><a href="customers.php?orderby=l_name&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="customers.php?orderby=l_name&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:200px;text-align: center;">E-mail<br /></th>
                    <th class="allproducts" style="width:140px;text-align: center;">Telefon</th>
                    <th class="allproducts" style="width:260px;text-align: center;">Adress</th>
                    <th class="allproducts" style="width:160px;text-align: center;">Antal best&auml;llningar<br /><a href="customers.php?orderbyorders=orders&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="customers.php?orderbyorders=orders&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:180px;text-align: center;">Reg-datum<br /><a href="customers.php?orderby=users.created_at&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="customers.php?orderby=users.created_at&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:120px;text-align: center;">Kontakta kund</th>
                </tr>
                <?php $custres = $allcuststm->fetchAll();
                foreach($custres as $custrow)
                {
                    ?>
                    <tr>
                        <td><a href="singlecustomer.php?id=<?php echo $custrow['id']; ?>" title="Kunddetaljer"><?php echo $custrow['id']; ?></td>
                        <td><a href="singlecustomer.php?id=<?php echo $custrow['id']; ?>" title="Kunddetaljer"><?php echo $custrow['l_name'] . ", " . $custrow['f_name']; ?></a></td>
                        <td><?php echo $custrow['email']; ?></td>
                        <td><?php echo $custrow['phone']; ?></td>
                        <td><?php echo $custrow['adress'] . ", " . $custrow['postal_code'] . " " . $custrow['postal_adress']; ?></td>
                        <td><?php echo $custrow['totalorders']; ?></td>
                        <td><?php echo date ('d/m/Y', strtotime ($custrow['created_at'])); ?></td>
                        <td><a href="#" onclick="contactCustomer(<?php echo $custrow['id']; ?>);" title="Kontakta kund">Kontakta</a></td>
                    </tr>
                    <tr id="<?php echo $custrow['id']; ?>" style="display: none;width: 100%;">
                        <td colspan="10">
                            <form>
                                <div style="display: block;padding:10px;background: url('../imgs/cream_pixels.png');">
                                    <h1>Kontakta <?php echo $custrow['f_name'] . " " . $custrow['l_name']; ?></h1>
                                    <div style="display: block;padding:20px;">
                                        <textarea style="width:80%;padding:5px;font-size:16px;" rows="10"></textarea>
                                    </div>
                                    <div style="display: block;padding:5px;width:77%;text-align: left;margin: 0 auto;">
                                        <div style="display:inline-block;">
                                            <span style="margin-right:10px;">Kundens e-mail:</span>
                                            <input type="text" name="customeremail[]" value="<?php echo $custrow['email'] ?>"
                                                   style="width:400px;padding:10px;font-size: 18px;">
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