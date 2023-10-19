function addToCart(itemId){
    $.ajax({
        type: 'POST',
        async: false,
        url: "/?controller=cart&action=addtocart&id=" + itemId + "/",
        dataType: "json",
        success: function (data){
            if (data['success']){
                $('#cartCntItems').html(data['cntItems']);
                $('#addCart_'+itemId).hide();
                $('#removeFromCart_'+itemId).show();
            }
        }
    });
}


function removeFromCart(itemId){
    $.ajax({
        type: 'POST',
        async: false,
        url: "/?controller=cart&action=removefromcart&id=" + itemId + "/",
        dataType: "json",
        success: function (data){
            if (data['success']){
                $('#cartCntItems').html(data['cntItems']);
                $('#removeFromCart_'+itemId).hide();
                $('#addCart_'+itemId).show();

            }
        }
    });

}

function conversPrice(itemId, price){
    let newCnt = $('#itemCnt_' + itemId).val();
    let itemRealPrice = newCnt * price;
    $('#itemRealPrice_' + itemId).html(itemRealPrice + ' руб.')
}

function removeFromCartTrash(itemId){
    $.ajax({
        type: 'POST',
        async: false,
        url: "/?controller=cart&action=removefromcart&id=" + itemId + "/",
        dataType: "json",
        success: function (data){
            if (data['success']){
                $('#cartCntItems').html(data['cntItems']);
                $('#content').load(location.href + "#content");

            }
        }
    });

}
