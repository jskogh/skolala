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
    header("location:index.php");
}
$db = new PDO('mysql:host=db4free.net;dbname=skolala;charset=utf8', 'skolala', 'Medie2014');
if (isset($_GET['orderby'])) {
    if (isset ($_GET['status'])) {
        $status = $_GET['status'];
        $order = $_GET['orderby'];
        $sort = $_GET['sort'];
        $allstmt = $db->prepare("SELECT * FROM shoes WHERE status = '$status' ORDER BY $order $sort");
        $allstmt->execute();
    }
    else {
        $order = $_GET['orderby'];
        $sort = $_GET['sort'];
        $allstmt = $db->prepare("SELECT * FROM shoes ORDER BY $order $sort");
        $allstmt->execute();
    }
}
else {
    $allstmt = $db->prepare("SELECT * FROM shoes ORDER BY created_at DESC");
    $allstmt->execute();
}
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $allstmt = $db->prepare("SELECT * FROM shoes WHERE status = '$status' ORDER BY created_at DESC");
    $allstmt->execute();
}
if (isset($_GET['stock'])) {
    $stock = $_GET['stock'];
    $allstmt = $db->prepare("SELECT * FROM shoes WHERE stock = '$stock' ORDER BY created_at DESC");
    $allstmt->execute();
}
if (isset($_POST['deactiveproduct'])) {
    $deactivatestmt = $db->prepare("UPDATE shoes SET id = :id, status = :status WHERE id = :id");
    $deactivatestmt->bindParam(":id", $_POST['id'], PDO::PARAM_INT);
    $deactivatestmt->bindParam(":status", $_POST['status'], PDO::PARAM_STR);
    if ($deactivatestmt->execute()) {
        echo "Produkt avaktiverad";
    }
    else {
        echo "N&aring;got gick snett, googla felkod: " . $deactivatestmt->errorCode() . "";
    }
}

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
            <h1 class="newproduct">Alla produkter</h1>
            <p></p>
            <table style="width:1200px;" class="allproducts">
                <tr>
                    <th class="allproducts" style="width:100px;text-align: center;">Produktnummer<br /><a href="products.php?<?php
                    if (isset ($_GET['status'])) {
                        $status = $_GET['status'];
                        echo 'status=' . $status . '&';
                    }
                    ?>orderby=id&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="products.php?<?php
                        if (isset ($_GET['status'])) {
                            $status = $_GET['status'];
                            echo 'status=' . $status . '&';
                        }
                        ?>orderby=id&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:120px;text-align: center;">Produktbild</th>
                    <th class="allproducts" style="width:200px;text-align: center;">Produktnamn<br /><a href="products.php?<?php
                        if (isset ($_GET['status'])) {
                            $status = $_GET['status'];
                            echo 'status=' . $status . '&';
                        }
                        ?>orderby=product_name&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="products.php?<?php
                        if (isset ($_GET['status'])) {
                            $status = $_GET['status'];
                            echo 'status=' . $status . '&';
                        }
                        ?>orderby=product_name&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:75px;text-align: center;">Pris<br /><a href="products.php?<?php
                        if (isset ($_GET['status'])) {
                            $status = $_GET['status'];
                            echo 'status=' . $status . '&';
                        }
                        ?>orderby=price&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="products.php?<?php
                        if (isset ($_GET['status'])) {
                            $status = $_GET['status'];
                            echo 'status=' . $status . '&';
                        }
                        ?>orderby=price&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:75px;text-align: center;">Saldo<br /><a href="products.php?<?php
                        if (isset ($_GET['status'])) {
                            $status = $_GET['status'];
                            echo 'status=' . $status . '&';
                        }
                        ?>orderby=stock&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="products.php?<?php
                        if (isset ($_GET['status'])) {
                            $status = $_GET['status'];
                            echo 'status=' . $status . '&';
                        }
                        ?>orderby=stock&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:180px;text-align: center;">Status<br /><a href="products.php?<?php
                        if (isset ($_GET['status'])) {
                            $status = $_GET['status'];
                            echo 'status=' . $status . '&';
                        }
                        ?>orderby=status&sort=asc">&#x25B2;</a>&nbsp;&nbsp;&nbsp;<a href="products.php?<?php
                        if (isset ($_GET['status'])) {
                            $status = $_GET['status'];
                            echo 'status=' . $status . '&';
                        }
                        ?>orderby=status&sort=desc">&#x25BC;</a></th>
                    <th class="allproducts" style="width:75px;text-align: center;">&Auml;ndra</th>
                    <th class="allproducts" style="width:100px;text-align: center;">Ta bort</th>
                </tr>
                <?php $result = $allstmt->fetchAll();
                foreach($result as $row)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><img src="../img/shoes/<?php echo $row['pic1']; ?>" width='150px' height='60px'"></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['price']; ?> kr</td>
                        <td><?php echo $row['stock']; ?> st</td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <a href="editproduct.php?id=<?php echo $row['id']; ?>">&Auml;ndra</a>
                        </td>
                        <td>
                            <form method="post" class="deactivate">
                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="status" value="Avaktiverad">
                                <input type="submit" name="deactiveproduct" value="Ta bort" class="deactivateproduct">
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