<?php
/**
 * @return void
 */
function registerAction(){
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $email = trim($email);

    $pass1 = isset($_REQUEST['pass1']) ? $_REQUEST['pwd1'] : null;
    $pass2 = isset($_REQUEST['pass2']) ? $_REQUEST['pass2'] : null;

    $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;
    $adress = isset($_REQUEST['adress']) ? $_REQUEST['adress'] : null;
    $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
    $name = trim($name);

    $resData = null;
    $resData = checkRegisterParams($email, $pass1, $pass2);

    if(!$resData && checkEmail($email)){
        $resData['success'] = 0;
        $resData['message'] = "Пользователь с таким Email ('{$email}') уже зарегистрирован";
    }

}