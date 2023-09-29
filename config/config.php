<?php
/**
 * файл настроек проекта
 */
/** константы для обращения к контроллеру */
const PATHPREFIX = '../controllers/';
const PATHPOSTFIX = 'Controller.php';


//Константы для подключения к БД
const DB_HOST = 'localhost';
const DB_NAME = 'myWebStore';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

//Количество послдних товаров
const LASTPRODUCTS = 16;

//Папка шаблонов
$templateFolder = 'default';

//Пути к щаблону
define('TMPLTPREFIX',"../views/{$templateFolder}/");
const TMPLTPOSTFIX = '.tpl';

//Путь к шаблонам в WWW
define('TMPLTWEBPATH',"../templates/{$templateFolder}/");

//Подклбчение класса Smarty
require ('../library/Smarty/libs/Smarty.class.php');
$smarty = new Smarty();
// Предварительная настройка
$smarty->setTemplateDir(TMPLTPREFIX);// путь к шаблонам
$smarty->setCompileDir('../tmp/smarty/template_c');// путь к комп шаблонам
$smarty->setCacheDir('../tmp/smarty/cache');
$smarty->setConfigDir('../library/Smarty/configs');

$smarty->assign('templateWebPath', TMPLTWEBPATH);