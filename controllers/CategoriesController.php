<?php
//Контроллер страницы подкатегорий
include_once '../models/CategoriesModel.php';
include_once '../models/ProductModel.php';

/**
 * Метод формирования страницы подкатегорий
 * @param $smarty
 * @return void
 */

function indexAction($smarty){
    $childCategoryId = isset($_GET['id']) ? $_GET['id'] : null;
    if($childCategoryId === null) exit();

    $allCategories = getAllCategories();
    //Информация о подкатегории, которую будем использовать дальше
    $recCategory = getCategoriesById($childCategoryId);
    //Информация о продуктах внутри категорий
    $recProducts = getProductsById($childCategoryId);

    $smarty->assign('pageTitle', $recCategory['name_ru']);
    $smarty->assign('allCategories', $allCategories);
    $smarty->assign('recCategory', $recCategory);
    $smarty->assign('recProducts', $recProducts);

    loadTemplate($smarty, 'category');
}
