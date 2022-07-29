<?php 

include("classes/connect.php");
include("classes/login.php");


if(isset($_GET['id'])){
    $email = $_GET['id'];
}


 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
      
       
         
         if($email != null){
             
             
             
           $query = "select * from users where email = '$email' limit 1 ";
           $DB = new Database();
           $result = $DB->read($query);
        
           if($result){
            
            $otp = rand(10,1000000);   
            
             $query = "update users set otp_for_answer = '$otp'  where email = '$email' limit 1";
            
            $result = $DB->save($query);
            
            
            
               
            $to = $email;
            
            $subject = "Forgot Security Answer";
            $message = "<a href='http://localhost/FypWxJh/forgotanswer_verify.php?id=$email'>Forgot Security Question Or Answer</a> Your otp number is : $otp , Please use the otp to proceed the further process.";
            $headers = "From: jinghao0958@gmail.com \r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8". "\r\n";
            
            mail($to,$subject,$message,$headers);
            
            
            echo "<script type='text/javascript'>alert('We have sent the link to your email ($email), please click the link on there to proceed the further process!'); ";
            echo "window.location= 'login.php' ";
            echo "</script> ";
            die;
               
               
               
           }else{
            echo "<script type='text/javascript'>alert('The email does not existed, pls login again !'); ";
            echo "window.location= 'login.php' ";
            echo "</script> ";
            die;
           }
           
            

         }else{
           
       
            echo "<script type='text/javascript'>alert('Pls login again to verifiy !'); ";
            echo "window.location= 'login.php' ";
            echo "</script> ";
            
         
           
         }
        
        
  
         
     
        
         
   
   
    
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
        <title>Forgot Security Answer</title>
    </head>
    

    <style>
        #bar{
            height:200px;
            background-color: #de1b1b;
            font-size: 40px;
            padding: 10px;
            text-align: center;
        }
        #bar2{
            background-color: white;
            width: 800px; 
            height: 200px;
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
       
        
        <div id="bar2" >
            
            <form method="post">
             
                Click the link below to change the security question or answer <br><br>
               
               
                <input type="submit" id="button" value="Click here"><br><br>
                
            </form>
                
        </div>
            
       
        
        <?php
       
        ?>
    </body>
</html>


