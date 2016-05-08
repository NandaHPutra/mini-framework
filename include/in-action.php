<?php 
include_once 'include/action-functions.php';
include_once 'include/db-connect.php';
if (session_status() == PHP_SESSION_NONE) {
    sec_session_start(); 
}
function redirect_to($page) {
    header("Location: index.php?page=$page");
}
function default_logout(){
    sec_session_start();
    $_SESSION = array();
    session_destroy();
}
$out=call_user_func('execute_'.$_GET['page']);
