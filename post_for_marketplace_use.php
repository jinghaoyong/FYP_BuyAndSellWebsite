 
      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                      <?php
                             
                             $image = "image/user_male.jpeg";
                             if($ROW_USER['gender'] == "Female")
                             {
                                 $image = "image/user_female.jpeg";
                             }
                         
                              if(file_exists($ROW_USER['profile_image']))
                               {
                                 $image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
                               }
                    
                      ?>
          <a href="profile.php?id=<?php  echo $ROW_USER['studentid'];  ?>"> <img src="<?php echo $image ?>" class="w3-left w3-circle w3-margin-right" style="width:60px"></a>
        
     
        
        <h4>
        <?php 
               echo"<a href='profile.php?id=$ROW[sellerid]' style='text-decoration: none;' >";
               echo htmlspecialchars($ROW_USER['first_name']) . " " . htmlspecialchars($ROW_USER['last_name']);
               echo "<div style='float: right;'> $ROW[specification] </div>";
               echo "</a>";
        ?>    
            
            
        </h4>
        
        <br>
        <hr class="w3-clear">
        <p><?php  echo htmlspecialchars($ROW['itemdes']);  ?></p>
        
        
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
                
                
                
              <?php 
                             
                             if(file_exists($ROW['image']))
                             {
                            
                                 $item_image = $image_class->get_thumb_post($ROW['image']);
                                 
                                 echo "<img src='$item_image' style='width:60%;'/>";
                                 
                                
                            
                             
                              
                                 
                                
                             }
                             
                             
              ?>
                <br><br>
            </div>
            
        </div>
       
            
                             <div>
                              <?php
                             
                              echo "Unit price : RM" . $ROW['price'];
                              
                             
                              
                              ?></div>
                                                        
                             <div><?php echo "Quantity left : " . $ROW['quantity']; ?></div>
                             
                             
                             
                             
                             <?php
                                 
                                
                                 
                                 
                                 if($items->no_own_item($ROW['itemid'], $_SESSION['taruc_studentid'])){
                                 echo "
                                 
                                  <a href='otpbeforebuy.php?id=$ROW[itemid]' class='w3-button w3-theme-d2 w3-margin-bottom' style='float: right;'>Buy</a>

                                 ";}
                                 
                                 
                          ?>                
                             
                            
                             <span style="float: left;">
                          
                             <?php
                             
                              if($ROW['has_image']){
                                 echo "<a href='image_view_marketplace.php?id=$ROW[itemid]'   class='w3-button w3-theme-d1 w3-margin-bottom'>";
                                 echo "View Full Image";
                                 echo "</a>";
                             }
                             
                             
                             
                             ?>
                             </span>
                             
                              <span style="float: right;">     
                             <?php
                                 
                                
                                 
                                 $items = new item();
                                 if($items->i_own_item($ROW['itemid'], $_SESSION['taruc_studentid'])){
                                 echo "
                               
                                 <a href='edit_for_market.php?id=$ROW[itemid]' class='w3-button w3-theme-d2 w3-margin-bottom' >
                                     Edit
                                 </a>
                             
                               
                             
                                 <a href='delete_for_market.php?id=$ROW[itemid]' class='w3-button w3-theme-d2 w3-margin-bottom' >
                                   Delete
                                 </a>
                            
                                 ";}
                          ?>  
                             
                             </span>
                             
                             
      </div>
<!-- comment -->


