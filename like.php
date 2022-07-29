<?php

session_start();
include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/image.php");
include("classes/profile.php");
include("classes/time.php");


$login = new Login();
$user_data = $login->check_login($_SESSION['taruc_studentid']);


isset($_SESSION['taruc_studentid']);

$post = new post();



if(isset($_SERVER['HTTP_REFERER']))
{
    $return_to = $_SERVER['HTTP_REFERER'];
    
}else{
    
    $return_to = "profile.php";
}

    if(isset($_GET['type']) && isset($_GET['id'])){
        
      
        
        if(is_numeric($_GET['id'])){
            
              
            $allowed[] = 'post';
            $allowed[] = 'profile';
            $allowed[] = 'comment';
            
            if(in_array($_GET['type'], $allowed)){
                
                
                    
                     $post->like_post($_GET['id'],$_GET['type'],$_SESSION['taruc_studentid']);
    
            }
            
           
            
        }
        
        
   
    }

    //using header always get internal server error 500
                //header('Location :'. $return_to);

     echo "<script type='text/javascript'> ";
     echo "window.location= '$return_to'";
     echo "</script> ";

       

        die;




?>