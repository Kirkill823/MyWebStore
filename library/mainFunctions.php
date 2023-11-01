<?php
/**
 *
 * Основвные функции
 *
 * @param $controllerName
 * @param $actionName
 * @return void
 */
function loadPage($smarty, $controllerName, $actionName = 'index'){
    include_once  PATHPREFIX.$controllerName.PATHPOSTFIX;
    $function = $actionName . "Action";
    $function($smarty);
}

function loadTemplate($smarty, $templateName){
    $smarty->display($templateName . TMPLTPOSTFIX);

}

function createSmartyRecArr($record){
    if(!$record) return false;
    $smartyRec = array();
    while ($row = mysqli_fetch_array($record)){$smartyRec[] = $row;}
    return $smartyRec;
}

function redirect(string $url = '/'){
    header("Location: {$url}");
    exit;
}