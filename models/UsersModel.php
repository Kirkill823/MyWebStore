<?php
/**
 * @param $email
 * @param $passHash
 * @param $name
 * @param $phone
 * @param $adress
 * @return array|bool|mysqli_result
 */
function registerNewUser($email, $passHash, $name, $phone, $address){
    $email = htmlspecialchars($email);
    $name = htmlspecialchars($name);
    $phone = htmlspecialchars($phone);
    $address = htmlspecialchars($address);


    $sql = "INSERT INTO users (email, pass, name, phone, address) VALUES ('{$email}','{$passHash}','{$name}','{$phone}','{$address}')";
    $link = createConnection();
    $result = mysqli_query($link, $sql);

    if ($result) {
        $sql = "SELECT * FROM users WHERE (email = '{$email}'and  pass='{$passHash}') LIMIT 1";
        $result = mysqli_query($link, $sql);
        $result = createSmartyRecArr($result);

        if(isset($result[0])){$result['success']=1;}
        else {$result['success']=0;}
    }
     else {$result['success']=0;}
     return $result;
}

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
    $sql = "SELECT id  FROM users WHERE email = '" . $email ."'";
    $link = createConnection();
    $result = mysqli_query($link, $sql);

    return createSmartyRecArr($result);
}