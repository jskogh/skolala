<?php
require_once 'app/start.php';
?>
<?php include("incl/header.php"); ?>

<div class="purchase-complete">
    <h5>Tack för ditt köp!</h5>
    <p>välkommen tillbaka!</p>
    <p class="purchase-p">Informationen om din order har skickats till <span><?php echo $_SESSION['user_info']->email ?></span></p>
</div>

<?php include("incl/footer.php") ; ?>
