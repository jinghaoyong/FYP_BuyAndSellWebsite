<?php

class post 

{
    private $error = "";
    
    public function create_post($userid,$data,$files)
    {
        
        if(!empty($data['post']) || !empty($files['file']['name']))
        {
            
            $myimage   = "";
            $has_image =  0;
            
           
          if($files['file']['type'] == ""){
              
              
              
              
          }else{
              
            if($files['file']['type'] == "image/jpeg")
            {
                
                
                 $allowed_size = (1024 * 1024) * 7;
                 if($files['file']['size'] < $allowed_size)
                {
            
            
                     if(!empty($files['file']['name']))
                     {
               
                
                         $folder = "uploads/" . $userid . "/";
                    
                            //create folder
                         if(!file_exists($folder))
                         {
                           mkdir($folder,0777,true);
                           file_put_contents($folder. "index.php", "");
                         }
                    
                        $image_class = new Image();
                    
                        $myimage = $folder . $image_class->generate_filename(15) . ".jpg";
                        move_uploaded_file($_FILES['file']['tmp_name'],$myimage);
                
                        $image_class->resize_image($myimage, $myimage, 1500, 1500);
                 
              
                        $has_image =  1;
                    }
                }else
                {
                    
                    
                    echo "<script type='text/javascript'>alert('only 3MB or lower size images are accepted and allowed !'); ";
                    echo "window.location= 'index.php'";
                    echo "</script> ";
                    die;
                }
                
            }else{
                
            
            echo "<script type='text/javascript'>alert('only images of <Jpeg> type are accepted and allowed !'); ";
            echo "window.location= 'index.php'";
            echo "</script> ";
            die;
            die;
                
            }  
              
              
              
          }  
            
            
            
            
            
            
            $post = addslashes($data['post']);
            
            //filter here 
            $filter = new autofiltering();
            
            $result_filter = $filter->filter_badwords_bycontent($post);
            
            
            
            
            $postid = $this->create_postid();
            $parent = 0;
            $DB = new Database();
            
            if(isset($data['parent']) && is_numeric($data['parent'])){
                $parent = $data['parent'];
                
                $sql = "update posts set comments  = comments + 1 where postid = '$parent' limit 1";
                $DB->save($sql);
                
            }
            $query = "insert into posts (studentid,postid,post,image,has_image,parent) values ('$userid','$postid','$result_filter','$myimage','$has_image','$parent')";
            
           
            $DB->save($query);
                
            
        }else
        {
            $this->error .= "pls type something to post!<br>";
        }
        return $this->error;
    }
    
    public function edit_post($userid,$data,$files)
    {
        if(!empty($data['post']) || !empty($files['file']['name']))
        {
            
            $myimage   = "";
            $has_image =  0;
            
            if(!empty($files['file']['name']))
            {
               $image_class = new Image();
                
                $folder = "uploads/" . $userid . "/";
                    
              
                    
                
                    
                 $myimage = $folder . $image_class->generate_filename(20) . ".jpg";
                 move_uploaded_file($_FILES['file']['tmp_name'],$myimage);
                
                 $image_class->resize_image($myimage, $myimage, 1500, 1500);
                 
              
                $has_image =  1;
            }
            
            $post ="";
            if(isset($data['post'])){
               $post = addslashes($data['post']);  
            }
            
           
            $postid = addslashes($data['postid']);
            
            if($has_image)
            {
                $query = "update posts set post = '$post' , image = '$myimage'  where postid ='$postid' limit 1";
            }else
            {
                 $query = "update posts set post = '$post' where postid ='$postid' limit 1";
            }
            
           
            
            $DB = new Database();
            $DB->save($query);
                
            
        }else
        {
            $this->error .= "pls type something to post!<br>";
        }
        return $this->error;
    }
    
    
    public function get_posts($id)
    {
        //here to select either want display all the postings or not
        $query = "select * from posts where parent = 0 and studentid = '$id' ORDER BY id desc ";
            
        $DB = new Database();
        $result = $DB->read($query);
        
        if($result)
        {
            return $result;
        }else
        {
            return false;
        }
        
    }
    
    public function get_comments($id)
    {
        //here to select either want display all the postings or not
        $query = "select * from posts where parent = '$id'";
            
        $DB = new Database();
        $result = $DB->read($query);
        
        if($result)
        {
            return $result;
        }else
        {
            return false;
        }
        
    }
    
    
    public function get_one_post($postid)
    {
        if(!is_numeric($postid))
        {
            
                 return false;
        }
        
        
        $query = "select * from posts where postid = '$postid' limit 1 ";
            
        $DB = new Database();
        $result = $DB->read($query);
        
        if($result)
        {
            return $result[0];
        }else
        {
            return false;
        }
        
    }
    
    public function delete_post($postid)
    {
        if(!is_numeric($postid))
        {
                return false;
        }
        
        $DB = new Database();
            
        $sql = "select parent from posts where postid = '$postid' limit 1";
        $result = $DB->read($sql);
         
                
        if(is_array($result))
        {
           
              if($result[0]['parent'] > 0){
                  
                 
             
                  
                $parent = $result[0]['parent'];
                
               
                
                $sql = "update posts set comments  = comments - 1 where postid = '$parent' limit 1";            
                $DB->save($sql);
                
                
                
                }
        }
      
        
         
         
        $query = "delete from posts where postid = '$postid'";
        $DB->save($query);
        
        $query = "delete from notification where postid = '$postid'";
        $DB->save($query);
     
      
    }

   public function i_own_post($postid,$taruc_studentid)
    {
        if(!is_numeric($postid))
        {
                return false;
        }
        
        
        $query = "select * from posts where postid = '$postid' limit 1 ";
            
        $DB = new Database();
        $result = $DB->read($query);
        
        if(is_array($result))
        {
         
            if($result[0]['studentid'] == $taruc_studentid){
                return true;
            }
        }
        return false;
      
    }
    
  
    
     public function get_allposts($limit,$offset)
    {
         
       
        //here to select either want display all the postings or not
        $query = "select * from posts where parent = 0 ORDER BY id DESC limit $limit offset $offset";
            
        $DB = new Database();
        $result = $DB->read($query);
        
        if($result)
        {
            return $result;
        }else
        {
            return false;
        }
        
    }
    
    public function like_post($id,$type,$taruc_studentid)
    {
        
        if($type == "post"){
  
            $DB = new Database();

             
             //save likes detail
             $sql = "select likes from likes where type='post' && contentid ='$id' limit 1";
             $result = $DB->read($sql);
             
            
             if(is_array($result))
             {
                
                 $likes = json_decode($result[0]['likes'], true);              
                 $user_ids = array_column($likes, "studentid");
               
                 if(!in_array($taruc_studentid,$user_ids))
                 {
                       
                     $arr["studentid"] = $taruc_studentid;
                     $arr["date"] = date("Y-m-d H:i:s");
                 
                     $likes[] = $arr;
                     
                     $likes_string = json_encode($likes);
                     $sql = "update likes set likes  = '$likes_string' where type='post' && contentid ='$id' limit 1 ";
                     $DB->save($sql);  
                     
                     //increment the posts table
                     $sql = "update posts set likes  = likes +1 where postid ='$id' limit 1";     
                     $DB->save($sql);
                                 
                 }else
                 {
                     $key = array_search($taruc_studentid, $user_ids);
                     unset($likes[$key]);
                     
                     $likes_string = json_encode($likes);
                     $sql = "update likes set likes  = '$likes_string' where type='post' && contentid ='$id' limit 1 ";
                     $DB->save($sql);  
                     
                     //increment the posts table
                     $sql = "update posts set likes  = likes -1 where postid ='$id' limit 1";     
                     $DB->save($sql);
                 }
              
             }else
             {

                 $arr["studentid"] = $taruc_studentid;
                 $arr["date"] = date("Y-m-d H:i:s");
                 
                 $arr2[] = $arr;
                 
                 $likes = json_encode($arr2);
             
                 $sql = "insert into likes (type, contentid, likes) values ('$type', '$id', '$likes')";
                 $result = $DB->save($sql);
                            
                 
                 //increment the posts table
                 $sql = "update posts set likes  = likes +1 where postid ='$id' limit 1";     
                 $DB->save($sql);
                 
             }
        }
       
    }
    
    private function create_postid(){
        
        $length = rand(4,19);
        $number = "";
        for ($i=0;$i<$length;$i++){
            
            $new_rand = rand(0,9);
            
            $number  = $number . $new_rand;
        }
        return $number;
    }
    
}

