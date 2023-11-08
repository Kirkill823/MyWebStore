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
function getData(obj_form){
    let hData = {};
    $('input, textarea, select', obj_form).each(function (){
        if(this.name && this.name!=''){
            hData[this.name] = this.value;
           // console.log('hData[' + this.name +']= = ' + hData[this.name]);
        }
    });
    return hData;
}

function registerNewUser(){
    let postData = getData('#reg');
    $.ajax({
        type: 'POST',
        async: false,
        url: '/?controller=user&action=register&email=' +postData['email'] + '&pass1=' + postData['pass1'] + '&pass2=' + postData['pass2'],
        dataType: 'json',
        success: function (data){
            alert(data['message']);
            if (data['success']){
                window.location.href = '/' //ссылка, куда пользователь отправится после логина
            }
        }

    });
}

function loginUser(){
    let postData = getData('#auth');

    $.ajax({
        type:'POST',
        async: false,
        url: '/?controller=user&action=login&email=' + postData['emailLogin'] + '&pass=' +   postData['passLogin'],
        dataType:'json',
        success: function (data){

            if(data['success']){
                window.location.href = '/'; //Перевод пользователя на главную стр
            } else {
                alert(data['message']); //вывод сообщения об ошибки
            }
        }

    })
}

function updateUserData(){
    let postData= getData('#profile');
    console.log(postData);

    $.ajax({
        type: 'POST',
        async: false,
        url: '/?controller=user&action=update&name=' + postData['newName'] + '&phone=' + postData['newPhone'] + '&address=' + postData['newAddress'] + '&pass1=' + postData['newPass1'] + '&pass2=' + postData['newPass2'] + '&curPass' + postData['curPass'],
        dataType: 'json',
        success: function (data){
            if (data['success']){
                alert(data['message']); //вывод сообщения
            }else {
                alert(data['message']) //вывод сообщения
            }
        }
    })


}

function saveOrder(){
    let name = $('#userName').html();
    let phone = $('#userPhone').html();
    let address = $('#userAddress').html();
    console.log(name, phone, address);
    $.ajax({
        type: 'POST',
        async: false,
        url: '/?controller=cart$action=saveorder&name=' + name + '&phone=' + phone + '&address=' + address,
        dataType: 'json',
        success:function (data){
            if (data['success']){
                alert(data['message']);
            } else {
                alert(data['message']);
            }
        }
    })
}