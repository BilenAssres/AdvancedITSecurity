<?php

if (isset($_POST['save']) && $_POST['g-recaptcha-response'] != "") {
    include "dbconfig.php";
    $secret = '6LctkJEgAAAAAFz6x9wvv-pMWo5_nLGuWM_XvLbN';
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);
    if ($responseData->success) {
        
        //first validate then insert in db
        $email = $_POST['e'];
        $pass = $_POST['p'];
        mysqli_query($conn, "INSERT INTO user(email ,pass) VALUES('" . $_POST['e'] . "', '" . md5($_POST['p']) . "')");
    }
}