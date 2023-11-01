<?php

//Контроллер страницы подкатегорий
include_once '../models/CategoriesModel.php';
include_once '../models/ProductModel.php';

/**
 * Метод формирования страницы корзины
 * @param $smarty
 * @return void
 */

function indexAction($smarty)
{
    $itemIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;

    $allCategories = getAllCategories();
    if(count($itemIds)!==0) {$recProducts = getProductsFromArray($itemIds);}
    else{$recProducts = null;}

    $smarty->assign('pageTitle', 'Корзина');
    $smarty->assign('allCategories', $allCategories);
    $smarty->assign('recProducts', $recProducts);

    loadTemplate($smarty, 'cart');

}

//Добавление в корзину
function addtocartAction(){
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : null;
    if(! $itemId) return false;

    $resData = array();

    if(isset($_SESSION['cart']) && array_search($itemId, $_SESSION['cart']) === false) {
        $_SESSION['cart'][] = $itemId;
        $resData['cntItems'] = count($_SESSION['cart']);
        $resData['success'] = 1;
    }

    else{$resData['success'] = 0;}

    echo json_encode($resData);


}

//Удаление из корзины
function removefromcartAction(){
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : null;
    if(!$itemId) exit();

    $resData = array();
    $key = array_search($itemId, $_SESSION['cart']);
    if($key !== false){
        unset($_SESSION['cart'][$key]);
        $resData['success'] = 1;
        $resData['cntItems'] = count($_SESSION['cart']);
    } else {$resData['success'] = 0;}
echo json_encode($resData);
}

function orderAction($smarty){
    $itemsids = isset($_SESSION['cart']) ? $_SESSION['cart'] : null; //Получам массив товаров
    if(!$itemsids) {
        redirect('/?controller=cart&'); //Если нет, возвращает в корзину
        return;
    }
    $itemscnt = array();
    foreach ($itemsids as $item) {
        //Формируем ключ для массива POST
        $postVar = 'itemsCnt_' . $item;
        $itemscnt[$item] = isset($_POST[$postVar]) ? $_POST[$postVar] : null;
        echo $postVar . '' . $itemscnt[$item] . '<br>';
    }
}