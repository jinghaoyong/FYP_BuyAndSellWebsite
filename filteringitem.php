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
include("classes/item.php");
   
$login = new Login();
$user_data = $login->check_login($_SESSION['taruc_studentid']);
    

 isset($_SESSION['taruc_studentid']);
 
 if(isset($_GET['id'])){
    
   
    
    $getfilter = $_GET['id'];
    
    
}
    
    
 //for posting start...
 
 if($_SERVER['REQUEST_METHOD'] == "POST")
 {
     
     
     $item = new item();
     $id = $_SESSION['taruc_studentid'];
     $result = $item->create_item($id, $_POST,$_FILES);
     
     
     
     if($result == "")
     {
         header("Location: marketplace.php");
         die;
     }else{
         
        echo"<div style='text-align:center; font-size:12px; color:white; background-color:grey;'>";
        echo "The following errors occured : <br><br>";
        echo $result; 
        echo"</div>";
     }
     
 }
 
// collect posts
     $item = new item();
     $id = $_SESSION['taruc_studentid'];
     
     
    
     
     //here to delete then quantity = 0 
     $item->delete_item();
      
     $items = $item->get_filteritems($getfilter);
 
     $image_class = new Image();
     
     $USER = $user_data;
 
?>

<!DOCTYPE html>
<html>
<title>TAR UC MarketPlace</title>
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

       <a  href="change_profile_image.php?change=profile" class="w3-bar-item w3-button"> change profile image</a> 
        <a  href="change_profile_image.php?change=cover" class="w3-bar-item w3-button"> change cover</a>
        <a  href="reset_password.php?id=<?php echo $_SESSION['taruc_studentid']; ?>" class="w3-bar-item w3-button">Reset Password</a>
        <a  href="topup.php?id=<?php echo $_SESSION['taruc_studentid']; ?>" class="w3-bar-item w3-button">Top up T-wallet</a>
        <a  href="dailytransaction.php?id=<?php
        
        $name = $_SESSION['taruc_studentid'];
         $profile = new Profile();
        
       
         
         $profile_name = $profile->get_profile($name);
         
     
           $profile_all_name = $profile_name[0]['first_name'] . $profile_name[0]['last_name'];
         
         
        
        echo $profile_all_name;
        
        
        
        ?>" class="w3-bar-item w3-button">Transaction history</a>
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
        <p><strong>What's up</strong></p>
        <p>Welcome to MarketPlace !</p>
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
              
              
              
              
                       
              
              
               <form method="post" enctype="multipart/form-data" class="w3-opacity">
                   <h3><b>Sell your item here</b></h3>
                   <input type="text" placeholder="Item title" name="itemtitle"><br><br> 
                   <textarea name="post" style="width:600px;height: 100px;" placeholder="Item Description" ></textarea><br>
                  Item type : <select name="option" >
                            <option  value="roomrental">Room rental</option>
                            <option  value="stationary">Stationary</option>
                            <option  value="furniture">Furniture</option>
                            <option  value="usedeventclothes">Used Event Clothes</option>
                            <option  value="others">Others</option> 
                   </select><br><br>
                    
                    <input type="number"  min="1" step="any"  name="price" id="price" required="required" placeholder="Item Price">  <br><br>  
                    <input type="number"  min="1" step="any"  name="quantity" id="quantity" required="required" placeholder="Quantity">  <br><br>
                    Image :  <input type="file" name="file">
                    <input class="w3-button w3-theme" type="submit" value="Sell" style="cursor: pointer; float: right;">
                    <br>  
               </form>
              
              
            </div>
          </div>
        </div>
      </div>
     
                <?php
                     // this one is for post ,  can refer
             
                     if($items)
                     {
                                  
               
                         foreach ($items as $ROW) {
                             
                             
                             $user = new User();
                             $ROW_USER = $user->get_user($ROW['sellerid']);
                             
                             $items = new item(); 
                             
                            
                             
                             include("post_for_marketplace_use.php");
                             
                             //----------------------- get_allposts()
                             
                         }
                     
                     }
                   ?>
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
         <div  class="w3-container">
            
           <p> Category: </p>
            
         

                            <button class="w3-button w3-block w3-theme-l4"  value="roomrental" onclick="window.location.href='filteringitem.php?id=roomrental'">Room rental</button>
                            <button  class="w3-button w3-block w3-theme-l4" value="stationary" onclick="window.location.href='filteringitem.php?id=stationary'">Stationary</button>
                            <button  class="w3-button w3-block w3-theme-l4" value="furniture" onclick="window.location.href='filteringitem.php?id=furniture'">Furniture</button>
                            <button  class="w3-button w3-block w3-theme-l4" value="usedeventclothes" onclick="window.location.href='filteringitem.php?id=usedeventclothes'">Used Event Clothes</button>
                            <button  class="w3-button w3-block w3-theme-l4" value="others" onclick="window.location.href='filteringitem.php?id=others'">Others</button> 
                            <br>
                  
           
            
        </div>
      </div>
      <br>
      
    
  
      
      
      
      
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
