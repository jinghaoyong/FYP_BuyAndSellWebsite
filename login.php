<?php 






include("classes/connect.php");
include("classes/login.php");


$email = "";
$password = "";


 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
    $login = new Login();
    
   
        
        
    $result =  $login ->evaluate($_POST);
    
    
    if($result != ""){
        
        echo "<script type='text/javascript'>alert('$result');</script>";
        //echo"<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
        //echo "The following errors occured : <br><br>";
       // echo $result; 
       // echo"</div>";
    }else{
        $email = $_POST['email'];
        $password = $_POST['password'];
        header("Location: security_question.php?id=$email");
        die;
        
    }
    
    //$email = $_POST['email'];
   // $password = $_POST['password'];
   
   
    
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>TAR UC Login Page</title>
    </head>
    

    <style>
        #bar{
            height:200px;
            background-color: #dca7a7;
            font-size: 40px;
            padding: 10px;
            text-align: center;
        }
        #bar2{
            background-color: white;
            width: 800px; 
            height: 350px;
            margin: auto;
            padding: 10px;
            padding-top: 50px;
            text-align: center;
            font-weight: bold;
        }
        #text{
            height: 40px;
            width: 300px;
            border-radius: 4px;
            border:solid 1px #aaa;
            padding: 4px;
            font-size: 14px;
           
        }
        #button{
            width: 300px;
            height: 40px;
            border-radius: 4px;
            font-weight: bold;
            border: none;
            background-color: rfb(59,89,152);
            
        }
        
    </style>
    
    <body style="font-family: tahoma; background-color: #e9ebee; background-image: url( image/tarclogo.jpeg); background-size:  cover; background-repeat: no-repeat   " >
        
        <div id="bar" style="text-align:center; font-size: 80px; font-family:Roboto;font-weight:300;">          
            <div  >Welcome to TAR UC Buy and Sell Website</div>     
        </div>
        
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
        
        <div id="bar2">
            
            <form method="post">
                Log in to TAR UC Buy and Sell Website<br><br>
                
                <input name="email" value="<?php echo $email?>" type="text" id="text" placeholder="Email" required=""><br><br>
                <input name="password" value="<?php echo $password?>" type="password" id="text" placeholder="Password" required=""><br><br>
               
                <input type="submit" id="button" value="Log in"><br><br>
                <a style="text-decoration: none; color: #2e6da4 " href="forgotpassword.php">Forgot Password</a><br><br>
                <a style="text-decoration: none; color: #2e6da4 " href="signup.php">Sign up</a><br><br>
            </form>
                
        </div>
            
       
        
        <?php
       
        ?>
    </body>
</html>


