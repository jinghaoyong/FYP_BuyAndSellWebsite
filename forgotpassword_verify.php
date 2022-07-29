<?php 

include("classes/connect.php");
include("classes/login.php");





 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     if(isset($_POST['email']))
     {
         
         $email = $_POST['email'];
         $ootp = $_POST['otp'];
         
         if($email != null){
             
             
             
           $query = "select * from users where email = '$email' limit 1 ";
           $DB = new Database();
           $result = $DB->read($query);
        
           if($result){
               
            if($result[0]['otp'] == $ootp){
            
                
          $password1 = $_POST['password'];
       
         if(!preg_match("/(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password1)){
                 
                 
     echo "<script type='text/javascript'>alert('Need a stronger password! (8 length, with upper/lowercase, a number and a special character)\\n'); ";
    // echo "window.location= '$_SESSION[return_to]'";
     echo "window.location= 'forgotpassword_verify.php'";
     echo"</script> ";
     
                 
                    
                    
            }else{ 
                  $password = hash("sha1",$_POST['password']);
                $DB = new Database();
        $query = "UPDATE users SET password='$password' WHERE email ='$_POST[email]' ";
        $DB ->save($query);
     
        $tem = "";
        $query = "Update users set otp = '$tem'";
        $DB->save($query);
   
    
         
         echo "<script type='text/javascript'>alert('Successfully changed password !'); ";
       echo "window.location= 'login.php' ";
         echo "</script> ";
        die;    
                
            }     
            
                
            }else{
                echo "<script type='text/javascript'>alert('Wrong otp, pls enter again !'); ";
                echo "window.location= 'forgotpassword_verify.php' ";
         echo "</script> ";
        die;    
            }
               
            
            
               
           }else{
            echo "<script type='text/javascript'>alert('The email does not existed, pls enter again !'); ";
            echo "window.location= 'forgotpassword_verify.php' ";
            echo "</script> ";
            die;
           }
           
            

         }else{
           
       
            echo "<script type='text/javascript'>alert('Pls enter your email to verifiy !'); ";
            echo "window.location= 'forgotpassword_verify.php' ";
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
                Change the password<br><br>
                
                <input name="email"  type="text" id="text" placeholder="Email"><br><br>
                <input name="otp"  type="text" id="text" placeholder="Otp"><br><br>
                <input name="password"  type="password" id="text" placeholder="New password"><br><br>
                <input type="submit" id="button" value="Go"><br><br>
                
            </form>
                
        </div>
            
       
        
        <?php
       
        ?>
    </body>
</html>


