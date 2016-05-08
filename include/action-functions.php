<?php

include_once 'security.php';

function make_safe($string) {
    $string = trim($string);
    if(get_magic_quotes_gpc()){
        $string = stripcslashes($string);
    }
    $conn = mysqli_connect('localhost', 'root', '');
    $string = mysqli_real_escape_string($conn, $string);
    return $string;
}

function random_string($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function upload_file($name){
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["$name"]["name"]);
    move_uploaded_file($_FILES["$name"]["tmp_name"], $target_file);
}

function alert($message,$text){
    $_SESSION['message']=$message;
    $_SESSION['messagetext']=$text;
}

function safe_post($var){
    return make_safe($_POST[$var]);
}