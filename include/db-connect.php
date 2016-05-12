<?php

const tables = array (" null"     => array("null") ); //DO NOT CHANGE THIS

function db_insert($table, $params) {
    $conn = new mysqli($cfgs['db_host'],$cfgs['db_username'],$cfgs['db_password'],$cfgs['db_name']);
    if(!$conn->connect_errno){
        $query = "INSERT INTO $table VALUES (";
        for($i=0;$i<count($params);$i++){
            if($params[$i]!=null){$query .= "'".$params[$i]."'";}
            else{$query .= 'NULL';}
            if($i+1<count($params)){$query.=',';}
        }
        $query .= ")";
        
        if ($result = $conn->query($query)){
            return true;
        }
        else {
          return false;
        }
        $conn->close();
    }
    else{ return "error : ". $conn->connect_error; }
}




//'select' return 2d array, num and assoc. Ex:
//$result = db_select('member');
//$name1 = $result[0]['Name'];

function db_select($table){
    $conn = new mysqli($cfgs['db_host'],$cfgs['db_username'],$cfgs['db_password'],$cfgs['db_name']);
    if(!$conn->connect_errno){
        $sql = "SELECT * FROM $table";
        $result = $conn->query($sql);
        $conn->close();
        $ret = array();
        if(!$result){return '';}
        while($temp = mysqli_fetch_assoc($result)){
            array_push($ret, $temp);
        }
        return $ret;
    }
    else{
        return false;
    }
}

function db_select_where($table, $column, $param){
    $conn = new mysqli($cfgs['db_host'],$cfgs['db_username'],$cfgs['db_password'],$cfgs['db_name']);
    $hasil = "";
    if(!$conn->connect_errno){
        $sql = "SELECT * FROM $table WHERE $column='$param'";
        $result = $conn->query($sql);
        $conn->close();
        $ret = array();
        if(!$result){return '';}
        while($temp = mysqli_fetch_assoc($result)){
            array_push($ret, $temp);
        }
        return $ret;
    }
    else{
        return false;
    }
}


function db_select_wheres($table, $columns, $params){
    $conn = new mysqli($cfgs['db_host'],$cfgs['db_username'],$cfgs['db_password'],$cfgs['db_name']);
    if(!$conn->connect_errno){
        $query = "SELECT * FROM $table WHERE ";
        for($i=0;$i<count($columns);$i++){
            $query .= "$columns[$i]='$params[$i]'";
            if($i+1<count($columns)){$query.=' and ';}
        }
        $result = $conn->query($query);
        if(!$result){return false;}
        $conn->close();
        $ret = array();
        if(!$result){return '';}
        while($temp = mysqli_fetch_assoc($result)){
            array_push($ret, $temp);
        }
        if(!$ret){return false;}
        return $ret;
    }
    else{ return false; }
}

function db_custom($query){
    $conn = new mysqli($cfgs['db_host'],$cfgs['db_username'],$cfgs['db_password'],$cfgs['db_name']);
    if(!$conn->connect_errno){
        $result = $conn->query($query);
        $conn->close();
        $ret = array();
        if(!$result){return '';}
        while($temp = mysqli_fetch_assoc($result)){
            array_push($ret, $temp);
        }
        return $ret;
    }
    else{ return "error : ". $conn->connect_error; }
}






function db_update_where($table, $column, $param, $wherecolumn, $whereparam){
    
}

function db_update_wheres($table, $columns, $params, $wherecolumns, $whereparams){
    
}

function db_delete_where($table, $column, $param){
    $conn = new mysqli($cfgs['db_host'],$cfgs['db_username'],$cfgs['db_password'],$cfgs['db_name']);
    $hasil = "";
    if(!$conn->connect_errno){
        $query = "DELETE FROM $table WHERE $column='$param'";
        $result = $conn->query($query);
        if(!$result){return 'error';}
        return 'success';
    }
    else{
        $hasil = "error : ". $conn->connect_error;
    }
}

function db_delete_wheres($table, $columns, $params){
    $conn = new mysqli($cfgs['db_host'],$cfgs['db_username'],$cfgs['db_password'],$cfgs['db_name']);
    $hasil = "";
    if(!$conn->connect_errno){
        $query = "DELETE FROM $table WHERE ";
        for($i=0;$i<count($columns);$i++){
            $query .= "$columns[$i]='$params[$i]'";
            if($i+1<count($columns)){$query.=' and ';}
        }
        $result = $conn->query($query);
        if(!$result){return 'error';}
        return 'success';
    }
    else{
        $hasil = "error : ". $conn->connect_error;
    }
}