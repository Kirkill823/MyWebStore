<?php
/**
 * Контроллер главной страницы
 */

include_once "../models/CategoriesModel.php"; /* Поключение БД */
include_once "../models/ProductModel.php"; /* Последние товары */

/**
 * Метод формирования главной страницы
 * @param $smarty
 * @return void
 */
function indexAction($smarty){
    $allCategories = getAllCategories();
    $lastProducts = getLastProducts(LASTPRODUCTS);
    $smarty->assign('pageTitle', 'Домашняя страница');
    $smarty->assign('allCategories', $allCategories);
    $smarty->assign('recCategory', null);
    $smarty->assign('recProducts', $lastProducts);

    loadTemplate($smarty, 'index');
}