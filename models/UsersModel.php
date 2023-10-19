<?php
/**
 * @param $email
 * @param $pass1
 * @param $pass2
 * @return array
 */
function checkRegisterParams($email, $pass1, $pass2){
    $result = null;

    if(!$email){
        $result['success'] = null;
        $result['message'] = "Некорректный Email";
    }

    if(!$pass1){
        $result['success'] = null;
        $result['message'] = "Введите пароль";
    }
    if(!$pass2){
        $result['success'] = null;
        $result['message'] = "Подтвердите пароль";
    }

    if($pass1 != $pass2){
        $result['success'] = null;
        $result['message'] = "Пароли не совпадают";
    }
    return $result;
}

function checkUserEmail($email){
    $email = htmlspecialchars($email);
}