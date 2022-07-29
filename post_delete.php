
<div  id="post">
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
                             <a href="profile.php?id=<?php  echo $ROW_USER['studentid'];  ?>"> <img src="<?php echo $image ?>" style="width: 75px; margin-right:4px; "></a>
                             
                         </div> 
                         <div>
                             
                             <h4>
                                 <?php echo htmlspecialchars($ROW_USER['first_name']) . " " . htmlspecialchars($ROW_USER['last_name']); ?>
                             
                             </h4>
                             
                             
                             <?php  echo htmlspecialchars($ROW['post']) ?>
                             
                             <br><br>  
                             <?php 
                             
                             if(file_exists($ROW['image']))
                             {
                            
                                 $post_image = $image_class->get_thumb_post($ROW['image']);
                                 
                                 echo "<img src='$post_image' style='width:60%;'/>";
                                 
                             }
                         
                                     
                             ?>
                             
                             
                             
                         </div> 
</div> 
