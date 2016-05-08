<?php 
include_once '../include/action-functions.php';  
include_once '../include/db-connect.php'; 
if (session_status() == PHP_SESSION_NONE) {  
    sec_session_start(); 
}
if ( function_exists ( 'execute_'.$_POST['action'] ) ) { 
    call_user_func('execute_'.$_POST['action']); 
    
} else { 
    if(isset($_POST['action'])){
        echo "Please assign form submit function for form '".$_POST['action']."'. "
                . "Assign new function using 'execute_*form_name*'";
    } else {
        redirect_to('home');
    }
}

function redirect_to($page) {
    header("Location: ../index.php?page=$page");
} 

function upload_path(){
    return "../uploads/";
}

function default_login($username, $password){
    $username=  make_safe($username);
    if ($result = db_select_where('user', 'Username', $username)){
        
        //checkbrute
        $brutelist = db_select_where('login_attempts', 'User_Username', $username);
        $counter=0;
        for($i=0;$i<count($brutelist);$i++){
            if(time()-$brutelist[$i]['Created_At']<300){
                $counter++;
            }
        }
        if($counter<3){
            
            //check password
            $password = hash('sha512', $password.$result[0]['Salt']);
            if($password == $result[0]['Password_Hashed']){
                
                //fill session
                $user_browser = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['username'] = $username;
                $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                
                db_delete_where('login_attempts', 'Username', $username);
                return true;
                
            }else{
                //record attempts
                db_insert('login_attempts', array(null,$username,time()));
                alert('error','Username and password did not match');
                return false;
            }
            
        }else{
            alert('error','Your account is locked. Please try again in a few minutes');
            return false;
        }
        
    }else{
        alert('error','Username and password did not match');
        return false;
    }
}

function default_signup($username, $pass1, $pass2, $dname){
    $username=  safe_post($username);
    if(!db_select_where('user', 'Username', $username)){
        if($pass1==$pass2){
            $dname = safe_post($dname);
            $salt = random_string(128);
            $pass = hash('sha512', $pass1.$salt);
            if($res = db_insert('user', array($username, $dname, $salt, $pass))){
                alert('success', 'Your account is active.');
            }else{
                alert('error', 'General system failure (db_connect)');
            }
        }else{
            alert('error', 'Passwords did not match.');
        }
    }else{
        alert('error', 'Username is taken. Please pick another one.');
    }
    redirect_to('home');
}