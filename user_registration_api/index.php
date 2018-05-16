<?php
    
    require_once 'user.php';
    
    $First_name = "";
    
    $Email = "";
    
    $Gender = "";

 $Languages = "";

 $Gender = "";

 $Dob = "";

  $password  = "";




    
    if(isset($_POST['First_name'])){
        
        $First_name = $_POST['First_name'];
        
    }
   if(isset($_POST['Email'])){
        
        $Email = $_POST['Email'];
        
    }
 if(isset($_POST['Gender'])){
        
        $Gender = $_POST['Gender'];
        
    }

if(isset($_POST['Languages'])){
        
        $Languages = $_POST['Languages'];
        
    }

    if(isset($_POST['Dob'])){
        
        $Dob = $_POST['Dob'];
        
    }



    
    if(isset($_POST['password'])){
        
        $password = $_POST['password'];
        
    }
    
 
    
    $userObject = new User();
    
    // Registration
    
    if(!empty($First_name) && !empty($Email) && !empty($Gender) && !empty($Languages)  && !empty($Dob)  && !empty($password)){
        
        $hashed_password = md5($password);
        
        $json_registration = $userObject->createNewRegisterUser($First_name, ($Email, $Gender, $Languages, $Dob, $hashed_password);
        
        echo json_encode($json_registration);
        
    }
    
    // Login
    
    if(!empty($Email) && !empty($password) && empty($Email)){
        
        $hashed_password = md5($password);
        
        $json_array = $userObject->loginUsers($Email, $hashed_password);
        
        echo json_encode($json_array);
    }
    ?>