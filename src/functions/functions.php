<?php
   session_start();
   $_SESSION['curr_err'] = "";              
   function show_error(){
       print($_SESSION['curr_err']);
   }
   function  login(){
      //Declare 
      global $DEFAULT_CIPHERED_PASSWORD;
      global $DEFAULT_CIPHERED_UNAME;
      $DEFAULT_CIPHERED_PASSWORD = "cGFsYXRlNzgwJg==";

      $DEFAULT_CIPHERED_UNAME = "cmFuZ3lyaWNo";

      $password = $_POST['u_pwd'];

      $username = $_POST['u_nm'];

      $CHAR_DCIPHER_PWD = base64_decode($DEFAULT_CIPHERED_PASSWORD);

      $CHAR_DCIPHER_UNM = base64_decode($DEFAULT_CIPHERED_UNAME);
      #Check for username
      if (strtolower($username) === $CHAR_DCIPHER_UNM) {
         // proceed
         if(strtolower($password)===$CHAR_DCIPHER_PWD){
               //Declare
               $_SESSION['login_status'] = 'ACESS_GRANTED';
               header("Location: ./");
         
         }else{

                  $_SESSION['curr_err'] = "wrong passord";
               }

      }else{
                  $_SESSION['curr_err'] = "wrong username";
      }



  
   }
   function check_acess(){

      if($_SESSION['login_status'] != 'ACESS_GRANTED' ){
         header("Location: ./login.php");
      }
   }

   function  logout(){
      $_SESSION['login_status'] = NULL;
      session_destroy();
      header("Location: ./login.php");
   }

?>