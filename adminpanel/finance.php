<?php
require_once('functions.php');
$current="Ekonomi";
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
    $allordersstmt = $db->prepare("SELECT * FROM orders ORDER BY $order $sort");
    $allordersstmt->execute();
}
else {
    $allordersstmt = $db->prepare("SELECT * FROM orders ORDER BY created_at DESC");
    $allordersstmt->execute();
}
?>
<div id="wrapper">
    <div id="wrapcenter">
        <div id="leftmenu">
            <ul>
                <li><a href="finance.php">Alla best&auml;llningar</a></li>
            </ul>
        </div>
        <div id="listcontent">
            <h1 class="newproduct">Alla best&auml;llningar</h1>
            <table style="width:1400px;padding-bottom: 40px;" class="allproducts">
                <tr>
                    <th class="allproducts" style="width:100px;text-align: center;">Ordernr<br /><a href="finance.php?orderby=id&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="finance.php?orderby=id&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:120px;text-align: center;">Kundnr<br /><a href="finance.php?orderby=user_id&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="finance.php?orderby=user_id&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:200px;text-align: center;">Totalsumma (kr)<br /><a href="finance.php?orderby=total_price&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="finance.php?orderby=total_price&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:180px;text-align: center;">Best&auml;llningsdatum<br /><a href="finance.php?orderby=created_at&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="finance.php?orderby=created_at&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:120px;text-align: center;">Kontakta kund</th>
                </tr>
                <?php $orderresult = $allordersstmt->fetchAll();
                foreach($orderresult as $orderrow)
                {
                    ?>
                    <tr>
                        <form method="post">
                        <td><a href="singleorder.php?id=<?php echo $orderrow['id']; ?>" title="Orderdetaljer"><?php echo $orderrow['id']; ?></a>
                            <input type="hidden" value="<?php echo $orderrow['id']; ?>" name="order_id">
                        </td>
                        <td><a href="singlecustomer.php?id=<?php echo $orderrow['user_id']; ?>" title="Kunddetaljer"><?php echo $orderrow['user_id']; ?></a></td>
                        <td><?php echo $orderrow['total_price']; ?> kr</td>
                        <td><?php echo date ('d/m/Y', strtotime ($orderrow['created_at'])); ?></td>
                        </form>
                        <td><a href="#" onclick="contactCustomer(<?php echo $orderrow['id']; ?>);">Kontakta</a></td>
                    </tr>
                    <tr id="<?php echo $orderrow['id']; ?>" style="display: none;width: 100%;">
                        <td colspan="9">
                            <form>
                                <div style="display: block;padding:10px;background: url('../imgs/cream_pixels.png');">
                                    <h1>Kontakta kund ang&aring;ende ordernr <?php echo $orderrow['id']; ?></h1>
                                    <div style="display: block;padding:20px;">
                                        <textarea style="width:80%;padding:5px;font-size:16px;" rows="10"></textarea>
                                    </div>
                                    <div style="display: block;padding:5px;width:77%;text-align: left;margin: 0 auto;">
                                        <div style="display:inline-block;">
                                            <span style="margin-right:10px;">Kundens e-mail:</span>
                                            <input type="text" name="customeremail[]" value="<?php
                                            $customerid = $orderrow['user_id'];
                                            $contactorder = $db->prepare("SELECT email FROM users WHERE id = $customerid");
                                            $contactorder->execute();
                                            $customeremail = $contactorder->fetchColumn();
                                            echo $customeremail;
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