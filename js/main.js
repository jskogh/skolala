$(document).ready(function() {

    $('body').on('click', '.add-to-cart', function(e) {
        e.preventDefault();
        var product_id = $(this).next().val();
        var size = $(this).prev().val();
        addToCart(product_id, size);
    });

    $('body').on('click', '.remove-from-cart', function(e) {
        e.preventDefault();
        var product_id = $(this).next().val();
        var size = $(this).parent().parent().prev().prev().children('.shoe-attr-size').children().text();
        var amount = $(this).parent().parent().prev().children('span');
        var liElement = $(this).parent().parent().parent().parent();

        removeFromCart(product_id, size, amount, liElement);

    });

});

function removeFromCart(product_id, size, amount, liElement) {
    var activate = true;
    $.post('ajax/shoppingCartHandler.php', {remove_from_cart: activate, shoe_id: product_id, size: size}, function(data) {
        var shoe = JSON.parse(data);
        if ( parseInt(shoe.attr.amount) < 1 ) {
            console.log("Remove");
            liElement.remove();
        }else {
            console.log("server: " + shoe.attr.amount);
            amount.text( shoe.attr.amount );
        }
        activate = false;
    });

}

function addToCart(product_id, size) {
    var activate = true;
    // checks not only if shoe ID already exists in cart ALSO check if Id && size is a match.
    $.post('ajax/shoppingCartHandler.php', {add_to_cart: activate, shoe_id: product_id, size: size}, function(data) {
        var shoe = JSON.parse(data);
        if ( parseInt(shoe.attr.amount) > 1 ) { // if item already exists in shopping cart, increment the amount by 1
            console.log("high");
            $('.menu_shopping_cart').each(function() {

                if ( $(this).children("form").children(".prod-id").val() === product_id &&
                    $(this).children(".shoe-attr-size").children("span").text() === size ) {

                    $(this).children(".shoe-attr-amount").children("span").text( shoe.attr.amount );
                }

            });

        }else { // if item DOES NOT exist in shopping cart, add it.

            $('#checkout_summary ul').append(
                $('<li>', {class: "menu_shopping_cart", style: "display: block; margin-top: 20px;"}).append(
                    '<div class="cart-item-inline"><img style="width: 100px;" src="img/shoes/' + shoe.prop.pic1 + '"  alt="shoe1"/></div>',
                    '<div class="cart-item-inline"><p>' + shoe.prop.product_name + ' <span class="green cart-green">' + shoe.prop.price + ' kr</span></p>' +
                    '<p class="shoe-attr-size">Storlek: <span>' + shoe.attr.size + '</span></p>'+
                    '<p class="shoe-attr-amount">antal: <span>' + shoe.attr.amount + '</span></p>'+
                    '<form method="post">' +
                        '<div id="view_product"><a href="single_item_page.php?product-id=' + shoe.prop.id + '"><input type="button" name="view_product_from_cart" value="Till produkt"/></a></div>' +
                        '<input class="remove-from-cart" type="submit" name="remove_from_cart" value="x"/>' +
                        '<input class="prod-id" type="hidden" name="shoe_id" value="' + shoe.prop.id + '" />' +
                    '</form><div>'
                ));
        }
        activate = false;
    });

}