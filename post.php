
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
        
        <span class="w3-right w3-opacity">
            <?php 
                                 
                                 $time = new Time();
                                 $date =$time->get_time($ROW['date']);
                                 
                                 echo $date;
            ?>
        </span>
        
        <h4>
        <?php 
               echo"<a href='profile.php?id=$ROW[studentid]' style='text-decoration: none;' >";
               echo htmlspecialchars($ROW_USER['first_name']) . " " . htmlspecialchars($ROW_USER['last_name']);
               echo "</a>";
        ?>    
            
            
        </h4>
        
        <br>
        <hr class="w3-clear">
        <p><?php  echo htmlspecialchars($ROW['post']) ?></p>
        
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
                
                
                
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
        <span style="color:#999;float: left;">  
                              <?php  
                             
                             $likes  = "";
                             
                             $likes = ($ROW['likes'] > 0) ? "(".$ROW['likes'].")" : "";
                             /*if($ROW['likes']>0)
                             {
                                 $likes = $ROW['likes'];
                             }else{
                                 $likes = "";
                             }*/
                             
                             ?>
                             
                         <a href="like.php?type=post&id=<?php echo $ROW['postid'] ?>" class="w3-button w3-theme-d1 w3-margin-bottom" > <i class="fa fa-thumbs-up"></i>Like<?php echo $likes; ?></a> 
        
        
        
        
        
       
        
        
                             <?php
                             $comments = "";
                             
                             if($ROW['comments'] > 0){
                                 
                                 $comments = "(" . $ROW['comments']. ")";
                             }
                             ?>
                             <a href="single_post.php?id=<?php echo $ROW['postid']?>" class="w3-button w3-theme-d2 w3-margin-bottom" >Comment<?php echo $comments  ?></a> 
                         </span>    
                            
        
                             
                     <span style="color:#999;float: right;">     
                          <?php
                             
                              if($ROW['has_image']){
                                 echo "<a href='image_view.php?id=$ROW[postid]' style='text-decoration: none; ' class='w3-button w3-theme-d1 w3-margin-bottom'>";
                                 echo "View Full Image";
                                 echo "</a>";
                             }
                             
                             
                             
                             ?>
                         
                 <?php
                                 
                                
                                 
                                 $post = new post();
                                 if($post->i_own_post($ROW['postid'], $_SESSION['taruc_studentid'])){
                                 echo "
                                 <a href='edit.php?id=$ROW[postid]' class='w3-button w3-theme-d2 w3-margin-bottom'  >
                                     Edit
                                 </a>  
                                  
                                 <a href='delete.php?id=$ROW[postid]' class='w3-button w3-theme-d2 w3-margin-bottom' >
                                   Delete
                                 </a>
                                 ";}
                  ?>            
                             
                     </span>     
                             
      </div>
<!-- comment -->












