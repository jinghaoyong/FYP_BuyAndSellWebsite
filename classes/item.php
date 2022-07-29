<?php

class item

{
    private $error = "";
    
    public function create_item($sellerid,$data,$files)
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
               
                
                         $folder = "uploads/" . $sellerid . "/";
                    
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
                    echo "window.location= 'marketplace.php'";
                    echo "</script> ";
                    die;
                }
                
            }else{
                
            
            echo "<script type='text/javascript'>alert('only images of <Jpeg> type are accepted and allowed !'); ";
            echo "window.location= 'marketplace.php'";
            echo "</script> ";
            die;
            die;
                
            }  
              
              
              
          }  
            
            
            
           
            
            
            $post = addslashes($data['post']);
            $itemid = $this->create_itemid();
            
            $itemname = $data['itemtitle'];
            $specification = $data['option'];
            $price = $data['price'];
            $quantity = $data['quantity'];
            
            
            //echo $post;
            //echo $itemid;
            //echo $itemname;
          //  echo $specification;
          //  echo $price;
          //  echo $quantity;
          //  echo $sellerid;
         //   echo $myimage;
         //   echo $has_image;
           
        //    die;
            
           
            $DB = new Database();
            
            $query = "insert into itemsell (sellerid,itemid,itemdes,itemname,price,image,has_image,specification,quantity) values ('$sellerid','$itemid','$post','$itemname','$price','$myimage','$has_image','$specification','$quantity')";
            
           
            $result = $DB->save($query);
           
            
                
            
        }else
        {
            $this->error .= "pls type something to post!<br>";
        }
        return $this->error;
    }
    
    public function edit_item($userid,$data,$files)
    {
        
        //$userid = seller id
        if(!empty($data['itemdes']) || !empty($files['file']['name']))
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
            
            $itemdes ="";
            if(isset($data['itemdes'])){
               $itemdes = addslashes($data['itemdes']);  
            }
            
             if(isset($data['itemname'])){
               $itemname = ($data['itemname']);  
            }
            
             if(isset($data['price'])){
               $price = ($data['price']);  
            }
            
             if(isset($data['option'])){
               $specification = ($data['option']);  
            }
            
             if(isset($data['quantity'])){
               $quantity = ($data['quantity']);  
            }
            
            if(isset($data['itemid'])){
               $itemid = ($data['itemid']);  
            }
            
            
             
            
            
            if($has_image)
            {
                $query = "update itemsell set itemdes = '$itemdes' , itemname = '$itemname' , price = '$price', specification = '$specification', quantity = '$quantity' , image = '$myimage'  where itemid ='$itemid' limit 1";
            }else
            {
                 $query = "update itemsell set itemdes = '$itemdes' , itemname = '$itemname' , price = '$price', specification = '$specification', quantity = '$quantity' where itemid ='$itemid' limit 1";
            }
            
           
            
            $DB = new Database();
            $DB->save($query);
                
            
        }else
        {
            $this->error .= "pls type something to post!<br>";
        }
        return $this->error;
    }
    
    
    public function get_items($id)
    {
        //here to select either want display all the postings or not
        $query = "select * from itemsell where sellerid = '$id' ";
            
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
    
    public function get_filteritems($filtername){
        
        $query = "select * from itemsell where specification = '$filtername' ";
            
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
    
    
    public function get_one_item($id)
    {
        if(!is_numeric($id))
        {
            
                 return false;
        }
        
        
        $query = "select * from itemsell where itemid = '$id' limit 1 ";
            
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
    
    public function delete_item()
    {
        
        
        $DB = new Database();
        
        $zero = 0;
           
        $query = "delete from itemsell where quantity = '$zero'";
        $DB->save($query);
    
      
        
    
    }
    
     public function delete_for_marketpost($itemid)
    {
        if(!is_numeric($itemid))
        {
                return false;
        }
        
        $DB = new Database();
            
        
         
                
      
      
        
         
         
        $query = "delete from itemsell where itemid = '$itemid'";
        $DB->save($query);
        
        $query = "delete from notification where postid = '$itemid'";
        $DB->save($query);
     
      
    }

   public function i_own_item($itemid,$taruc_studentid)
    {
        if(!is_numeric($itemid))
        {
                return false;
        }
        
        
        $query = "select * from itemsell where itemid = '$itemid' limit 1 ";
            
        $DB = new Database();
        $result = $DB->read($query);
        
        if(is_array($result))
        {
         
            if($result[0]['sellerid'] == $taruc_studentid){
                return true;
            }
        }
        return false;
      
    }
    
    public function no_own_item($itemid,$taruc_studentid)
    {
        if(!is_numeric($itemid))
        {
                return false;
        }
        
        
        $query = "select * from itemsell where itemid = '$itemid' limit 1 ";
            
        $DB = new Database();
        $result = $DB->read($query);
        
        if(is_array($result))
        {
         
            if($result[0]['sellerid'] == $taruc_studentid){
                return false;
            }
        }
        return true;
      
    }
    
  
    
     public function get_allitems($limit,$offset)
    {
         
       
        //here to select either want display all the postings or not
        //$query = "select * from itemsell where ORDER BY id DESC limit $limit offset $offset";
         
         $query = "select * from itemsell ORDER BY id DESC limit $limit offset $offset";
            
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
    
    private function create_itemid(){
        
        $length = rand(4,19);
        $number = "";
        for ($i=0;$i<$length;$i++){
            
            $new_rand = rand(0,9);
            
            $number  = $number . $new_rand;
        }
        return $number;
    }
    
}

