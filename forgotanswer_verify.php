<?php 

include("classes/connect.php");
include("classes/login.php");

if(isset($_GET['id']))
{
    $email = $_GET['id'];
}



 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     
         
  
         $ootp = $_POST['otp'];
         
         $question = $_POST['security_question'];
         $answer = $_POST['security_answer'];
         
         
         
      
             
            
                 // lets set the setting no nid enter email    
             
             
           $query = "select * from users where email = '$email' limit 1 ";
           $DB = new Database();
           $result = $DB->read($query);
        
           if($result){
               
            if($result[0]['otp_for_answer'] == $ootp){
            
                
         
                 
                    
                    
            
                  
                $DB = new Database();
              
        $query = "UPDATE users SET security_question='$question'  WHERE email ='$email' ";
        $DB ->save($query);
        
        $query = "UPDATE users SET security_answer='$answer'  WHERE email ='$email' ";
        $DB ->save($query);
     
        $tem = "";
        $query = "Update users set otp_for_answer = '$tem'";
        $DB->save($query);
   
    
         
         echo "<script type='text/javascript'>alert('Successfully changed the answer ! please select correct question according to the question you picked just now during login section !'); ";
       echo "window.location= 'login.php' ";
         echo "</script> ";
        die;    
                
             
            
                
            }else{
                echo "<script type='text/javascript'>alert('Wrong otp, pls enter again !'); ";
                echo "window.location= 'forgotanswer_verify.php?id=$email' ";
         echo "</script> ";
        die;    
            }
               
            
            
               
           }else{
            echo "<script type='text/javascript'>alert('The email does not existed, pls login again !'); ";
            echo "window.location= 'login.php' ";
            echo "</script> ";
            die;
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
                Change the security question & answer<br><br>
                
               
                
                  <select id="text" name="security_question">         
                    <option value="pet">What was your first pet name?</option>
                    <option value="school">What high school did you attend?</option>
                    <option value="childfood">What was your favourite food as a child?</option>
                </select>
                <br><br><br>
                <input  name="security_answer" type="text" id="text" placeholder="Security Answer" required=""><br><br>
                <input name="otp"  type="text" id="text" placeholder="Otp"><br><br>
                <input type="submit" id="button" value="Go"><br><br>
                
            </form>
                
        </div>
            
       
        
        <?php
       
        ?>
    </body>
</html>


