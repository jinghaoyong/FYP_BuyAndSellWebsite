
<!-- comment -->
<!-- comment -->
<!-- comment -->
<!-- comment -->
<!-- comment -->
<!-- comment -->
<!-- comment -->
<!-- comment -->
<!-- comment -->
<!-- comment -->
<!-- comment -->


 
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
               echo "</a>";
        ?>    
            
            
        </h4>
        
        <br>
        <hr class="w3-clear">
        <p><?php  echo htmlspecialchars($ROW['itemdes']) ?></p>
        
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half" style="margin:0 -16px">
                
                
                <?php 
                             
                             if(file_exists($ROW['image']))
                             {
                            
                                 $post_image = $image_class->get_thumb_post($ROW['image']);
                                 
                                 echo "<img src='$post_image' style='width:60%;'/>";
                                 
                                
                            
                             
                              
                                 
                                
                             }
                             
                             
              ?>
                <br><br>
            </div>
            
        </div>
          
                            
         <?php
                             
                              echo "Price : RM" . $ROW['price'];
                              
                             
                              
                             ?>
                                                        
                             <div><?php echo "Quantity left : " . $ROW['quantity']; ?></div>
                              
                
                             
                     <span style="color:#999;float: right;">     
                          <?php
                             
                              if($ROW['has_image']){
                                 echo "<a href='image_view_marketplace.php?id=$ROW[itemid]' style='text-decoration: none; ' class='w3-button w3-theme-d1 w3-margin-bottom'>";
                                 echo "View Full Image";
                                 echo "</a>";
                             }
                             
                             
                             
                             ?>
                         

                                        
                     </span>     
                             
      </div>
<!-- comment -->












