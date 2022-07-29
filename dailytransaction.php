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


    $buyerid = $_SESSION['taruc_studentid'];
    
    

    if (is_numeric($buyerid)) {
      $profile = new Profile();

        $profile_data = $profile->get_profile($buyerid);



       if(is_array($profile_data)){

             $user_data  = $profile_data[0] ; 
       }
    }




  
  if(isset($_GET['id'])){
      
 
   $name = $_GET['id'];
   
  }
 
  $report = new report();
  
  $result_getreport = $report->get_report_bybuyername($name);
  $result_getreports = $report->get_report_bysellername($name);
  //echo $result_getreport[0]['reportid'];
  //echo $result_getreport[0]['seller'];
  //
  
  
  
  
  //$buyername = $result_getreport[0]['buyer'];
  
  
  
 // $DB = new Database();
  
 // $query = "select * from report where buyer = '$buyername' ";
            
 // $result = $DB->read($query);
  
  //$query = "select * from report where seller = '$buyername' ";
            
 // $results = $DB->read($query);


  
                     


?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Payment transaction</title>
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
        .styled-table {
            text-align: center;
         
    border-collapse: collapse;
 
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 10px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;  
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
    
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}

        </style>
        
      
    <body style="font-family: tahoma;">
       
        <?php
        include "header.php";
        ?>
        
        
         
        <!-- cover area -->
        <div style="width:1500px; margin: auto; background-color: black; min-height: 400px;">
            <div style="background-color: white; text-align: center; color: #405d9b; ">
                
                
           <!-- below cover area--> 
            <div style="display: flex;">
                
                   
                    
                <!-- posting area-->
                <div style="background-color:white; min-height: 400px; flex:2.5; padding: 20px; padding-right: 0px;">
               <div style="border:solid thin #aaa; padding:10px;">
                 
                    
               
                 <!-- posts -->   
                 <div>
                    
                 </div>
                     
               </div>
              
                     <div style="border:solid thin #aaa; padding:10px;"  style="text-align : center;">
                         
                    <div>   
                    <p> Filter by date: </p>
            
                    <form action="dailytransaction_filter.php" method="get">

                    <input type="date" id="date" name="date">
                    <input type="hidden" id="name" name="name" value="<?php 
  
                    if(isset($_GET['id'])){
      
 
                    $name = $_GET['id'];
   
                }
                echo $name;?>">
                <input type="submit" value="filter">
                </form>

                    
                    
                      <h2> Transaction of Buying</h2>
                      <?php
                      if($result_getreport)
                     {
                           
                         echo "
                             <table class='styled-table'><thead>
  <tr>
    <th>Buyer</th>
    <th>Seller</th>
    <th>Amount Pay</th>
  <th>Date</th>
  <th>Item Description</th>
  <th>Category</th>
  </tr>";
               
                         foreach ($result_getreport as $ROW) {
                             
                            
                             
                             echo "
                             
                            
    
  </thead>
  <tbody>
  <tr class='active-row'>
    <td> $ROW[buyer] </td>
        <td>  $ROW[seller] </td>
    <td>RM $ROW[amount] </td>
          <td> $ROW[date] </td>
          <td> $ROW[itemdes] </td>
              <td> $ROW[specification] </td>
  </tr>
  </tbody>";
                         }
                         
                         
echo"</table>";
                         
                     }
                     
                     
                     
                      
                      
                      
                      ?>
                        
                        <h2>Transaction of Selling</h2>
                      <?php
                      if($result_getreports)
                     {
                           
                         echo "
                             <table class='styled-table'><thead>
  <tr>
    <th>Seller</th>
    <th>Buyer</th>
    <th>Amount Pay</th>
  <th>Date</th>
  <th>Item Description</th>
    <th>Category</th>
  </tr></thead>";
               
                         foreach ($result_getreports as $ROW) {
                             
                            
                             
                             echo "
                             
                            
    
  
  <tbody>
  <tr class='active-row'>
   <td>  $ROW[seller] </td>
    <td> $ROW[buyer] </td>
    <td>RM $ROW[amount] </td>
          <td> $ROW[date] </td>
          <td> $ROW[itemdes] </td>
              <td> $ROW[specification] </td>
  </tr>
  </tbody>";
                         }
                         echo "</table>";
                         
                     }
                     
                     
                     
                      
                      
                      
                      ?>
                        
                        
                        
                        
                        
                        
  
                    </div>
                         
                    
                </div>
                    
                    <a href="index.php" class="w3-button w3-theme-d2 w3-margin-bottom">Return to homepage</a> 
                    
            </div>
                
              
                
<!--                <div class="w3-col m2" style="width : 500px;">
      <div class="w3-card w3-round w3-white w3-center">
        <div  class="w3-container">
            <br><br><br>
            <p> Filter by date: </p>
            
            <form action="dailytransaction_filter.php" method="get">

  <input type="date" id="date" name="date">
  <input type="hidden" id="name" name="name" value="<?php 
  
  if(isset($_GET['id'])){
      
 
   $name = $_GET['id'];
   
  }
  echo $name;?>">
  <input type="submit" value="filter">
</form>


           
            
        </div>
      </div>
      <br>
      
 
      
      
      
      
     End Right Column 
    </div>-->
            
        </div>
           
        </div>
            
            
        </div>
        
     </body>         
            
 
</html>

