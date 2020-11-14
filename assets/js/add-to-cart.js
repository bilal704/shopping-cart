function addToCart(pid, qty, price, title){

    data = {};

    data.id = pid;
    data.qty = qty;
    data.price = price;
    data.name = title;
    
    $.ajax({

        method: "post",
        url: "/cart/addToCart",
        data: {'data' : JSON.stringify(data)},
        dataType: 'JSON',
        beforeSend:function(){

            $('.loader').addClass('loading');
        },
        success: function(response){

            $('.loader').removeClass('loading');
            alert(response.msg);
            $('#cart-count').text(response.count);
        }
    });

    return false;
}