function updateCartCount() {
    $.ajax({
        url: "/ajax/getCartCount",
        success: function( data ) {
            if (data == 0) {
                $('.htc__qua').hide();
            } else {
                $('.htc__qua').html(data);
            }
        }
    });
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
