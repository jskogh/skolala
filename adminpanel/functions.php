<?php
// Admin functions
function adminlogin($password) {
    $db = new PDO('mysql:host=db4free.net;dbname=skolala;charset=utf8', 'skolala', 'Medie2014');
    $inlogstm = $db->prepare("SELECT * FROM users WHERE email = 'camen@camensky.se' AND password = :password");
    $inlogstm->bindParam(":password", $password, PDO::PARAM_STR);
    $inlogstm->execute();

    if ($inlogstm->rowCount() == 1) {
        session_start();
        $_SESSION["status"] = "inloggad";
        return true;
    }
    else {
        return false;
    }
}

function logout(){
    if(isset($_POST["submit_logout"])){
        session_unset();
        session_destroy();
        header("location:index.php");
    }
}
$db = new PDO('mysql:host=db4free.net;dbname=skolala;charset=utf8', 'skolala', 'Medie2014');

// Lägg till produkt
if (isset($_POST['addproduct'])) {
    $productstm = $db->prepare("INSERT INTO products (productnumber, productname, width, height, gender, brand, price, `condition`, status, frontimg, sideimg1, sideimg2, sideimg3, description, creationtime)
    VALUES (:productnumber, :productname, :width, :height, :gender, :brand, :price, :condition, :status, :frontimg, :sideimg1, :sideimg2, :sideimg3, :description, now())");

    $productstm->bindParam(":productnumber", $_POST["productnumber"], PDO::PARAM_INT);
    $productstm->bindParam(":productname", $_POST["productname"], PDO::PARAM_STR);
    $productstm->bindParam(":width", $_POST["width"], PDO::PARAM_INT);
    $productstm->bindParam(":height", $_POST["height"], PDO::PARAM_INT);
    $productstm->bindParam(":gender", $_POST["gender"], PDO::PARAM_STR);
    $productstm->bindParam(":brand", $_POST["brand"], PDO::PARAM_STR);
    $productstm->bindParam(":price", $_POST["price"], PDO::PARAM_INT);
    $productstm->bindParam(":condition", $_POST["condition"], PDO::PARAM_STR);
    $productstm->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
    $productstm->bindParam(":frontimg", $_POST["frontimg"], PDO::PARAM_STR);
    $productstm->bindParam(":sideimg1", $_POST["sideimg1"], PDO::PARAM_STR);
    $productstm->bindParam(":sideimg2", $_POST["sideimg2"], PDO::PARAM_STR);
    $productstm->bindParam(":sideimg3", $_POST["sideimg3"], PDO::PARAM_STR);
    $productstm->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
    if ($productstm->execute()) {
        echo "Produkt tillagd<br />";
    } else {
        echo "fan, nåt gick snett" . $productstm->errorCode();
    }
    $product_id = $db->lastInsertId();

    $colorstmt = $db->prepare('INSERT INTO colors (colorname, product_id) VALUES (:colorname, :product_id)');
    foreach($_POST["color"] as $color) {
        $colorstmt->bindParam(":colorname", $color, PDO::PARAM_STR);
        $colorstmt->bindParam(":product_id", $product_id);
        $colorstmt->execute();
    }

    $materialstmt = $db->prepare('INSERT INTO materials (materialname, product_id) VALUES (:materialname, :product_id)');
    foreach($_POST["material"] as $material) {
        $materialstmt->bindParam(":materialname", $material, PDO::PARAM_STR);
        $materialstmt->bindParam(":product_id", $product_id);
        $materialstmt->execute();
    }

    $prodcatsstm = $db->prepare("INSERT INTO product_categories (product_id, category_id, categoryname) VALUES (:product_id, :category_id, :categoryname)");
    foreach ($_POST['categories'] as $category) {
        $prodcatsstm->bindParam(":category_id", $category, PDO::PARAM_INT);
        $prodcatsstm->bindParam(":categoryname", $category, PDO::PARAM_STR);
        $prodcatsstm->bindParam(":product_id", $product_id);
        $prodcatsstm->execute();
    }
}

// Redigera produkt
if (isset($_POST['editproduct'])) {
    $product_id = $_GET['product_id'];
    $productstm = $db->prepare("UPDATE products SET productnumber = :productnumber, productname = :productname, width = :width, height = :height,
 gender = :gender, brand = :brand, price = :price, `condition` = :condition, status = :status, frontimg = :frontimg, sideimg1 = :sideimg1,
  sideimg2 = :sideimg2, sideimg3 = :sideimg3, description = :description WHERE product_id = $product_id");

    $productstm->bindParam(":productnumber", $_POST["productnumber"], PDO::PARAM_INT);
    $productstm->bindParam(":productname", $_POST["productname"], PDO::PARAM_STR);
    $productstm->bindParam(":width", $_POST["width"], PDO::PARAM_INT);
    $productstm->bindParam(":height", $_POST["height"], PDO::PARAM_INT);
    $productstm->bindParam(":gender", $_POST["gender"], PDO::PARAM_STR);
    $productstm->bindParam(":brand", $_POST["brand"], PDO::PARAM_STR);
    $productstm->bindParam(":price", $_POST["price"], PDO::PARAM_INT);
    $productstm->bindParam(":condition", $_POST["condition"], PDO::PARAM_STR);
    $productstm->bindParam(":status", $_POST["status"], PDO::PARAM_STR);
    $productstm->bindParam(":frontimg", $_POST["frontimg"], PDO::PARAM_STR);
    $productstm->bindParam(":sideimg1", $_POST["sideimg1"], PDO::PARAM_STR);
    $productstm->bindParam(":sideimg2", $_POST["sideimg2"], PDO::PARAM_STR);
    $productstm->bindParam(":sideimg3", $_POST["sideimg3"], PDO::PARAM_STR);
    $productstm->bindParam(":description", $_POST["description"], PDO::PARAM_STR);
    if ($productstm->execute()) {
        echo "Produkt uppdaterad.<br />";
    } else {
        echo "N&aring;got gick snett, googla felkod: " . $productstm->errorCode() . "<br />";
    }

    $deletecolors = "DELETE FROM colors WHERE product_id = $product_id";
    $dcstmt = $db->prepare($deletecolors);
    $dcstmt->execute();

    $colorstmt = $db->prepare("INSERT INTO colors (product_id, colorname) VALUES (:product_id, :colorname)");
    foreach($_POST["color"] as $color) {
        $colorstmt->bindParam(":product_id", $product_id);
        $colorstmt->bindParam(":colorname", $color, PDO::PARAM_STR);
        if ($colorstmt->execute()) {
            echo "F&auml;rger uppdaterade.<br />";
        } else {
            echo "N&aring;got gick snett, googla felkod: " . $colorstmt->errorCode() . "<br />";
        }
    }

    $deletematerials = "DELETE FROM materials WHERE product_id = $product_id";
    $dmstmt = $db->prepare($deletematerials);
    $dmstmt->execute();

    $materialstmt = $db->prepare('INSERT INTO materials (materialname, product_id) VALUES (:materialname, :product_id)');
    foreach($_POST["material"] as $material) {
        $materialstmt->bindParam(":materialname", $material, PDO::PARAM_STR);
        $materialstmt->bindParam(":product_id", $product_id);
        if ($materialstmt->execute()) {
            echo "Material uppdaterat.<br />";
        } else {
            echo "N&aring;got gick snett, googla felkod: " . $materialstmt->errorCode() . "<br />";
        }
    }

    $deleteprodcasts = "DELETE FROM product_categories WHERE product_id = $product_id";
    $stmt = $db->prepare($deleteprodcasts);
    $stmt->execute();

    $prodcatsstm = $db->prepare("INSERT INTO product_categories (product_id, category_id, categoryname) VALUES (:product_id, :category_id, :categoryname)");
    foreach ($_POST['categories'] as $category) {
        $prodcatsstm->bindParam(":product_id", $product_id);
        $prodcatsstm->bindParam(":category_id", $category, PDO::PARAM_INT);
        $prodcatsstm->bindParam(":categoryname", $category, PDO::PARAM_STR);
        if ($prodcatsstm->execute()) {
            echo "Kategorier uppdaterade.<br />";
        } else {
            echo "N&aring;got gick snett, googla felkod " . $prodcatsstm->errorCode() . "<br />";
        }
    }


}

// Finances - ordrar

if (isset($_POST['updateorder'])) {
    $order_id = $_POST['order_id'];
    $orderupdatestm = $db->prepare("UPDATE orders SET paid = :paid, unpaid = :unpaid, status = :status WHERE order_id = $order_id");

    $orderupdatestm->bindParam(":paid", $_POST["paid"], PDO::PARAM_INT);
    $orderupdatestm->bindParam(":unpaid", $_POST["unpaid"], PDO::PARAM_INT);
    $orderupdatestm->bindParam(":status", $_POST["status"], PDO::PARAM_STR);

    if ($orderupdatestm->execute()) {
        echo "Order uppdaterad.<br />";
    } else {
        echo "N&aring;got gick snett, googla felkod: " . $orderupdatestm->errorCode() . "<br />";
    }
}

// Maila kund från ordersidan
if (isset($_POST['contactorder'])) {

    // Data för mailet
    $sender = "martin.camenius@gmail.com";
    $sendername = "Retrospecs";
    $recipient = $_POST['customeremail'];
    $subject = "Retrospecs - Uppdateringar g&auml;llande din order";
    $message = "Innehållet i mailet";

// Generera datum och mailets id
    $date = date(DATE_RFC2822);
    $mid = "<" . sha1(microtime()) . "@" . $_SERVER['HTTP_HOST'] . ">";

// Ställ in rätt kodningstyp
    mb_internal_encoding("UTF-8");

// Rätt kodning för avsändare och mottagares namn
    $sendername = mb_encode_mimeheader($sendername);
    $recipientname = mb_encode_mimeheader($recipientname);

// Sätt headers
    $headers =<<<EOT
From: $sendername <$sender>
Date: $date
Message-ID: $mid
MIME-Version: 1.0
Content-Type: text/plain; charset="UTF-8"
EOT;

// Skicka mail
    $status = mb_send_mail("$recipientname <$recipient>", $subject, $message, $headers, "-f$sender");
    if(!$status) {
        echo "Mail kunde inte skickas.";
    }
    else {
        print_r("Mail skickat!");
    }



}