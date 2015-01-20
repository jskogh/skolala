$(document).ready(function() {

    $('body').on('click', '.add-to-cart', function(e) {
        e.preventDefault();
        var product_id = $(this).next().val();
        addToCart(product_id);
    });

    $('body').on('click', '.remove-from-cart', function(e) {
        e.preventDefault();
        var product_id = $(this).next().val();
        var amount = $(this).parent().prev().children('span');
        var liElement = $(this).parent().parent();
        removeFromCart(product_id, amount, liElement);
    });

});

function removeFromCart(product_id, amount, liElement) {
    var activate = true;

    $.post('ajax/shoppingCartHandler.php', {remove_from_cart: activate, shoe_id: product_id}, function(data) {
        var shoeAmount = JSON.parse(data);
        if ( shoeAmount ) {
            amount.text( shoeAmount )
            console.log(shoeAmount);
        }else {
            liElement.remove();
            console.log(liElement);
        }

        activate = false;
    });
}

function addToCart(product_id) {
    var activate = true;

    $.post('ajax/shoppingCartHandler.php', {add_to_cart: activate, shoe_id: product_id}, function(data) {

        var shoe = JSON.parse(data);

        if ( shoe >= 1) { // if item already exists in shopping cart, increment the amount by 1

            $('.menu_shopping_cart').each(function() {

                if ( $(this).children("form").children("input[type='hidden']").val() == product_id ) {
                    $(this).children("p").children("span").text( shoe );
                }
            });

        }else { // if item DOES NOT exist in shopping cart, add it.

            $('#checkout_summary ul').append(
                $('<li>', {class: "menu_shopping_cart", style: "display: block; margin-top: 20px;"}).append(
                    '<p><img style="width: 100px;" src="img/shoes/' + shoe.prop.pic1 + '"  alt="shoe1"/></p>',
                    '<p>' + shoe.prop.product_name + '</p>',
                    '<p>' + shoe.prop.price + ' kr</p>',
                    '<p>antal: <span>' + shoe.amount + '</span></p>',
                    '<form method="post">' +
                    '<input class="remove-from-cart" type="submit" name="remove_from_cart" value="remove"/>' +
                    '<input type="hidden" name="shoe_id" value="' + shoe.prop.id + '" />' +
                    '</form>'
                ));
        }
        activate = false;
    });

}