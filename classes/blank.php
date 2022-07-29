<?php 

class Signup{
    
    private $error = "";
    
    public function evaluate($data){
        
        foreach($data as $key => $value){
            
            if(empty($value)){
                $this->error = $this->error . $key . " is empty! \\n";
                
            }
            
            
            
            if($key == "password"){
                
                if(!preg_match("/(?=^.{8,}$)(?=.\d)(?=.[!@#$%^&]+)(?![.\n])(?=.[A-Z])(?=.[a-z]).$/", $value)){
                    $this->error = $this->error . "Need a stronger password! (8 length, with upper/lowercase, a number and a special character)\\n";
                }
            }
            
            if($key == "email"){
                
                if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value)){
                    $this->error = $this->error . "invalid email address!";
                }
                
            }
            
            if($key == "first_name"){
                
                if(is_numeric($value)){
                    $this->error = $this->error . "first name cant be a number!";
                }
                
                if(strstr($value, " ")){
                    $this->error = $this->error . "first name cant have spaces!";
                }
                
                
            }
            
            if($key == "last_name"){
                
                if(is_numeric($value)){
                    $this->error = $this->error . "last name cant be a number!";
                }
                
                if(strstr($value, " ")){
                    $this->error = $this->error . "last name cant have spaces!";
                }
                
            }
            
            
        }
        if ($data['password'] !== $data['password2']) {
            $this->error = $this->error . ('\\nPassword and Confirm password should match!');   
            }
        
        if($this->error == ""){
             
            // no error and create user here
            $this->create_user($data);
            
            //generate key 
            
            
            
        }else{
            return $this->error;
        }
    }
    
    public function create_user($data){
        
        $first_name = ucfirst($data['first_name']);
        $last_name = ucfirst($data['last_name']);
        $gender = $data['gender'];
        $email = $data['email'];
        $password = $data['password'];
        $studentid = $data['studentid'];
        
        $password = hash("sha1",$password);
        
        //create these
        $url_address = strtolower($first_name). "." . strtolower($last_name);
        
        $vkey = md5(time().$data['studentid']);
            
        
        $query = "insert into users (studentid,first_name,last_name,gender,email,password,url_address,vkey) values ('$studentid','$first_name','$last_name','$gender','$email','$password','$url_address','$vkey')";
        
        
        
        $DB = new Database();
        
        $insert = $DB ->save($query);
        
         if($insert){
            
            $to = $email;
            $subject = "Email verification";
            $message = "<a href='http://localhost/FypWxJh/verify.php?vkey=$vkey'>Account Verification</a>";
            $headers = "From: jinghao0958@gmail.com \r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8". "\r\n";
            
            mail($to,$subject,$message,$headers);
            
            
        }else
        {
           echo "Error to verify email"; 
        }
        
        
        
    }
    
    
    /*private function create_userid(){
        
        $length = rand(4,19);
        $number = "";
        for ($i=0;$i<$length;$i++){
            
            $new_rand = rand(0,9);
            
            $number  = $number . $new_rand;
        }
        return $number;
    }
  */  
}