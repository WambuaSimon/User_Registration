<?php
    
    include_once 'db-connect.php';
    
    class User{
        
        private $db;
        
        private $db_table = "users";
        
        public function __construct(){
            $this->db = new DbConnect();
        }
        
        public function isLoginExist($Email, $password){
            
            $query = "select * from ".$this->db_table." where Email = '$Email' AND password = '$password' Limit 1";
            
            $result = mysqli_query($this->db->getDb(), $query);
            
            if(mysqli_num_rows($result) > 0){
                
                mysqli_close($this->db->getDb());
                
                
                return true;
                
            }
            
            mysqli_close($this->db->getDb());
            
            return false;
            
        }
        
        public function isEmailUsernameExist($First_name, $Email){
            
            $query = "select * from ".$this->db_table." where First_name = '$First_name' AND Email = '$Email'";
            
            $result = mysqli_query($this->db->getDb(), $query);
            
            if(mysqli_num_rows($result) > 0){
                
                mysqli_close($this->db->getDb());
                
                return true;
                
            }
               
            return false;
            
        }
        
        public function isValidEmail($Email){
            return filter_var($Email, FILTER_VALIDATE_EMAIL) !== false;
        }
        
        public function createNewRegisterUser($First_name, $password, $Email, $Gender, $Languages, $Dob){
              
            $isExisting = $this->isEmailUsernameExist($Email);
            
            if($isExisting){
                
                $json['success'] = 0;
                $json['message'] = "Error in registering. Probably the email already exists";
            }
            
            else{
                
            $isValid = $this->isValidEmail($Email);
                
                if($isValid)
                {
                $query = "insert into ".$this->db_table." (First_name, Email, Gender, Languages, Dob, password) values ('$First_name', '$Email', '$Gender', '$Languages', '$Dob', '$password')";
                
                $inserted = mysqli_query($this->db->getDb(), $query);
                
                if($inserted == 1){
                    
                    $json['success'] = 1;
                    $json['message'] = "Successfully registered the user";
                    
                }else{
                    
                    $json['success'] = 0;
                    $json['message'] = "Error in registering. Probably the email already exists";
                    
                }
                
                mysqli_close($this->db->getDb());
                }
                else{
                    $json['success'] = 0;
                    $json['message'] = "Error in registering. Email Address is not valid";
                }
                
            }
            
            return $json;
            
        }
        
        public function loginUsers($Email, $password){
            
            $json = array();
            
            $canUserLogin = $this->isLoginExist($Email, $password);
            
            if($canUserLogin){
                
                $json['success'] = 1;
                $json['message'] = "Successfully logged in";
                
            }else{
                $json['success'] = 0;
                $json['message'] = "Incorrect details";
            }
            return $json;
        }
    }
    ?>