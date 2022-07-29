<?php

include("classes/connect.php");


if(isset($_GET['vkey'])){
    //process verification
    $vkey = $_GET['vkey'];
    
    $DB = new Database();
    
    $query = "select verified,vkey from users where verified = 0 AND vkey = '$vkey' limit 1";
    
   
            
    $resultset = $DB->read($query);
    
    
    
    if($resultset[0]['verified'] == 0){
        //validate the email
        $query = "update users set verified = 1 where vkey = '$vkey' limit 1";
        $update = $DB->save($query);
        
        if($update){
            echo "Your account has been verified. You may now login";
        }else{
        echo "something wrong";
        }
        
    }else{
        echo "this account is invalid or already verified";
    }
    
}else{
    
    die("something went wrong");
}