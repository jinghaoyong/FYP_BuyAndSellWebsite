<?php 



session_start();


include("classes/connect.php");
include("classes/login.php");


if(isset($_GET['id']))
     {
         $email = $_GET['id'];
     }
     
    

 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     
     
     
    
     
     $security_question = $_POST['security_question'];
     
     $security_answer = $_POST['security_answer'];
     
     
     $DB = new Database();
     
      $query = "select * from users where email = '$email' limit 1 ";


       $DB = new Database();
        $result = $DB->read($query);

   
   
    
    if($result != ""){
        
       $correctQ =  $result[0]['security_question'];
    
       $correctA =  $result[0]['security_answer'];
       
       if($correctQ == $security_question)
       {
           if($correctA == $security_answer)
           {
               $_SESSION['taruc_studentid'] = $result[0]['studentid'];  
               
               header("Location: index.php");
           }else{
               
               echo "<script type='text/javascript'>alert('Wrong security question or answer !'); ";
               // echo "window.location= '$_SESSION[return_to]'";
               echo "window.location= 'login.php'";
               echo"</script> ";
           }
       }else{
           
           echo "<script type='text/javascript'>alert('Wrong security question or answer !'); ";
           // echo "window.location= '$_SESSION[return_to]'";
           echo "window.location= 'login.php'";
           echo"</script> ";
           
       }
        
        
        //echo "<script type='text/javascript'>alert('$result');</script>";
        //echo"<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
        //echo "The following errors occured : <br><br>";
       // echo $result; 
       // echo"</div>";
    }else{
        
        echo "<script type='text/javascript'>alert('There hava a login problem occured ! please contact technical as soon as possible !'); ";
    // echo "window.location= '$_SESSION[return_to]'";
     echo "window.location= 'login.php'";
     echo"</script> ";
       // 
        //header("Location: index.php");
        //die;
        
    }
    
    
   
   
    
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Security Question Page</title>
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
                Please answer the security question<br><br>
                
         
                <span  style="font-weight: normal;">Security Question:</span><br> 
                <select id="text" name="security_question">         
                    <option value="pet">What was your first pet name?</option>
                    <option value="school">What high school did you attend?</option>
                    <option value="childfood">What was your favourite food as a child?</option>
                </select>
                <br><br><br>
                <input  name="security_answer" type="text" id="text" placeholder="Security Answer"><br><br>
                <input type="submit" id="button" value="Log in"><br><br>
                <a style="text-decoration: none; color: #2e6da4 " href="forgotanswer.php?id=<?php echo $email ?>">Forgot Question Or Answer</a><br><br>

            </form>
                
        </div>
            
       
        
        <?php
       
        ?>
    </body>
</html>


