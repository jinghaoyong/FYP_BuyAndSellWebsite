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
 
 if($_SERVER['REQUEST_METHOD'] == "POST")
 {
     $post = new Post();
     $id = $_SESSION['taruc_studentid'];
     $result = $post->create_post($id, $_POST,$_FILES);
     
     if($result == "")
     {
         header("Location: index.php");
         die;
     }else{
         
        echo"<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
        echo "The following errors occured : <br><br>";
        echo $result; 
        echo"</div>";
     }
     
 }
 
// collect posts
     $post = new Post();
     $id = $_SESSION['taruc_studentid'];
     
     
    // $page_number = 1;
    // if(isset($_GET['page'])){
    //     $page_number = (int)$_GET['page'];
   //  }
     
     $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
     $page_number = ($page_number < 1) ? 1 : $page_number;
     
     //if($page_number < 1){
      //   $page_number = 1;
   //  }
     
     
     $limit = 8;
     $offset = ($page_number - 1) * $limit;
     
     
     $posts = $post->get_allposts($limit, $offset);
     
     
     
     
     
     
     
     $image_class = new Image();
     
     $USER = $user_data;
 
?>

<!DOCTYPE html>
<html>
<title>TAR UC Buy and Sell website</title>
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
        <a  href="topup.php?id=<?php echo $_SESSION['taruc_studentid']; ?>" class="w3-bar-item w3-button">Top up T-wallet</a>
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
        /*  // not yet complte here to loop
        $DB = new Database();
        $query = "Select * from notification where studentid=$_SESSION[taruc_studentid]";
        $result = $DB->read($query);
        $num_rows = mysql_num_rows($result);
        
       echo $num_rows;
       die;
        
        
        
        for ($x = 0; $x <= $num_rows; $x++) {
            echo $result[$x]['postid'];
        }
        die;
          */
         
        ?>
        <a href="report_post.php?id=<?php 
        
            $DB = new Database();
            
            $query = "Select * from notification where studentid=$_SESSION[taruc_studentid]";
            $result = $DB->read($query);
            
            if($result == ""){
                
            }else{
            echo $result[0]['postid'];
            }
        
        
        ?>" class="w3-bar-item w3-button">
            
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
         
            
            <a href="index.php" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>Buying and Sharing</a>
          
        </div>      
      </div>
      <br><!-- comment -->
      
      
      <div class="w3-card w3-round">
        <div class="w3-white">
         
            
            <a href="marketplace.php" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>Market Place</a>
          
        </div>      
      </div>
      <br>
      <div class="w3-card w3-round">
        <div class="w3-white">
         
            <a href="infocontent.php" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i>Updates and Guidelines</a>
          
          
        </div>      
      </div>
      <br>
      <div class="w3-card w3-round">
        <div class="w3-white">
         
            <a href="profile.php" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Profile</a>
          
          
        </div>      
      </div>
      <br>
      
      
      
      <!-- Interests --> 
      
      
      <!-- Alert Box -->
      <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
          <i class="fa fa-remove"></i>
        </span>
        <p><strong>What's up</strong></p>
        <p>Welcome to Updates and Guidelines !</p>
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
              
                <h2>Latest Update</h2>
                <h3><u>22 November 2021</u></h3>
                <h4>Cash Out</h4>
                <p>User could cash out their amount inside the T-wallet into their bank account.</p>
                
                <br>
                
                <h3><u>19 November 2021</u></h3>
                <h4>Report Generator</h4>
                <p>The report generator is the transaction history which allow the user to check their buy and sell transaction. All the records will recorded down and show to them.</p>
                
                <br>
                
                <h3><u>18 November 2021</u></h3>
                <h4>Market Place with secured payment gateway</h4>
                <p>User could buy any products they interested by using the T-wallet. It is required an One Time Password before they proceed to the payment.</p>
      
                <h4>Top up features</h4>
                <p>User required top up the credit into their account before doing any purchase. T-wallet is acting as a currency to allow our user to use it to do the payment.</p>
                

                <br>
                
                <h3><u>16 November 2021</u></h3>
                <h4>Market Place with proper functions</h4>
                <p>With various categories such as stationary, furniture, used event clothes. User could even put in the description to describe their products.</p>
                

                <br>
                
                <h3><u>14 November 2021</u></h3>
                <h4>OTP features added</h4>      
                <p>One time password has been added into our forgot password to ensure the person who request to make the password changes is the authorized user.</p>
              
               
              
              
            </div>
              
              
              
      
          </div>
        </div>
      </div>
        <br>
        
         <!-- Second Post -->
        <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              
                <h2>User Guidelines</h2>  
              
                <h4><a href="dailytransaction.php?id=<?php
        
        $name = $_SESSION['taruc_studentid'];
         $profile = new Profile();
        
       
         
         $profile_name = $profile->get_profile($name);
         
     
           $profile_all_name = $profile_name[0]['first_name'] . $profile_name[0]['last_name'];
         
         
        
        echo $profile_all_name;
        
        
        
        ?>">Report Generator</a></h4>
                <p>User could check their transaction history by using the filter function to display specific date to them.</p>
                
                <br>
                
                <h4><a href=marketplace.php>Market Place</a></h4>
                <p>A place that allow user to sell their products which including image, description, product name and price.</p>
                
                <br>
                
                <h4><a href=infocontent.php>Announcement</a></h4>
                <p>Every latest update and announcement regarding this website will be posted in here.</p>
                
                <br>
                
                <h4><a href=index.php>Buying and Sharing</a></h4>
                <p>User could post what they interested and what they wanted to buy in this particular section.</p>
                
                <br>
                
                <h4><a href=profile.php>User Profile</a></h4>    
                <p>Allow user to change their profile picture and cover image.</p>
                
                <br>
                
                <h4><a href=topup.php>T-wallet</a></h4>       
                <p>This is the place where user could check and top up their T-wallet in order to make any successful payment.</p>
                
                <br>
                
                <h4><a href=reset_password.php>Change Password</a></h4> 
                <p>Allow user to reset their password. Old password is required and should be matched before they proceed to the success password changes.</p>
               
              
              
            </div>
              
              
              
      
          </div>
        </div>
      </div>       
         <br>
         <!-- Third -->
<!--         <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              
                <h2>Third</h2>  
              
              
                       
              
              
               
              
              
            </div>
              
              
              
      
          </div>
        </div>
      </div>
         <br>-->
    <!-- End Middle Column -->
    </div>
    
 
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>You & Me</p>

          <p><strong>Responsible To This Website Environment</strong></p>
          <p>Be gentle and kind before you buy or post anything :)</p>
          <p>Thanks</p>
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

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16" style="text-align: center; " >
  <p>
       TAR UC Buy And Sell Website<br/>
	By NgWeiXuan and YongJingHao 
 </p>
</footer>

</body>
</html>