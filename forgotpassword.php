<?php 

include("classes/connect.php");
include("classes/login.php");





 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     if(isset($_POST['email']))
     {
         
         $email = $_POST['email'];
         
         if($email != null){
             
             
             
           $query = "select * from users where email = '$email' limit 1 ";
           $DB = new Database();
           $result = $DB->read($query);
        
           if($result){
            
            $otp = rand(10,1000000);   
            
             $query = "update users set otp = '$otp'  where email = '$email' limit 1";
            
            $result = $DB->save($query);
            
            
            
               
            $to = $email;
            
            $subject = "Forgot password";
            $message = "<a href='http://localhost/FypWxJh/forgotpassword_verify.php'>Forgot password</a> Your otp number is : $otp";
            $headers = "From: jinghao0958@gmail.com \r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8". "\r\n";
            
            mail($to,$subject,$message,$headers);
            
            
            echo "<script type='text/javascript'>alert('We have sent the link to your email ($email), you can change your password there !'); ";
            echo "window.location= 'login.php' ";
            echo "</script> ";
            die;
               
               
               
           }else{
            echo "<script type='text/javascript'>alert('The email does not existed, pls enter again !'); ";
            echo "window.location= 'forgotpassword.php' ";
            echo "</script> ";
            die;
           }
           
            

         }else{
           
       
            echo "<script type='text/javascript'>alert('Pls enter your email to verifiy !'); ";
            echo "window.location= 'forgotpassword.php' ";
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
    

    <style>
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
                Forgot password<br><br>
                Enter your email to get OTP <br><br>
                <input name="email"  type="text" id="text" placeholder="Email"><br><br>
               
                <input type="submit" id="button" value="Go"><br><br>
                
            </form>
                
        </div>
            
       
        
        <?php
       
        ?>
    </body>
</html>


