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

<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>HomePage</a>
  <div class="w3-dropdown-hover w3-hide-small">
    <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-user"></i></button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">

       <a  href="change_profile_image.php?change=profile" class="w3-bar-item w3-button">Change profile image</a> 
        <a  href="change_profile_image.php?change=cover" class="w3-bar-item w3-button">Change cover</a>
        <a  href="reset_password.php?id=<?php echo $_SESSION['taruc_studentid']; ?>" class="w3-bar-item w3-button">Change Password</a>
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
        
            
            <?php
            
         
            $DB = new Database();
            
            $query = "Select * from notification where studentid='$_SESSION[taruc_studentid]'";
            $result = $DB->read($query);
            
           if($result == ""){
                
            }else{
                
               $size = sizeof($result);
               
               for($x = 0 ; $x < $size ; $x++ ){
                   
                   $y = $x+1;
                   
                   echo "$y)";
                    echo $result[$x]['contents'];
                    echo "<br><br>";
               }
               
           
            }
            
            
            ?>
        
      
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