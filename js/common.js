function updateCartCount() {
    $.ajax({
        url: "/ajax/getCartCount",
        success: function( data ) {
            if (data == 0) {
                $('.basket-button-title').html("");
            } else {
                $('.basket-button-title').html("("+data+")");
            }
        }
    });
}
    