<?php
function setPurchaseForOrder($orderId, $cart){
    $sql = "INSERT INTO purchase (order_id, product_id, price, amount) VALUES ";

    $values = array();
    foreach ($cart as $item) {
        $values[] = "('{$orderId}','{$item['id']}', '{$item['price']}', '{$item['cnt']}')";
    }
    //Преобразуем массив в строку
    $sql .= implode(', ', $values);
    $link = createConnection();
    $result = mysqli_query($link, $sql);

    return $result;
}