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
    

 isset($_SESSION['taruc_studentid']);
 //for posting start...
 $USER = $user_data;
 
 if($_SERVER['REQUEST_METHOD'] == "POST")
 {
      
         
     $amount = $_POST['topupamount'];
     
     $studentid = $_SESSION['taruc_studentid'];
     

     
    
     
    $DB = new Database();
    
     $profile = new Profile();
     
     $topupuser = $profile->get_profile($studentid);
     
     $walletamount =  $topupuser[0]['Twallet'];
     
   
     
     $topup = $walletamount + $amount;
     
     
    
     $query = "update users set Twallet = '$topup' where studentid ='$studentid' limit 1";
     $DB->save($query);
     
     
               echo "<script type='text/javascript'>alert('Your balance successfully top up ! enjoy our marketplace !'); ";
                // echo "window.location= '$_SESSION[return_to]'";
                 echo "window.location= 'pending_to_buy_item.php'";
                 echo"</script> ";
                 
 }
     
 
 

    
 
?>

<!DOCTYPE html>
<html>
<title>Top up page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-red.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>HomePage</a>
  <div class="w3-dropdown-hover w3-hide-small">
    <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-user"></i></button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">

      <a  href="change_profile_image.php?change=profile" class="w3-bar-item w3-button">Change profile image</a> 
        <a  href="change_profile_image.php?change=cover" class="w3-bar-item w3-button">Change cover</a>
        <a  href="reset_password.php?id=<?php echo $_SESSION['taruc_studentid']; ?>" class="w3-bar-item w3-button">Change password</a>
        <a  href="topup.php?id=<?php echo $_SESSION['taruc_studentid']; ?>" class="w3-bar-item w3-button">T-wallet</a>
        <a  href="dailytransaction.php?id=<?php
        
        $name = $_SESSION['taruc_studentid'];
         $profile = new Profile();
        
       
         
         $profile_name = $profile->get_profile($name);
         
     
           $profile_all_name = $profile_name[0]['first_name'] . $profile_name[0]['last_name'];
         
         
        
        echo $profile_all_name;
        
        
        
        ?>" class="w3-bar-item w3-button">Transaction history</a>
        <a  href="pending_to_buy_item.php" class="w3-bar-item w3-button">Interested to buy</a>
    </div>
  </div>
  <div class="w3-dropdown-hover w3-hide-small">
    <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i></button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
        
       
            
            <?php
            $DB = new Database();
            
            $query = "Select * from notification where studentid=$_SESSION[taruc_studentid]";
            $result = $DB->read($query);
            
           if($result == ""){
                
            }else{
            echo $result[0]['contents'];
            }
            
            
            ?>
        </a>
      
    </div>
  </div>
  
  
    
    <?php
            $corner_image = "image/user_male.jpeg";
            if(isset($USER))
            {
                 if(file_exists($USER['profile_image'])){
                  $corner_image = $USER['profile_image'];
            }else
            {
               if($USER['gender'] == "Female")
                {
                  $corner_image = "image/user_female.jpeg";
                }
            }
            
            }
    
    
    ?>
    
    <?php
                $image ="";
                if(file_exists($user_data['profile_image']))
                {
                    $image = $user_data['profile_image'];
                }
                
                ?>
  
     <a href="profile.php"><img src="<?php echo $corner_image ?>" style="width: 50px; float: right;"></a>
     <a href="logout.php" class="w3-bar-item w3-button" style="float: right;">Logout</a>
    
    
  
 </div>
</div>

<!-- Navbar on small screens (not sure this one is using for smartphone or not )


<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>

-->


<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
         
            <a href="profile.php" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Profile</a>
          
          
        </div>      
      </div>
      <br>
      <div class="w3-card w3-round">
        <div class="w3-white">
         
            
            <a href="marketplace.php" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> Market Place</a>
          
        </div>      
      </div>
      <br>
      
      <!-- Interests --> 
      
      
      <!-- Alert Box -->
      <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
          <i class="fa fa-remove"></i>
        </span>
        <p><strong>Hey !</strong></p>
        <p>Hi welcome to TAR UC Buy and Sell Website !</p>
        <p>Enjoy it !</p>
      </div>
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
    
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              
                <br>
              Your current balance : <?php 
              
                  $profile = new Profile();
                  
              
               $topupuser = $profile->get_profile($_SESSION['taruc_studentid']);
     
     $walletamount =  $topupuser[0]['Twallet'];
     
     
     echo  $walletamount;
              
              ?>
              
              (T-wallet)
              
              <br><br><br>     
              
              
               <form method="post"  class="w3-opacity">
                   
                    <input type="number"  min="1" step="any"  name="topupamount" id="topupamount" required="required" placeholder="Top up amount">  <br><br>  
                 
                    <label for="paymentmethod">Choose a payment method:</label>

<select name="methods" id="methods">
  <option value="Credit Card">Credit Card</option>
  <option value="Debit Card">Debit Card</option>
  <option value="Online banking">Online banking</option>
  <option value="Touch n go e-wallet">Touch n go e-wallet</option>
</select>
                    <input class="w3-button w3-theme" type="submit" value="Top up" style="cursor: pointer; float: right;">
                    <br>  
                    
                    <br>
                     
               </form>
              <br><br><br>
              
                
            </div>
          </div>
        </div>
      </div>
    
                  
        <br>  
                     
                    <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              
              
             
              
             
              
              
              <br><br>
              
                Do you want to cash out ? Click here <a href="cashout.php" class="w3-button w3-theme-d1 w3-margin-bottom">Cash Out</a>  
              <br><br><br>
              
                
            </div>
          </div>
        </div>
      </div>
                    <br>
     
 
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>ATTENTION</p>
          
          <p><strong>Please protect your sensitive data</strong></p>
          <p>Do not simply let other people know your password</p>
          <p><button class="w3-button w3-block w3-theme-l4">Thank you</button></p>
        </div>
      </div>
      <br>
      
    
  
      
      <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
        <p>ADS</p>
      </div>
      
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>







 
<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html> 
