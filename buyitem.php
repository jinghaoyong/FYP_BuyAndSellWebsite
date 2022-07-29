<?php 

        session_start();
        //print_r($_SESSION);

    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");
    include("classes/image.php");
    include("classes/profile.php");
    include("classes/time.php");
    include("classes/item.php");
    include("classes/report.php");



    $login = new Login();
    $user_data = $login->check_login($_SESSION['taruc_studentid']);



    $USER = $user_data;



    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
      $profile = new Profile();

        $profile_data = $profile->get_profile($_GET['id']);



       if(is_array($profile_data)){

             $user_data  = $profile_data[0] ; 
       }
    }


    if($_SERVER['REQUEST_METHOD'] == "POST")
     {
       $otpp = $_POST['otp'];
       
       $otpp_db =  $USER['otp_for_buy'];
       
       if($otpp == $otpp_db){
        
        $profile = new Profile();
        
        $items = new item();
        
        $report = new report();
        
        $ROW = $items->get_one_item($_GET['id']); 
        
        
        
         $quantity = $_POST['quantity'];
         $price = $ROW['price'];
         $total = $quantity * $price;
         $itemdes = $ROW['itemdes'];
         $buyerid = $_SESSION['taruc_studentid'];
         $sellerid = $ROW['sellerid'];
         $itemid = $_GET['id'];
         
         $itemname = $ROW['itemname'];
         
         
         $specification =  $ROW['specification'];
        
         
         $profile_seller = $profile->get_profile($sellerid);
         $profile_buyer = $profile->get_profile($buyerid);
         
         $profile_seller_name = $profile_seller[0]['first_name'] . $profile_seller[0]['last_name'];
         $profile_buyer_name = $profile_buyer[0]['first_name'] . $profile_buyer[0]['last_name'];
 
         
        
         
         
        
             $DB = new Database();
             //get buyer and seller
             
             // echo $profile_seller[0]['Twallet'];
                
           //  echo $profile_buyer[0]['Twallet'];
             
             
             
             
             //buyer t wallet cost
             $buyer_wallet = $profile_buyer[0]['Twallet'];
             
             
             
             if($buyer_wallet < $total){
                 
                 $query = "Select * from pending_to_buy where itemid ='$itemid' and buyerid ='$buyerid'";
                 $result = $DB->read($query);
                 
                 if($result)
                 {
                     echo "<script type='text/javascript'>alert('Your balance is not enough, pls top up and proceed to the payment !'); ";
                // echo "window.location= '$_SESSION[return_to]'";
                 echo "window.location= 'topup.php'";
                 echo"</script> ";
                 }else{
                 
                 
                 $query = "insert into pending_to_buy (buyerid,itemid) values ('$buyerid','$itemid')";
                 $DB->save($query);
                 
                 
                 
                 echo "<script type='text/javascript'>alert('Your balance is not enough, pls top up and proceed to the payment !'); ";
                // echo "window.location= '$_SESSION[return_to]'";
                 echo "window.location= 'topup.php'";
                 echo"</script> ";
                 }
                 
             }else{
                 
                 
                 
                 //generate report into database
                  $reportid = $report->create_report($profile_seller_name, $profile_buyer_name, $total, $sellerid, $buyerid, $itemid, $itemdes,$specification);
                  
                  
             
             $itemquantity = $ROW['quantity'];
             
             $setquantity = $itemquantity - $quantity;
             
             $buyer_wallet_cost = $buyer_wallet - $total;
             
               $query = "update users set Twallet = '$buyer_wallet_cost' where studentid ='$buyerid' limit 1";
               $DB->save($query);
             
               $query = "update itemsell set quantity = '$setquantity' where itemid ='$itemid' limit 1";
               $DB->save($query);
               
               //record down to notification database
               
               $updateContent = "Your item ($itemname) has been bought by someone ! May check your balance !";
        
               $query = "insert into notification (studentid,contents,postid) values ('$sellerid','$updateContent','$itemid')";
               $DB->save($query);
               
             }
               
             //seller t wallet increase
               $seller_wallet = $profile_seller[0]['Twallet'];
             
           
               $seller_wallet_cost = $seller_wallet + $total;
             
               $query = "update users set Twallet = '$seller_wallet_cost' where studentid ='$sellerid' limit 1";
               $DB->save($query);
               
               
               // set the otp to 0 
               $zero = "";
                $query = "update users set otp_for_buy = '$zero' where studentid ='$buyerid' limit 1";
               $DB->save($query);
             
              
             
             
         
     
        
        
        
        
        
        
        
        
         echo "<script type='text/javascript'>alert('Thank you for using TAR UC buy and sell ! \\n The item price is RM $price and the quantity ($quantity) \\n So the total amount you already pay with Twallet is $total \\n'); ";
        // echo "window.location= '$_SESSION[return_to]'";
          echo "window.location= 'marketplace.php'";
         echo"</script> ";
     
     
     
     }else{
      // set the otp to 0 if enter otp is incorrect
          $DB = new Database();
            $buyerid = $_SESSION['taruc_studentid'];
            
            
               $zeroo = "";
                $query = "update users set otp_for_buy = '$zeroo' where studentid ='$buyerid' limit 1";
               $DB->save($query);
            
      echo "<script type='text/javascript'>alert('Your otp is incorrect, please try it again !\\n'); ";
      // echo "window.location= '$_SESSION[return_to]'";
      echo "window.location= 'marketplace.php'";
      echo"</script> ";
     }
     
   }

    $items = new item();
    $ROW = false;

    $ERROR = "";


    if(isset($_GET['id'])){


        $ROW = $items->get_one_item($_GET['id']);


    }else{
        $ERROR = "No post was found !";
    }

    //echo $ERROR;
    //echo "something here ";
    //die;


?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Purchase item</title>
    </head>
       <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-red.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
    <style type="text/css">
        #blue_bar{
            height: 50px;
            background-color: blanchedalmond;
           
        }
        #search_box{
            width:400px;
            height: 20px;
            border-radius: 5px;
            border: none;
            padding: 4px;
            font-size: 14px;
            background-image: url(/image/search.jpg);
            background-repeat: no-repeat;
            background-position: right;
        }
        
        #profile_pic{
            width: 150px;
            margin-top: -200px;
            border-radius: 50%;
            border:solid 2px white;
            
        }
        #menu_buttons{
            width: 100px;
            display: inline-block;
            margin: 2px;
            color: green;
        }
        #textarea{
            width: 100%;
            border: none;
            font-family: tahoma;
            font-size: 14px;
        }
        #post_button{
            float: right;
            background-color: #aaa;
            border: none;
            color: white;
            padding: 4px;
            font-size: 14px;
            border-radius: 2px;
            width: 50px;
        }
        #post_bar{
            margin-top: 20px;
            background-color: white;
            padding: 10px;
            border:solid thin #aaa;
        }
        #post{
            padding: 4px;
            font-size: 13px;
            display: flex;
        }
        </style>
        
      
    <body style="font-family: tahoma;">
       
        <?php
        include "header.php";
        ?>
        
         
        <!-- cover area -->
        <div style="width:800px; margin: auto; background-color: black; min-height: 400px;">
            <div style="background-color: white; text-align: center; color: #405d9b; ">
                
                
           <!-- below cover area--> 
            <div style="display: flex;">
                
                   
                    
                <!-- posting area-->
                <div style="background-color:white; min-height: 400px; flex:2.5; padding: 20px; padding-right: 0px;">
               <div style="border:solid thin #aaa; padding:10px;">
                 
                    <h2>Are you sure to buy this ?</h2>
               
                 <!-- posts -->   
                 <div>
                     <?php
                     
                     $user = new User();
                     $image_class = new Image();
                     
                     
                    
                     
                     if(is_array($ROW)){
                         
                          
                         $ROW_USER = $user->get_user($ROW['sellerid']);
                             
                         include("post_marketplace.php");
                     }
                     
                     
                     
                     
                     ?>
                 </div>
                     
               </div>
              
                     <div style="border:solid thin #aaa; padding:10px;">
                         
                     
                    <form method="post">
                        How much do you want to buy :     
                        <select id="quantity" name="quantity">
                    <?php 
                    
                    $y = $ROW['quantity'];
                    
                    for ($x = 1; $x <= $y; $x++) {
                        
                     echo "<option>$x</option>";
 

                     
                    }
                   
                    
                    
                    ?>
                    </select>
                       <input name="otp"  type="text" id="text" placeholder="Otp"><br><br>
                        <input id="post_button" type="submit" value="Buy">
                    </form>
                    
                </div>
                    
                
            </div>
            
        </div>
        </div>
        </div>
        
     </body>         
            
 
</html>

