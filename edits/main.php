<?php  
 defined('BASEPATH') OR exit('No direct script access allowed');  
 class main extends CI_Controller {  

      function check_email_availibility()  
      {  
           if(!filter_var($_POST["contact"], FILTER_VALIDATE_EMAIL))  
           {  
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove" style="font-size:10000px; color:red"></span> Invalid Email</span></label>';  
           }  
           else  
           {  
                $this->load->model("main_model");  
                if($this->main_model->is_email_available($_POST["contact"]))  
                {  
                     echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"style="font-size:10000px; color:red"></span> Email Already register</label>';  
                }  
                else  
                {  
                     echo '<label class="text-success"><span class="glyphicon glyphicon-ok"style="font-size:10000px; color:red"></span> Email Available</label>';  
                }  
           }  
      }       
 }  
 ?> 
 <?php  
 class main_model extends CI_Model  
 {  
      function is_email_available($email)  
      {  
           $this->database->where('Email', $email);  
           $query = $this->database->get("users");  
           if($query->num_rows() > 0)  
           {  
                return true;  
           }  
           else  
           {  
                return false;  
           }  
      }  
 }  
 ?>  