<?php 

    session_start();
    //print_r($_SESSION);
 
include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/image.php");
include("classes/profile.php");



$login = new Login();
$user_data = $login->check_login($_SESSION['taruc_studentid']);
$Post = new post(); 


$USER = $user_data;

if(isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "delete.php"))
{
    $_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];
}



$ERROR = "";
if(isset($_GET['id']))
{
  
    $ROW = $Post->get_one_post($_GET['id']);
    
    if(!$ROW)
    {
        $ERROR = "No such post was found";
    }else
    {
        if($ROW['studentid'] != $_SESSION['taruc_studentid']){
            $ERROR = "Access denied ! you cant delete this file !"; 
        }
    }
}else
{
    $ERROR = "No such post was found";
}

//if something was posted
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    
    
   $Post->delete_post($_POST['postid']);

     
    
     echo "<script type='text/javascript'>alert('Successfully deleted'); ";
    // echo "window.location= '$_SESSION[return_to]'";
     echo "window.location= '$_SESSION[return_to]'";
     echo"</script> ";
 
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Delete post</title>
    </head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-red.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
    <style type="text/css">
        #blue_bar{
            height: 50px;
            background-color: blanchedalmond;
           
        }
        #search_box{
            width:400px;
            height: 20px;
            border-radius: 5px;
            border: none;
            padding: 4px;
            font-size: 14px;
            background-image: url(/image/search.jpg);
            background-repeat: no-repeat;
            background-position: right;
        }
        
        #profile_pic{
            width: 150px;
            margin-top: -200px;
            border-radius: 50%;
            border:solid 2px white;
            
        }
        #menu_buttons{
            width: 100px;
            display: inline-block;
            margin: 2px;
            color: green;
        }
        #textarea{
            width: 100%;
            border: none;
            font-family: tahoma;
            font-size: 14px;
        }
        #post_button{
            float: right;
            background-color: #aaa;
            border: none;
            color: white;
            padding: 4px;
            font-size: 14px;
            border-radius: 2px;
            width: 50px;
        }
        #post_bar{
            margin-top: 20px;
            background-color: white;
            padding: 10px;
            border:solid thin #aaa;
        }
        #post{
            padding: 4px;
            font-size: 13px;
            display: flex;
        }
        </style>
        
      
    <body style="font-family: tahoma;">
       
        <?php
        include "header.php";
        ?>
        
         
        <!-- cover area -->
        <div style="width:800px; margin: auto; background-color: black; min-height: 400px;">
            
           
            
            
           <!-- below cover area--> 
            <div style="display: flex;">
                
               
                    
                <!-- posting area-->
                <div style="background-color:white; min-height: 400px; flex:2.5; padding: 20px; padding-right: 0px;">
                <div style="border:solid thin #aaa; padding:10px;">
                    
                   
                      
                        <h2>Delete Post</h2><br>
                        
                        
                        
                        <form method="post">
                     
                        
                        <?php 
                        if($ERROR != "")
                        {
                             echo $ERROR;
                        }
                            
                        else
                        {
                    
                            
                        
                            echo "   Do you want to delete this post ?<br><br><br> ";
                        
                            $user = new User();
                        
                            $ROW_USER = $user->get_user($ROW['studentid']);     
                        
                            $image_class = new Image();
                        
                            include "post_delete.php";
                            
                             
                            echo "<input type='hidden' name='postid' value='$ROW[postid]'>";
                            echo "<input id='post_button' type='submit' value='Delete'>";
                        }
                        
                        ?>
                       
                            <br>  
                        </form>
                    
                </div>
                    
               
                    
                    
                    
                    
                </div>
                
            </div>
            
        </div>
        
     </body>         
            
 
</html>
