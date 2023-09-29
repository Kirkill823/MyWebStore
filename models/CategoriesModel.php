<?php
/** Модель категорий для меню */

/**
 * Создание подключения к БД
 * @return mysqli|string
 */
function createConnection(){
    $link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($link === false){
        $err = "Ошибка подклбчение к БД №" . mysqli_connect_error();
        return $err;
    }
    else {return $link;}}

/**
 * Получение подкатегорий товаров из БД
 * @param $recId - идентификатор категории
 * @return array|false
 */
function getChildren($recId){
    $sql = 'SELECT * FROM categories WHERE parent_id =' . $recId;
    $link = createConnection();
    $result = mysqli_query($link, $sql);
    return createSmartyRecArr($result);
}


/**
 * Подтягивание главных категорий из БД
 * @return array|bool
 *
 */
function getAllCategories()
{
    $sql = 'SELECT * FROM categories WHERE parent_id = 0';
    $link = createConnection();
    $result = mysqli_query($link, $sql);
    $smartyArr = array();

    if ($result === false) {
        return false;
    } else {
        while ($row = mysqli_fetch_array($result)) {
            $recChildren = getChildren($row['id']);
            if($recChildren){
                $row['children'] = $recChildren;
            }
            $smartyArr[] = $row;
        }
    }
    return $smartyArr;
}

/**
 *Получение информация о подкатегории
 * @param $id - идентификатор категории
 * @return array|false|null
 */
//Получаем дочерние категории
    function getCategoriesById($id){
    //Защита SQL путем приведения его в INT
    $categoryId = intval($id);
    $sql = 'SELECT * FROM categories WHERE id =' . $categoryId;
    $link = createConnection();
    $result = mysqli_query($link, $sql);
    return mysqli_fetch_assoc($result);
}