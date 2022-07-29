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



if(isset($_GET['id'])){
    

$studentid = $_GET['id'];

}

   
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

 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     
     
    
     if(isset($_POST['oldpassword']))
     {
         
         $oldpassword = $_POST['oldpassword'];
         $newpassword = $_POST['newpassword'];
        
         
         if($oldpassword != null){
             //
             
             if(!preg_match("/(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $newpassword)){
                 
                 
     echo "<script type='text/javascript'>alert('Need a stronger password! (8 length, with upper/lowercase, a number and a special character)\\n'); ";
    // echo "window.location= '$_SESSION[return_to]'";
     echo "window.location= 'reset_password.php?id=$studentid'";
     
     echo"</script> ";
     
     die;
                 
                    
                    
            }
             
             
             
             //
             if($newpassword != null ){
             
           
           $textold = hash("sha1",$oldpassword);
          
          
          $textnew = hash("sha1",$newpassword);
            
             
           $query = "select * from users where studentid = '$studentid' limit 1 ";
           $DB = new Database();
           $result = $DB->read($query);
           
           
        
           if($result){
               
               
               
            if($result[0]['password'] == $textold){
            
             
      
        
        $DB = new Database();
        $query = "UPDATE users SET password='$textnew' WHERE studentid ='$studentid' limit 1 ";
        $DB ->save($query);
        
       
     
        
   
    
         
         echo "<script type='text/javascript'>alert('Successfully changed password !'); ";
       echo "window.location= 'login.php' ";
         echo "</script> ";
        die;    
                
                
            
                
            }else{
                $oldpassword = "";
             $newpassword ="";
               echo "<script type='text/javascript'>alert('Wrong old password , pls enter again !'); ";
               echo "window.location= 'reset_password.php?id=$studentid' ";
               echo "</script> ";
               die;
                
            }
               
            
            
               
           }else{
               $oldpassword = "";
             $newpassword ="";
            echo "<script type='text/javascript'>alert('The old Password wrong, pls enter again !'); ";
            echo "window.location= 'reset_password.php?id=$studentid' ";
            echo "</script> ";
            die;
           }
           
           
           
         }else{
             $oldpassword = "";
             $newpassword ="";
              echo "<script type='text/javascript'>alert('The new password is empty, pls enter again !'); ";
            echo "window.location= 'reset_password.php?id=$studentid' ";
            echo "</script> ";
            die;
                 
             }
           
         //

         }else{
           
             $oldpassword = "";
             $newpassword ="";
            echo "<script type='text/javascript'>alert('Pls enter old password !'); ";
            echo "window.location= 'reset_password.php?id=$studentid' ";
            echo "</script> ";
            
         
           
         }
        
        
        
     }
         //echo "<script type='text/javascript'>alert('You can change your password by clicking the link we have just sent, may check your email !'); ";
        // echo "window.location= 'login.php' ";
        // echo "</script> ";
       //  die;
       
         
     
        
         
   
   
    
}

?>

<!--<!-- comment

       $password = hash("sha1",$_POST['password']);
       
        
        $DB = new Database();
        $query = "UPDATE users SET password='$password' WHERE email ='$_POST[email]' ";
        $DB ->save($query);
     
   
    
         
         echo "<script type='text/javascript'>alert('Successfully changed password !'); ";
         echo "window.location= 'login.php' ";
         echo "</script> ";
         die;






-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>TAR UC Login Page</title>
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
        #bar{
            height:200px;
            background-color: blanchedalmond;
            font-size: 40px;
            padding: 10px;
            text-align: center;
        }
        #bar2{
            background-color: white;
            width: 800px; 
            height: 400px;
            margin: auto;
            padding: 10px;
            padding-top: 50px;
            text-align: center;
            font-weight: bold;
            
            
      
       
        }
        #barr2{
            
            width: 80px; 
            height: 40px;
            margin: auto;
            padding: 10px;
            padding-top: 50px;
            text-align: center;
            font-weight: bold;
            
        }
        </style>
        
    
    <body style="font-family: tahoma; background-color: #e9ebee; background-image: url( image/tarclogo.jpeg); background-size:  cover; background-repeat: no-repeat   " >
        
        <?php
        include "header.php";
        ?>
      
        <!--<!-- comment 
        style="
                 font-size: 80px;
                 text-align: center; 
                 font-family: unset; 
                 text-transform:uppercase; 
               
	color:#31708f;
	z-index:2;
	position:relative;
	line-height:90px;
	
	padding-top:100px;
	padding-bottom:100px;
	font-weight:700;
	
                 "
        
        
        
        -->
        <div id="barr2" ></div>
        
        <div id="bar2" >
            
            <form method="post">
                Change the password<br><br>
                
                <input name="oldpassword"  type="password" id="text" placeholder="Old Password"><br><br>              
                <input name="newpassword"  type="password" id="text" placeholder="New password"><br><br>
                <input type="submit" id="button" value="Reset Password"><br><br>
                
            </form>
                
            <a href="index.php">Return to homepage</a>
        </div>
        
        
            
       
        
        <?php
       
        ?>
    </body>
</html>


