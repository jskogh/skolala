$(document).ready(function() {

    $('body').on('click', '.add-to-cart', function(e) {
        e.preventDefault();
        var product_id = $(this).next().val();
        var size = $(this).prev().val();
        console.log(size);
        addToCart(product_id, size);
    });

    $('body').on('click', '.remove-from-cart', function(e) {
        e.preventDefault();
        var product_id = $(this).next().val();
        var size = $(this).parent().parent().prev().children('.shoe-attr-size').children().text();
        var amount = $(this).parent().prev().children('span');
        var liElement = $(this).parent().parent();

        removeFromCart(product_id, size, amount, liElement);

    });

});

function removeFromCart(product_id, size, amount, liElement) {
    $.post('ajax/shoppingCartHandler.php', {remove_from_cart: true, shoe_id: product_id, size: size}, function(data) {
        var shoe = JSON.parse(data);
        console.log(shoe);
        if ( shoe ) {
            amount.text( shoe[0].amount );
            console.log(shoe[0].amount);
        }else {
            liElement.remove();
        }
    });
}

function addToCart(product_id, size) {
    var activate = true;
    // checks not only if shoe ID already exists in cart ALSO check if Id && size is a match.
    $.post('ajax/shoppingCartHandler.php', {add_to_cart: activate, shoe_id: product_id, size: size}, function(data) {
        var shoe = JSON.parse(data);
        console.log(shoe);
        if ( shoe.attr.amount > 1 ) { // if item already exists in shopping cart, increment the amount by 1
            console.log("if");
            console.log(shoe.attr.amount);
            $('.menu_shopping_cart').each(function() {

                if ( $(this).children("form").children("input[type='hidden']").val() == product_id &&
                    $(this).children(".shoe-attr-size").children("span").text() == size) {

                    $(this).children(".shoe-attr-amount").children("span").text( shoe.attr.amount );
                }

            });

        }else { // if item DOES NOT exist in shopping cart, add it.
            console.log("else");
            console.log(shoe.attr.amount);
            $('#checkout_summary ul').prepend(
                $('<li>', {class: "menu_shopping_cart", style: "display: block; margin-top: 20px;"}).append(
                    '<p><img style="width: 100px;" src="img/shoes/' + shoe.prop.pic1 + '"  alt="shoe1"/></p>',
                    '<p>' + shoe.prop.product_name + '</p>',
                    '<p>' + shoe.prop.price + ' kr</p>',
                    '<p class="shoe-attr-size">Storlek: <span>' + shoe.attr.size + '</span></p>',
                    '<p class="shoe-attr-amount">antal: <span>' + shoe.attr.amount + '</span></p>',
                    '<form method="post">' +
                    '<input class="remove-from-cart" type="submit" name="remove_from_cart" value="remove"/>' +
                    '<input type="hidden" name="shoe_id" value="' + shoe.prop.id + '" />' +
                    '</form>'
                ));
        }
        activate = false;
    });

}