<?php include_once '../include/in-form-action.php';

//all submitted forms go into this page
//use execute_"form_name"(){...}

function execute_login(){
    $username=make_safe($_POST['username']);
    $password=$_POST['password'];
    if(default_login($username, $password)){
        redirect_to('menu');
    }else{
        redirect_to('home');
    }
}

function execute_signup(){
    $username=  make_safe($_POST['username']);
    $pass1=  make_safe($_POST['pass1']);
    $pass2=  make_safe($_POST['pass2']);
    $dname=  make_safe($_POST['dname']);
    if(default_signup($username, $password)){
        redirect_to('menu');
    }else{
        redirect_to('home');
    }
}

