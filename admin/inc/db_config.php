<?php

$hname = 'localhost';
$uname = 'root';
$pass = '';
$db = 'hotel_management';

$con = mysqli_connect($hname,$uname,$pass,$db);

if(!$con){
    die("cannot connect to database".mysqli_connect_error());
}

function filteration($data){
    foreach($data as $key => $value){
        $data[$key] = trim($value);
        $data[$key] = stripcslashes($value);
        $data[$key] = htmlspecialchars($value);
        $data[$key] = strip_tags($value);
    }
    return $data;
}

function select($sql,$values,$datatypes){
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con, $sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values); //... = splat operator(connects with bind param)
        if(mysqli_stmt_execute($stmt)){
           $res = mysqli_stmt_get_result($stmt);
           mysqli_stmt_close($stmt);
           return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("Query cannot be prepared - select");

        }
    }
    else{
        die("Query cannot be executed - select");
    }
}
?>