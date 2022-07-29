<?php

class report 

{
    private $error = "";
    
    public function create_report($seller,$buyer,$amount,$sellerid,$buyerid,$itemid,$itemdes,$specification)
    {
        if(!empty($itemid))
        {
            
            
            
            
            
            
            $itemdes = addslashes($itemdes);
            $reportid = $this->create_reportid();
            
            $DB = new Database();
            
            // you can do something changes if let say got extra point or what
           // if(isset($data['parent']) && is_numeric($data['parent'])){
               // $parent = $data['parent'];
                
             //   $sql = "update posts set comments  = comments + 1 where postid = '$parent' limit 1";
             //   $DB->save($sql);
                
          //  }
            $query = "insert into report (reportid,seller,buyer,amount,sellerid,buyerid,itemid,itemdes,specification) values ('$reportid','$seller','$buyer','$amount','$sellerid','$buyerid','$itemid','$itemdes','$specification')";
            
           
            $DB->save($query);
                
            return $reportid;
            
        }else
        {
            $this->error .= "something wrong, pls contact technical as soon as possible";
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
    
    
    public function get_report($id)
    {
        //here to select either want display all the postings or not
        $query = "select * from report where reportid = '$id'";
            
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
    
    
    
    public function get_report_bybuyername($name)
    {
        //here to select either want display all the postings or not
        $query = "select * from report where buyer = '$name'";
            
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
    
     public function get_report_bysellername($name)
    {
        //here to select either want display all the postings or not
        $query = "select * from report where seller = '$name'";
            
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
    
    public function get_report_by_date_buyer($name,$date)
    {
        $query = "select * from report where buyer='$name' and  date ='$date'";
        
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
    
     public function get_report_by_date_seller($name,$date)
    {
        $query = "select * from report where seller='$name' and date ='$date'";
        
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
    
    private function create_reportid(){
        
        $length = rand(4,19);
        $number = "";
        for ($i=0;$i<$length;$i++){
            
            $new_rand = rand(0,9);
            
            $number  = $number . $new_rand;
        }
        return $number;
    }
    
}

