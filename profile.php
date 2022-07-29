<?php 

    session_start();
    //print_r($_SESSION);
 
 
include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/image.php");
include("classes/profile.php");
include("classes/time.php");



   
$login = new Login();
$user_data = $login->check_login($_SESSION['taruc_studentid']);
    
$USER = $user_data;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $profile = new Profile();

    $profile_data = $profile->get_profile($_GET['id']);

    
   if(is_array($profile_data)){
       
         $user_data  = $profile_data[0] ; 
   }

 

}



 isset($_SESSION['taruc_studentid']);
 //for posting start...
 
 if($_SERVER['REQUEST_METHOD'] == "POST")
 {
     
     
     $post = new Post();
     $id = $_SESSION['taruc_studentid'];
     $result = $post->create_post($id, $_POST,$_FILES);
     
     if($result == "")
     {
         header("Location: profile.php");
         die;
     }else{
         
        echo"<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
        echo "The following errors occured : <br><br>";
        echo $result; 
        echo"</div>";
     }
     
 }
 
// collect posts
     $post = new Post();
     $id = $user_data['studentid'];
     
     $posts = $post->get_posts($id);
     
     $image_class = new Image();
 
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile Page</title>
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
            <div style="background-color: white; text-align: center; color: #405d9b; ">
                
               <?php
                $image = "image/cover_image.jpg";
                if(file_exists($user_data['cover_image']))
                {
                    $image = $image_class->get_thumb_cover($user_data['cover_image']);
                }
                
               ?>
            <img src="<?php echo $image ?>" style="width: 100%;">
             
            <span style="font-size:12px;">
                <?php
                $image ="image/user_male.jpeg";
                
                if($user_data['gender'] == "Female")
                {
                    $image = "image/user_female.jpeg";
                }
                
                    
                if(file_exists($user_data['profile_image']))
                {
                    $image = $image_class->get_thumb_profile($user_data['profile_image']);
                }else
                {
                    
                }
                
                ?>
                
                <img id="profile_pic" src="<?php echo $image ?>"><br/>
                
            </span>
            <br>
            <div style="font-size:30px; color: green "> <?php echo $user_data['first_name'] . " " . $user_data['last_name']   ?></div>
            <br> 
            
            </div>  
            
           <!-- below cover area--> 
            <div style="display: flex;">
                
               
                    
                <!-- posting area-->
                <div style="background-color:white; min-height: 400px; flex:2.5; padding: 20px; padding-right: 0px;">
                <div style="border:solid thin #aaa; padding:10px;">
                    
                    <form method="post" enctype="multipart/form-data" class="w3-opacity">
                        <textarea name="post" style="width:600px;height: 100px;" placeholder="Whats on your mind?" ></textarea>
                        
                        <input type="file" name="file">
                    <input class="w3-button w3-theme" id="post_button" type="submit" value="Post">
                    <br>  
                    </form>
                    
                </div>
                    
                    
                 <!-- posts -->   
                 <div id="post_bar">
                     
                     <?php
                     
                     if($posts)
                     {
                         foreach ($posts as $ROW) {
                             
                             $user = new User();
                             $ROW_USER = $user->get_user($ROW['studentid']);
                             
                             include("post.php");
                         }
                         
                     }
            
                     ?>
                     
                     
                 </div>    
                    
                    
                    
                    
                </div>
                
            </div>
            
        </div>
        
     </body>         
            
 
</html>
