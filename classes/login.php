<?php



class Login
{
    private $error = "";
    
    public function evaluate($data)
    {
        
        $email = addslashes($data['email']);
        
        
        $password = addslashes($data['password']);

        $query = "select * from users where email = '$email' limit 1 ";
        
                
        $DB = new Database();
        $result = $DB->read($query);
        
        if($result)
        { 
            $row = $result[0];
            
                if($this->hash_text($password) == $row['password']){
                
                    $_SESSION['taruc_studentid'] = $row['studentid'];
                    
                    $verified = $result[0]['verified'];
        
            if($verified == 1){
            
            
           ///// 
           if($result)
           { 
            $row = $result[0];
            
                if($this->hash_text($password) == $row['password']){
                
                      //$_SESSION['taruc_studentid'] = $row['studentid'];
                
                
                       }else 
                      {
                          $this->error .= "Wrong email or password";    
                        }
                
                      }else
                      {
                          $this->error .= "Wrong email or password";       
                      }
            
            
                 }else{
                       $this->error .= "This account not yet been verified. An email was sent to $email ";
                 }
                 ////
                
                
                }else 
                {
                    $this->error .= "Wrong email or password"; 
                    
                }
            
        }else
        {
            
              $this->error .= "Wrong email or password"; 
              
        }
        
        
        

        
         return $this->error;  
         
    }
 
    
    private function hash_text($text)
    {
        $text = hash("sha1",$text);
        
        return $text;
    }
    
    public function check_login($id){
        
    
        
        if(is_numeric($id)){

            $query = "select * from users where studentid = '$id' limit 1 ";


            $DB = new Database();
            $result = $DB->read($query);

            if($result)
            { 
                $user_data  = $result[0];
                return $user_data;
            }else{
             header("Location: login.php");
             die;
            }

            

                // check if user login
             $id = $_SESSION['taruc_studentid'];
             

              $result = $login->check_login($id);


           

            

             

        }
        else{
        header("Location: login.php");
        die;
        }
 
    }
    
}

?>

