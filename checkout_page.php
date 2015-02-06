<?php
use app\models\User;
use app\models\Shoes;
use app\DB;

require_once 'app/start.php';
require_once 'app/stripeConfig.php';






$shoes = new Shoes();

if ( $_SESSION['user'] != "logged" ) {
    $_SESSION['targetUrl'] = $_SERVER['REQUEST_URI'];
    header("location: login.php");
}
?>

    <?php include("incl/header.php"); ?>

    <div id="checkout_content" style="text-align: center;">
        <div id="checkout_summary" style="display:inline-block; width: 300px; margin: 0 auto">
            <h3>Products</h3>
            <p></p>
            <ul>
                <?php
                if ( isset($_SESSION['shopping_cart']) ) {
                    foreach ( $_SESSION['shopping_cart'] as $shoeArray) {
                        echo "<li class='menu_shopping_cart' style='display:inline-block; margin-top: 20px;'>
                                        <div class='cart-item-inline'>
                                            <img style='width: 100px;' src='img/shoes/" . $shoes->get($shoeArray['shoeId'])->pic1 . "' alt='shoe1'/>
                                        </div>
                                        <div class='cart-item-inline'>
                                            <p>" . $shoes->get($shoeArray['shoeId'])->product_name . "<span class='green cart-green'> " . " " . $shoes->get($shoeArray['shoeId'])->price . " kr </span> </p>
                                            <p class='shoe-attr-size'>Storlek: <span>" . $shoeArray['size'] . "</span></p>
                                            <p class='shoe-attr-amount'>antal: <span>" . $shoeArray['amount'] . "</span></p>
                                            <form method='post'>
                                                <div id='view_product'><a href='single_item_page.php?product-id=" . $shoes->get($shoeArray['shoeId'])->id . "'><input type='button' name='view_product_from_cart' value='Till produkt'/></a></div>
                                                <input class='remove-from-cart' type='submit' name='remove_from_cart' value='x'/>
                                                <input class='prod-id' type='hidden' name='shoe_id' value='" . $shoes->get($shoeArray['shoeId'])->id . "' />
                                            </form>
                                        </div>
                                    </li>";
                    }
                }
                ?>
            </ul>
        </div>
        <div class="checkout-section">
            <h5>Leveransadress</h5>
            <form class="payment-form" action="app/stripeCharge.php" method="POST">
                <div class="checkout-form">
                    <label>förnamn</label>
                    <input name="f_name" type="text" value="<?php echo ucfirst($_SESSION['user_info']->f_name) ?>"/>

                    <label>efternamn</label>
                    <input name="l_name" type="text" value="<?php echo ucfirst($_SESSION['user_info']->l_name) ?>"/>

                    <label>mobil (SMS avi)</label>
                    <input name="phone" type="text" value="<?php echo $_SESSION['user_info']->phone ?>"/>
                </div>
                <div class="checkout-form">
                    <label>adress</label>
                    <input name="adress" type="text" value="<?php echo ucfirst($_SESSION['user_info']->adress) ?>"/>

                    <label>postadress</label>
                    <input name="postal_adress" type="text" value="<?php echo ucfirst($_SESSION['user_info']->postal_adress) ?>"/>

                    <label>postnummer</label>
                    <input name="postal_code" type="text" value="<?php echo $_SESSION['user_info']->postal_code ?>"/>
                </div>


                    <button class="buy-button">Betala</button>


                <script>
                    var handler = StripeCheckout.configure({
                        key: "<?php echo $stripe['publishable_key']; ?>",
                        name: "EcoShoes",
                        panelLabel: "Totalt",
                        image: 'img/logo.png',
                        currency: "SEK",
                        email: "<?php echo $_SESSION['user_info']->email; ?>",
                        token: function(token) {
                            // Use the token to create the charge with a server-side script.
                            // You can access the token ID with `token.id`
                            console.log(token);
                            $('.payment-form').append($('<input>', {
                                name: 'stripeToken',
                                value: token.id,
                                type: 'hidden'
                            }));
                           $('.payment-form').submit();
                        }
                    });

                    $('.buy-button').on('click', function(e) {
                        // Open Checkout with further options
                        handler.open({
                            name: 'EcoShoes',
                            description: '',
                            amount: <?php echo $_SESSION['shopping_cart_total'] . "00" ?>
                        });
                        e.preventDefault();
                    });

                    // Close Checkout on page navigation
                    $(window).on('popstate', function() {
                        handler.close();

                    });


                </script>


                </form>

        </div>
    </div>
