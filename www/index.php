<?php
//Начало Сессии
session_start();

//Если в сессии нет массива корзины, тогда мы создаем его
if(! isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

include_once '../config/config.php';
include_once '../library/mainFunctions.php';

$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']):'index';
$actionName = isset($_GET['action']) ? $_GET['action']:'index';

$smarty->assign('cartCntItems', count($_SESSION['cart']));

loadPage($smarty, $controllerName, $actionName);