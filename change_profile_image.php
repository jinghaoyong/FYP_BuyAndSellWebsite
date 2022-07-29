
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
include("classes/autofiltering.php");


   
$login = new Login();
$user_data = $login->check_login($_SESSION['taruc_studentid']);

 $USER = $user_data;
    

//posting start here
if($_SERVER['REQUEST_METHOD'] == "POST")
 {
     
    
    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
    {
     
      
      if($_FILES['file']['type'] == "image/jpeg")
      {
          $allowed_size = (1024 * 1024) * 7;
          if($_FILES['file']['size'] < $allowed_size)
          {
              //everything is good
              
                    $folder = "uploads/" . $user_data['studentid'] . "/";
                    
                    //create folder
                    if(!file_exists($folder))
                    {
                        mkdir($folder,0777,true);
                    }
                    
                    $image = new Image();
                    
                    $filename = $folder . $image->generate_filename(15) . ".jpg";
                    move_uploaded_file($_FILES['file']['tmp_name'],$filename);
    
                    
                    
                      $change = "profile";
                 
                     //check for mode
                      if(isset($_GET['change']))
                         {
                          $change = $_GET['change'];
                      }
                    
                    
                  
                   
                   if($change == "cover")
                   {
                       if(file_exists($user_data['cover_image']))
                       {
                           unlink($user_data['cover_image']);
                       }
                       $image->resize_image($filename, $filename, 1500, 1500);
                       
                   }else{
                       if(file_exists($user_data['profile_image']))
                       {
                           unlink($user_data['profile_image']);
                       }
                       $image->resize_image($filename, $filename, 1500, 1500);
                   
                   }
                   
              if(file_exists($filename)){
         
                 $studentid = $user_data['studentid']; 
                 
                 if($change == "cover")
                 {
                      $query = "update users set cover_image = '$filename' where studentid = '$studentid' limit 1";
                 }else
                 {
                      $query = "update users set profile_image = '$filename' where studentid = '$studentid' limit 1";
                 }
                 
                
                
        
                 $DB = new Database();
                 $DB->save($query);
        
                 header(("Location: profile.php"));
               die;
             }
    
          }else
          {
            // echo"<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
            // echo "The following errors occured : <br><br>";
            // echo "only 3MB or lower size images are accepted and allowed ! "; 
             //echo"</div>";  
             
             echo "<script type='text/javascript'>alert('only 3MB or lower size images are accepted and allowed !'); ";
             
             echo "</script> ";
             
          }
          
      }else
      {
       // echo"<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
       // echo "The following errors occured : <br><br>";
       // echo "only images of <Jpeg> type are accepted and allowed ! "; 
        //echo"</div>";
        
        echo "<script type='text/javascript'>alert('only images of <Jpeg> type are accepted and allowed !'); ";
             
        echo "</script> ";
      }
      
   
    }else
    {
        //echo"<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
        //echo "The following errors occured : <br><br>";
      //  echo "Please add a valid image"; 
        //echo"</div>";
        
        echo "<script type='text/javascript'>alert('Please add a valid image !'); ";
             
        echo "</script> ";
    }
    
 }



     
 
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
        <div style="width:800px; margin: auto; background-color: none; min-height: 400px;">
            
            
           <!-- below cover area--> 
            <div style="display: flex;">
                
               
                    
                <!-- posting area-->
                <div style="background-color:white; min-height: 400px; flex:2.5; padding: 20px; padding-right: 0px;">
                    <br><br><br><br><br><br><br>
                    Change your 
                    <?php
                    
                    if(isset($_GET['change']))
                         {
                          echo $_GET['change'];
                      }
                    ?> here
                    <form method="post" enctype="multipart/form-data">
                    <div style="border:solid thin #aaa; padding:10px; background-color: white">
                    
                    <input type="file" name="file">
                    
                    <input id="post_button" type="submit" value="Change">
                    <br>  
                    
                    <div style="text-align: center;">
                    <?php 
                    
                     
                 
                     //check for mode
                      if(isset($_GET['change']) && $_GET['change'] == "cover" )
                      {
                          $change = "cover";
                          
                          echo "<img src='$user_data[cover_image]' style='max-width:500px;'>"  ;
                               
                      }else
                      {
                          echo "<img src='$user_data[profile_image]' style='max-width:500px;'>"  ;
                      }
                    

               
                            
                            
                            
                    ?>
                    </div>
                    
                    </div>
                    
                   </form>   
                 <!-- posts--> 
                
                    
                       
                    
                    
                </div>
                
            </div>
            
        </div>
        
     </body>         
            
 
</html>
