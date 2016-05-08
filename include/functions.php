<?php

include_once 'security.php';

function show_view(){
    if(file_exists("view/".$_GET['page'].".php")){
        include("view/".$_GET['page'].".php");
    }
    else{
        echo 'THIS PAGE IS EMPTY!';
    }
}

//view
function set_title($title){
    echo "<title>$title</title>";
}

function redirect($page) {
    header("Location: index.php?page=$page");
}

function url_for($page){
    return "index.php?page=$page";
}

function link_to($page, $placeholder){
    return "<a href='".url_for($page)."'>$placeholder</a>";
}

function form_for($page, $title) {
    return "<form method='post' action='./action/form-action.php' enctype='multipart/form-data'> <input type='hidden' name='action' value='$page'/>"
            . "<div class='panel panel-default'>
        <div class='panel-heading'>$title</div>
        <div class='panel-body'>";
}

function form_for_addClass($page,$class,$title) {
    return "<form method='post' action='./action/form-action.php' class='$class' enctype='multipart/form-data'> <input type='hidden' name='action' value='$page'/>"
            . "<div class='panel panel-default'>
        <div class='panel-heading'>$title</div>
        <div class='panel-body'>";
}

function form_for_empty($page) {
    return "<form method='post' action='./action/form-action.php' enctype='multipart/form-data'> <input type='hidden' name='action' value='$page'/>";
}

function form_end(){
    return "</div><div class='panel-footer clearfix'><div class='pull-right'>
                <button type='submit' class='btn btn-primary'>Submit</button>
            </div></div></div></form> ";
}

function form_end_empty(){
    return "</form> ";
}

function input_text($name, $placeholder){
    return "<div class='form-group'>
                <label class='control-label col-xs-".$cfgs['form_label_col']."'>$placeholder</label>
                <div class='col-xs-".$cfgs['form_input_col']."'>
                    <input name='$name' type='text' class='form-control'  placeholder='$placeholder' required>
                </div>
            </div>";
}

function input_text_simple($name, $placeholder){
    return "<div class='form-group'>
                <div class='col-xs-12'>
                    <input name='$name' type='text' class='form-control'  placeholder='$placeholder' required>
                </div>
            </div>";
}

function input_hidden($name, $value){
    return "<input name='$name' type='hidden' value='$value'>";
}

function input_number($name, $placeholder){
    return "<div class='form-group'>
                <label class='control-label col-xs-".$cfgs['form_label_col']."'>$placeholder</label>
                <div class='col-xs-".$cfgs['form_input_col']."'>
                    <input name='$name' type='number' class='form-control numeric'  placeholder='$placeholder' required>
                </div>
            </div>";
}

function input_textarea($name, $placeholder){
    return "<div class='form-group'>
                <label class='control-label col-xs-".$cfgs['form_label_col']."'>$placeholder</label>
                <div class='col-xs-".$cfgs['form_input_col']."'>
                    <textarea name='$name' class='form-control'  placeholder='$placeholder' required></textarea>
                </div>
            </div>";
}

function input_date($name, $placeholder, $dateid){
    return "<div class='form-group'>
                <label class='control-label col-xs-".$cfgs['form_label_col']."'>$placeholder</label>
                <div class='col-xs-".$cfgs['form_input_col']."'>
                     <input name='$name' id='$dateid' type='text' class='form-control'  placeholder='$placeholder' required>
                </div>
            </div>";
}

function input_select($name, $placeholder, $valueindex, $optionsindex1, $optionsindex2, $array){
    $ret = "<div class='form-group'>
                <label class='control-label col-xs-".$cfgs['form_label_col']."'>$placeholder</label>
                <div class='col-xs-".$cfgs['form_input_col']."'>
                    <select class='form-control' name='$name'>";
    while ($a = $array->fetch_array(MYSQLI_NUM)) { 
        $ret.="<option value='$a[$valueindex]'>$a[$optionsindex1] ";
        $ret.=$optionsindex2!=null?'| '.$a[$optionsindex2]:'';
        $ret.=" </option>";
     }
     $ret.="    </select>
                </div>
            </div>";
     return $ret;
}

function input_password($name, $placeholder){
    return "<div class='form-group'>
                <label class='control-label col-xs-".$cfgs['form_label_col']."'>$placeholder</label>
                <div class='col-xs-".$cfgs['form_input_col']."'>
                    <input name='$name' type='password' class='form-control'  placeholder='$placeholder' required>
                </div>
            </div>";
}

function input_password_simple($name, $placeholder){
    return "<div class='form-group'>
                <div class='col-xs-12'>
                    <input name='$name' type='password' class='form-control'  placeholder='$placeholder' required>
                </div>
            </div>";
}

function input_file($name, $placeholder){
    return "<div class='form-group'>
                <label class='control-label col-xs-".$cfgs['form_label_col']."'>$placeholder</label>
                <div class='col-xs-".$cfgs['form_input_col']."'>
                    <input name='$names' type='file'>
                </div>
            </div>";
}

function input_text_value($name, $placeholder, $value){
    return "<div class='form-group'>
                <label class='control-label col-xs-".$cfgs['form_label_col']."'>$placeholder</label>
                <div class='col-xs-".$cfgs['form_input_col']."'>
                    <input name='$name' type='text' class='form-control' value='$value'  placeholder='$placeholder' required>
                </div>
            </div>";
}

function input_number_value($name, $placeholder, $value){
    return "<div class='form-group'>
                <label class='control-label col-xs-".$cfgs['form_label_col']."'>$placeholder</label>
                <div class='col-xs-".$cfgs['form_input_col']."'>
                    <input name='$name' type='number' class='form-control numeric' value='$value' placeholder='$placeholder' required>
                </div>
            </div>";
}

function input_textarea_value($name, $placeholder, $value){
    return "<div class='form-group'>
                <label class='control-label col-xs-".$cfgs['form_label_col']."'>$placeholder</label>
                <div class='col-xs-".$cfgs['form_input_col']."'>
                    <textarea name='$name' class='form-control'  placeholder='$placeholder' required>$value</textarea>
                </div>
            </div>";
}

function input_date_value($name, $placeholder, $dateid, $value){
    return "<div class='form-group'>
                <label class='control-label col-xs-".$cfgs['form_label_col']."'>$placeholder</label>
                <div class='col-xs-".$cfgs['form_input_col']."'>
                     <input name='$name' id='$dateid' type='text' class='form-control' value='$value' placeholder='$placeholder' required>
                </div>
            </div>";
}

function input_select_value($name, $placeholder, $valueindex, $optionsindex1, $optionsindex2, $array, $selected){
    $ret = "<div class='form-group'>
                <label class='control-label col-xs-".$cfgs['form_label_col']."'>$placeholder</label>
                <div class='col-xs-".$cfgs['form_input_col']."'>
                    <select class='form-control' name='$name'>";
    $a=0;
    while ($a = $array->fetch_array(MYSQLI_NUM)) { 
        $ret.="<option value='$a[$valueindex]' ".$a==$selected?"selected":"".">$a[$optionsindex1]| $a[$optionsindex2] </option>";
        $a++;
    }
    $ret.="    </select>
               </div>
           </div>";
    return $ret;
}


function input_static($value, $placeholder){
    return "<div class='form-group'>
                <label class='control-label col-xs-".$cfgs['form_label_col']."'>$placeholder</label>
                <div class='col-xs-".$cfgs['form_input_col']."'>
                    <p class='form-control-static'>$value</p>
                </div>
            </div>";
}

function button($type, $placeholder){
    return "<button type='button' class='btn btn-$type'>$placeholder</button>";
}