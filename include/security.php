<?php

function sec_session_start() {
    // Forces sessions to only use cookies. Prevents session passing through URL
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: include/error.php?error=Could not initiate a safe session (ini_set)");
        exit();
    }
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Set a custom session name
    $session_name = 'sec_session_id';   
    session_name($session_name);
    session_start();
    session_regenerate_id();
}

function login_check() {
    // Check if all session variables are set 
    if (isset($_SESSION['username'], $_SESSION['login_string'])) {
        $login_string = $_SESSION['login_string'];
        $username = make_safe($_SESSION['username']);
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        if ($result=  db_select_where('user', 'Username', $username)) {
            $password=$result[0]['Password_Hashed'];
            $login_check = hash('sha512', $password . $user_browser);
            
            if ($login_check == $login_string) {
                return true;
            } else {}
        } else {}
    } else {}
}