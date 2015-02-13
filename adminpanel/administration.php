<?php
    require_once('functions.php');
    $current="Hem";
    require_once('header.php');
    session_start();

    if (!isset($_SESSION["status"])) {
        header("location:index.php");
    }

    if(isset($_POST["submit_logout"])){
        session_unset();
        session_destroy();
        header("location:index.php");
    }

$countprods = $db->prepare("SELECT COUNT(id) FROM products_in_stock");
$countprods->execute();
$countprodsres = $countprods->fetchColumn();

$countorders = $db->prepare("SELECT COUNT(id) FROM orders");
$countorders->execute();
$countordersres = $countorders->fetchColumn();

$countcustomers = $db->prepare("SELECT COUNT(id) FROM users");
$countcustomers->execute();
$countcustomersres = $countcustomers->fetchColumn();

?>
<div id="wrapper">
    <div id="wrapcenter">
        <h1>Halloj, <b>Martin</b>!</h1>
        <table style="width: 900px; margin-top:30px;">
            <tr>
                <th style="font-size: 20px;">Totalt antal kunder:</th>
                <th style="font-size: 20px;">Totalt antal produkter:</th>
                <th style="font-size: 20px;">Totalt antal best&auml;llningar:</th>

            </tr>
            <tr>
                <td><?php echo $countcustomersres; ?></td>
                <td><?php echo $countprodsres; ?></td>
                <td><?php echo $countordersres; ?></td>

            </tr>
        </table>
    </div>
</div>
</body>
</html>