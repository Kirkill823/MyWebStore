<?php
//Контроллер функций пользователя

include_once '../models/CategoriesModel.php';
include_once '../models/UsersModel.php';

function indexAction($smarty){
    loadTemplate($smarty, 'registration');
}

/**
 * AJAX Регистрация пользователя
 * инициализация сессионной переменной ($_SESSIONХ['user'])
 * @return json Массив данных нового пользователя
 */
function registerAction(){
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $email = trim($email);

    $pass1 = isset($_REQUEST['pass1']) ? $_REQUEST['pass1'] : null;
    $pass2 = isset($_REQUEST['pass2']) ? $_REQUEST['pass2'] : null;

    $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;
    $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : null;
    $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
    $name = trim($name);
    $resData = null;
    $resData = checkRegisterParams($email, $pass1, $pass2);

    if(!$resData && checkUserEmail($email)){
        $resData['success'] = 0;
        $resData['message'] = "Пользователь с таким Email ('{$email}') уже зарегистрирован";
    }

    if(!$resData){
        $pwHash = password_hash($pass1, PASSWORD_BCRYPT);

        $userData = registerNewUser($email, $pwHash, $name, $phone, $address);
        if($userData['success']){
            $resData['message'] = 'Пользователь успешно зарегистрирован';
            $resData['success'] = 1;

            $userData=$userData[0];
            $resData['userName'] = $userData['name']?: $userData['email'];
            $resData['userEmail'] = $email;

            $_SESSION['user'] = $userData;
            $_SESSION['user']['displayName'] = $userData['name'] ?: $userData['email'];
        } else{
            $resData['success'] = 0;
            $resData['message'] = 'Ошибка регистрации';
        }
    }
    echo json_encode($resData);
}