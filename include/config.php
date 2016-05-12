<?php 
function get_config(){
    return array(
    
        //database connection configs
        'db_host' => 'localhost',
        'db_username' => 'root',
        'db_password' => '',
        'db_name' => 'mini-framework',

        //form label to input width ratio. based on bootstrap's 12units length.
        'form_label_col' => 3,
        'form_input_col' => 9,

        //index view of app
        'index' => 'login'

    );
}