<?php

//Контроллер страницы подкатегорий
include_once '../models/CategoriesModel.php';
include_once '../models/ProductModel.php';
include_once '../models/OrdersModel.php';
include_once '../models/PurchaseModel.php';

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

/**
 * Заказ
 * @param $smarty
 * @return void
 */
function orderAction($smarty){

    if (!isset($_SESSION['user'])){
        redirect('/?controller=user&action=login');
        return;
    }

    $itemsIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : null; //Получам массив товаров
    if (!$itemsIds) {
        redirect('/?controller=cart&'); //Если нет, возвращает в корзину
        return;
    }
    $itemsCnt = array();
    foreach ($itemsIds as $item) {
        //Формируем ключ для массива POST
        $postVar = 'itemCnt_' . $item;
        //$itemsCnt[3] = 2; товар с ID = 3 лежит в количистве 2 шт.
        $itemsCnt[$item] = isset($_POST[$postVar]) ? $_POST[$postVar] : null;
        //отладка. удалить
        echo $postVar . ' ' . $itemsCnt[$item] . '<br>';
    }

    //Список продуктов из массива крзины
    $recProducts = getProductsFromArray($itemsIds);
    echo $recProducts['name_ru'];//Удалить


    /**
     * Для каждой записи добавляем поле.
     * real price = Количество продуктов * цена 1 штуки
     * cnt = Кол-во товара в корзиен
     */

    $i = 0;
    foreach ($recProducts as &$item) {
        echo 'itemsCnt[item[id]] = ' . $itemsCnt[$item['id']] . "<br>"; //Удалить
        $item['cnt'] = isset($itemsCnt[$item['id']]) ? $itemsCnt[$item['id']] : 0;
        if ($item['cnt']) {
            $item['realPrice'] = $item['cnt'] * $item['price'];
            echo "item[realPrice] = " . $item['cnt'] . '*' . $item['price'] . '=' . $item['realPrice'] . '<br>';
        } else {
            //Если вдруг в корзине есть товар с количеством 0 - удалить
            unset($recProducts[$i]);
        }
        $i++;
    }
    if (!$recProducts){
        echo "Корзина пустая";
        return;
    }
    //Итоговый массив заказа отправляем в сессию
    $_SESSION['orderFromCart'] = $recProducts;

    $allCategories = getAllCategories();
    $smarty->assign('pageTitle', 'Заказ');
    $smarty->assign('allCategories', $allCategories);
    $smarty->assign('recProducts', $recProducts);

    loadTemplate($smarty, 'order');

}

/**
 * @return void
 *
 */
function saveorderAction(){
    $cart = isset($_SESSION['orderFromCart']) ? $_SESSION['orderFromCart'] : null;

    if (!$cart){
        $resData['success'] = 0;
        $resData['message'] = 'Нет товара в корзине';
        echo json_encode($resData);
        return;
    }
    //Проверка на существование
    $name = $_REQUEST['name'];
    $phone = $_REQUEST['phone'];
    $address = $_REQUEST['address'];

    //Создаем новый заказ и получаем его ID
    $orderId = makeNewOrder($name, $phone, $address);

    if(!$orderId){
        $resData['success'] = 0;
        $resData['message'] = "Ошибка создания заказа";
        echo json_encode($resData);
        return;
    }
    $res = setPurchaseForOrder($orderId, $cart);

    if ($res){
        $resData['success'] = 1;
        $resData['message'] = 'Заказ создан';
        unset($_SESSION['orderFromCart']);
        unset($_SESSION['cart']);
    }else{
        $resData['success'] = 0;
        $resData['message'] = "Ошибка сохранений данных заказа №" . $orderId;
    }
    echo json_encode($resData);

}
