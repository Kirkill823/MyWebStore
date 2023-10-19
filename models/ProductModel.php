<?php
/**
 * получение списка товаров для главной страницы
 * @param $limit - количество товаров
 * @return array|false
 */
function getLastProducts($limit = null){

    $sql = 'SELECT * FROM products ORDER BY id DESC'; //Сортировка в обратном порядке
    $link = createConnection();

    if($limit) {
        $sql = $sql . ' LIMIT ' .$limit;
    }
    $result = mysqli_query($link,  $sql);

    return createSmartyRecArr($result);
}

/**
 * Получение списка товаров для страницы подкатегории
 * @param $id - идентификатор подкатегории
 * @return array|false
 */
function getProductsById($id){
    //Защита SQl Инъекций
    $itemId = intval($id);
    $sql = 'SELECT * FROM products WHERE category_id =' . $itemId;
    $link = createConnection();
    $result = mysqli_query($link, $sql);
    if($result === false){echo 'Error' . mysqli_error($link);}
    return createSmartyRecArr($result);

}

/**
 * Возвращаем инфу о конкректном товаре
 * @param $id - id товара
 * @return array|false|null
 */
function getProductById($id){

    $itemId = intval($id);
    $sql = 'SELECT * FROM products WHERE id =' . $itemId;
    $link = createConnection();
    $result = mysqli_query($link, $sql);

    return mysqli_fetch_assoc($result);

}


function getProductsFromArray($itemIds){
    $strIds = implode($itemIds, ', ');
    $sql = 'SELECT * FROM products WHERE id in (' . $strIds . ')';

    $link = createConnection();

    $result = mysqli_query($link, $sql);

    if ($result === false){
        echo 'Ошибка номер' . mysqli_error($result);
        echo $sql;
    }
    return createSmartyRecArr($result);
}