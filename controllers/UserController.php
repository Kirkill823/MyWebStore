<?php
//Контроллер функций пользователя

include_once '../models/CategoriesModel.php';
include_once '../models/UsersModel.php';

function indexAction($smarty){
    $allCategories = getAllCategories();

    $smarty->assign('pageTitle', 'Профиль');
    $smarty->assign('allCategories', $allCategories);
    $smarty->assign('recCategory', null);

    loadTemplate($smarty, 'profile');
}

function templateregAction($smarty){
    loadTemplate($smarty, 'registration');
}
function templateauthAction($smarty){
    loadTemplate($smarty, 'authorization');
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

function logoutAction(){
    if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
        unset($_SESSION['user']);
    }
    redirect('/');
}

/**
 * @return json Массив данных для авторизации пользователя
 */
function loginAction(){
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $email = trim($email);

    $pass = isset($_REQUEST['pass']) ? $_REQUEST['pass'] : null;
    $pass = trim($pass);

    $userData = loginUser($email, $pass);

    if($userData['success']){
        $userData = $userData[0]; //Сразу созраняет 0 элемент для удобности

        //иннициализируем сессионную переменную
        $_SESSION['user'] = $userData;
        $_SESSION['user']['displayName'] = $userData['name'] ?: $userData['email'];

        $resData['userName'] = $_SESSION['user'];
        $resData['success'] = 1;
    } else{
        $resData['success'] = 0;
        $resData['message'] = 'Неверный Email или пароль';
    }
    echo json_encode($resData); //Возвращаем JS данные
}

function updateAction(){
    if(!isset($_SESSION['user'])){
        redirect('/');
    }
    $resData = array();

    $phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;
    $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : null;
    $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
    $pass1 = isset($_REQUEST['pass1']) ? $_REQUEST['pass1'] : null;
    $pass2 = isset($_REQUEST['pass2']) ? $_REQUEST['pass2'] : null;
    $curPass = isset($_REQUEST['curPass']) ? $_REQUEST['curPass'] : null;


  //  if(!$curPass || !(password_verify($curPass, $_SESSION['user']['pass']))){
   //     $resData['success'] = 0;
   //     $resData['message'] = "Неверный пароль";
   //     echo json_encode($resData);
   //     return false;
  //  }

    $res = updateUserData($name, $phone, $address, $pass1, $pass2);
    if($res){
        $resData['success'] = 1;
        $resData['message'] = "Данные сохранены";
        $resData['userName'] = $name;

        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['phone'] = $phone;
        $_SESSION['user']['address'] = $address;

        $newPass = $_SESSION['user']['pass'];
        if($pass1 && ($pass1 = $pass2)){
            $newPass = password_hash(trim($pass1), PASSWORD_BCRYPT);
        }
        $_SESSION['user']['pass'] = $newPass;

        $_SESSION['user']['displayName'] = $name ?: $_SESSION['user']['email'];
    } else{
        $resData['success'] = 0;
        $resData['message'] = "Ошибка сохранения данных";
    }
    echo json_encode($resData);
}