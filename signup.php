<?php 
include("classes/connect.php");
include("classes/signup.php");


$first_name = "";
$last_name = "";
$gender = "";
$email = "";
$studentid = "";


 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
    $signup = new Signup();
   
    
    $result =  $signup ->evaluate($_POST);
    
    
    //$result_duplicate = $duplicateCheck->check_duplicate_id($_POST);
   // $results_duplicate = $duplicateCheck->check_duplicate_email($_POST);
    
    //$totalresult = $result . $result_duplicate . $results_duplicate;
    
   
    
    if($result != ""){
        
       //|| $result_duplicate != "" || $results_duplicate != ""
        
         echo "<script type='text/javascript'>alert('$result');</script>"; 
         
        // if($result_duplicate != ""){
          //   echo "<script type='text/javascript'>alert('$result_duplicate');</script>"; 
        // }
         
        // if($results_duplicate != ""){
         //    echo "<script type='text/javascript'>alert('$results_duplicate');</script>"; 
       //  }
   
    }else{       
         echo "<script type='text/javascript'>alert('Successfully signed up ! lets go your email do verification and enjoy the website !'); ";
        
         echo "window.location= 'login.php' ";

         echo "</script> ";
         die;
        
    }
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $studentid = $_POST['studentid'];
   
    
}

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>TAR UC Sign Up</title>
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
            width: 1000px; 
            height: 700px;
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
    
    <body style="font-family: tahoma; background-color: #e9ebee;">
        
        <div id="bar">          
            <div style="font-size: 80px; text-align: center;">Welcome to TAR UC Buy and Sell Website</div>     
        </div>
        
        <div>
            <div id="bar2" >
                Sign up to TAR UC Buy and Sell Website<br><br>
               
                <form method="post" action="signup.php">
                    
                <input value="<?php echo$studentid ?>" name="studentid" type="text" id="text" placeholder="Student Id"><br><br>
                <input value="<?php echo$first_name ?>" name="first_name" type="text" id="text" placeholder="First Name"><br><br>
                <input value="<?php echo$last_name ?>" name="last_name" type="text" id="text" placeholder="Last Name"><br><br>
                
                <span  style="font-weight: normal;">Gender:</span><br> 
                <select id="text" name="gender">
                    <option><?php echo$gender ?></option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
                <br><br>
                <input name="password" type="password" id="text" placeholder="Password"><br><br>
                <input name="password2" type="password" id="text" placeholder="Retype Password"><br><br>
                <input value="<?php echo$email ?>" name="email" type="text" id="text" placeholder="Email address"><br><br>
               <span  style="font-weight: normal;">Security Question:</span><br> 
                <select id="text" name="security_question">         
                    <option value="pet">What was your first pet name?</option>
                    <option value="school">What high school did you attend?</option>
                    <option value="childfood">What was your favourite food as a child?</option>
                </select>
                <br><br><br>
                <input  name="security_answer" type="text" id="text" placeholder="Security Answer" required=""><br><br>
                <input  type="submit" id="button" value="Sign up"><br><br>
            
                </form>
                
            </div>
            
        </div>
        
        <?php
       
        ?>
    </body>
</html>


