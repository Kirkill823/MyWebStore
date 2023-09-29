<?php
include_once '../config/config.php';
include_once '../library/mainFunctions.php';

$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']):'index';
$actionName = isset($_GET['action']) ? $_GET['action']:'index';


loadPage($smarty, $controllerName, $actionName);