


<div  class="w3-container w3-card w3-white w3-round w3-margin">
                         <div>
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
                             
                         </div> 
                         <div>
                             <span class="w3-right w3-opacity">
                                <?php 
                                 
                                 $time = new Time();
                                 $date =$time->get_time($COMMENT['date']);
                                 
                                 echo $date;
                                ?>
                             </span>
                             
                             <h4>
                                 
                                 <?php 
                                 echo"<a href='profile.php?id=$COMMENT[studentid]'  style='text-decoration: none;'>";
                                 echo htmlspecialchars($ROW_USER['first_name']) . " " . htmlspecialchars($ROW_USER['last_name']);
                                 echo "</a>";
                                 ?>
                                 
                             </h4>
                             
                              <hr class="w3-clear">
                            <p><?php  echo htmlspecialchars($COMMENT['post']) ?></p>
                            
                             
                             <br><br>  
                             
                              <div class="w3-row-padding" style="margin:0 -16px">
                             <div class="w3-half">
                
                
            
                
            
            
                             <?php 
                             
                             if(file_exists($COMMENT['image']))
                             {
                            
                                 $post_image = $image_class->get_thumb_post($COMMENT['image']);
                                 
                                 echo "<img src='$post_image' style='width:60%;'/>";
                                 
                             }
                         
                                     
                             ?>
                             </div>
                              </div>
                             <br/><br/>
                             <?php  
                             
                             $likes  = "";
                             
                             $likes = ($COMMENT['likes'] > 0) ? "(".$COMMENT['likes'].")" : "";
                             /*if($COMMENT['likes']>0)
                             {
                                 $likes = $COMMENT['likes'];
                             }else{
                                 $likes = "";
                             }*/
                             
                             ?>
                             
                             <a href="like.php?type=post&id=<?php echo $COMMENT['postid'] ?>" class="w3-button w3-theme-d1 w3-margin-bottom" style="float: left;">Like<?php echo $likes; ?></a> 
                             
                             <?php
                             if($COMMENT['parent'] == 0){
                                 echo "<a href='single_post.php?id= echo $COMMENT[postid]' class='w3-button w3-theme-d1 w3-margin-bottom'>Comment</a> ";
                             }
                             
                             
                             ?>
                         
                           
                           
                                 
                             <?php 
                             if($COMMENT['has_image']){
                                 echo "<a href='image_view.php?id=$COMMENT[postid]' style='text-decoration: none;' class='w3-button w3-theme-d1 w3-margin-bottom'>";
                                 echo "View Full Image";
                                 echo "</a>";
                             }
                             
                             ?>
                             
                             <span style="color:#999;float: right;">
                                 
                                 <?php
                                 $post = new post();
                                 if($post->i_own_post($COMMENT['postid'], $_SESSION['taruc_studentid'])){
                                 echo "
                                 <a href='edit.php?id=$COMMENT[postid]' class='w3-button w3-theme-d1 w3-margin-bottom' >
                                     Edit
                                 </a>  
                                 
                                 <a href='delete.php?id=$COMMENT[postid]' class='w3-button w3-theme-d1 w3-margin-bottom' >
                                   Delete
                                 </a>
                                 ";}
                                     ?>
                                 
                                 
                             </span>
                             
                             
                         </div> 
</div> 

<!-- comment -->





<!-- comment -->
