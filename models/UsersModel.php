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

/**
 * @param $email
 * @param $pass
 * @return array
 */
function loginUser($email, $pass) {
    $email = htmlspecialchars($email);
    $sql = "SELECT * FROM users WHERE email = '{$email}' LIMIT 1";
    $link = createConnection();
    $result = mysqli_query($link, $sql);

    $result = createSmartyRecArr($result);
    if((isset($result[0])) &&  (password_verify($pass, $result[0]['pass']))){
        $result['success'] = 1;
    } else {
        $result['success'] = 0;
    }
    return $result;
}

/**
 * Изменение данных пользователя
 *
 * @param $name
 * @param $phone
 * @param $address
 * @param $pass1
 * @param $pass2
 * @return boolean TRUE в случае успеха
 */
function updateUserData($name, $phone, $address, $pass1, $pass2){
//не передаем email, так как он находится в сессионной пременной
    $email = htmlspecialchars($_SESSION['user']['email']);
    $name = htmlspecialchars($name);
    $phone = htmlspecialchars($phone);
    $address = htmlspecialchars($address);
    $pass1 = trim($pass1);
    $pass2 = trim($pass2);

    $newPass = null;
    if($pass1 && ($pass1 === $pass2)){
        $newPass = password_hash($pass1, PASSWORD_BCRYPT);
    }

    $sql = "UPDATE users SET ";
    if($newPass){
        $sql .="pass = '{$newPass}',";
    }
    $sql .= "name = '{$name}', email = '{$email}', phone = '{$phone}', address = '{$address}' ";
    $sql .="WHERE email = '{$email}' LIMIT 1";
    $link = createConnection();
    $result = mysqli_query($link, $sql);

    return $result;
}