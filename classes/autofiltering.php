<?php

class autofiltering{
    
    public function filter_badwords_bycontent($post){
        
        $DB = new Database();
        
        
         
   
        $original = array("damn","fuck","asshole","piss off","dick","bitch");
        $replacements = array("****","****","*******","**** ***","****","*****");
        $content = str_ireplace($original, $replacements, $post);
       
        
        
        return $content;
     
    }   
    
    public function filter_badwords($postid,$studentid){
        
        $DB = new Database();
        
        $query = "select * from posts where postid = $postid limit 1";        
        $result = $DB->read($query);
        
        
         $content = $result[0]['post'];
         $post_studentid = $result[0]['studentid'];
         
         
   
        $original = array("damn","fuck","asshole","piss off","dick","bitch","lanjiao","cb","jibai","sohai","鸡白","pukima","babi","hamlan","pussy");
        $replacements = array("****","****","*******","**** ***","****","*****","*******","**","*****","*****","**","******","****","******","*****");
        $content = str_ireplace($original, $replacements, $content);
       
        
        
        $query = "UPDATE posts SET post='$content' WHERE postid ='$postid' limit 1 ";
        $DB->save($query);
        
        $updateContent = "Your post ($content) has been reported as included bad words  !";
        
       
        $type = "badwords_report";
        
        //report the post and +1 , now need to do unset
        $this->report_post($postid, $studentid,$updateContent,$post_studentid,$type);
        
      // $query = "update posts set reports  = reports +1  where postid ='$postid' limit 1";
     //  $DB->save($query);
        
        
     
    }   
    
    public function filter_advertisement($postid,$studentid){
        
        //do something here 
        $DB = new Database();
        
        $query = "select * from posts where postid = $postid limit 1";        
        $result = $DB->read($query);
        $content = $result[0]['post'];
        $post_studentid = $result[0]['studentid'];
        $type = "advertising_report";
        
        $updateContent = "Your post ($content) has been reported as annoying advertisement !";
        
        
        //report the post and +1 , now need to do unset
        $this->report_post($postid, $studentid,$updateContent,$post_studentid,$type);
        
        
        
    }
    
    public function report_post($postid,$studentid,$updateContent,$post_studentid,$type){
         
        
  
            $DB = new Database();

             
             //save likes detail
             $sql = "select reports from report_post where contentid ='$postid' limit 1";
             $result = $DB->read($sql);
             
            
             if(is_array($result))
             {
                
                 $reports = json_decode($result[0]['reports'], true);              
                 $user_ids = array_column($reports, "studentid");
               
                
                 
                 
                 if(!in_array($studentid,$user_ids))
                 {
                       
                     $arr["studentid"] = $studentid;
                     $arr["date"] = date("Y-m-d H:i:s");
                 
                     $reports[] = $arr;
                     
                     $report_string = json_encode($reports);
                     $sql = "update report_post set reports  = '$report_string' where contentid ='$postid' limit 1 ";
                     $DB->save($sql);  
                     
                     //increment the posts table
                     $sql = "update posts set reports  = reports +1 where postid ='$postid' limit 1";     
                     $DB->save($sql);
                     
                     //$sql = "update posts set $type  = $type +1 where postid ='$postid' limit 1";      
                    // $DB->save($sql);
                     if($type == "advertising_report")
                     {
                     $sql = "update posts set advertising_report  = advertising_report +1 where postid ='$postid' limit 1";     
                     $DB->save($sql);
                         
                     }else if($type == "badwords_report")
                     {
                     $sql = "update posts set badwords_report  = badwords_report +1 where postid ='$postid' limit 1";     
                     $DB->save($sql);
                     }
                     
                     
                     
        
                     $query = "insert into notification (studentid,postid,contents) values ('$post_studentid','$postid','$updateContent')";
                     $DB->save($query);
                                 
                 }else
                 {
                      echo "<script type='text/javascript'>alert('You have reported last time ! We will take action as soon as posibble !'); ";
                         // echo "window.location= '$_SESSION[return_to]'";
                      echo "window.location= 'report_post.php?id=$postid'";
                      echo"</script> ";
                     die;
                     
                     //$key = array_search($studentid, $user_ids);
                     //unset($reports[$key]);
                     
                    // $report_string = json_encode($reports);
                     //$sql = "update report_post set reports  = '$report_string' where contentid ='$postid' limit 1 ";
                    // $DB->save($sql);  
                     
                     //increment the posts table
                   //  $sql = "update posts set reports  = reports -1 where postid ='$postid' limit 1";     
                   //  $DB->save($sql);
                 }
              
             }else
             {

                 $arr["studentid"] = $studentid;
                 $arr["date"] = date("Y-m-d H:i:s");
                 
                 $arr2[] = $arr;
                 
                 $reports = json_encode($arr2);
             
                 $sql = "insert into report_post (contentid,reports) values ('$postid', '$reports')";
                 $result = $DB->save($sql);
                 
                 
                            
                 
                 //increment the posts table
                 $sql = "update posts set reports  = reports +1 where postid ='$postid' limit 1";     
                 $DB->save($sql);
                 
                
                 
                  if($type == "advertising_report")
                  {
                     $sql = "update posts set advertising_report  = advertising_report +1 where postid ='$postid' limit 1";     
                     $DB->save($sql);
                         
                  }else if($type == "badwords_report")
                  {
                     $sql = "update posts set badwords_report  = badwords_report +1 where postid ='$postid' limit 1";     
                     $DB->save($sql);
                  }
                 
                 
                 $query = "insert into notification (studentid,postid,contents) values ('$post_studentid','$postid','$updateContent')";
                 $DB->save($query);
                 
             }
        }
        
        
    
    
    
 

}





