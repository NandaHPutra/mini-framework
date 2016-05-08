<?php 
include_once 'include/in-action.php';
//this page is used to perform various controller activities before opening view pages.
//also works as <a href="url_for(view_name)">...</a> and link_to('view_name')
//use execute_"view_name"(){...}

function execute_login(){
    
}

function execute_menu(){
    
}

function execute_logout(){
    default_logout();
    redirect_to('home');
}
