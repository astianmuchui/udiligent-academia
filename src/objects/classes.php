<?php

         class DB{
            private $dbname;
            private $dbhost;
            private $dbuser;
            private $dbpwd;
            private $conn;
            public function execute_connection(){
               $this->dbname = "rangyrich";
               $this->dbhost = "localhost";
               $this->dbpwd = "33358020TADA3030";
               $this->dbuser = "root";
               $this->conn = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpwd,$this->dbname);
               return $this->conn;
            }
         }

         class sendmsg extends DB{
            private $name;
            private $email;
            private $message;
            public function deliver_message(){
                  $this->name = mysqli_real_escape_string($this->conn,$_POST['cnm']);
                  $this->email = mysqli_real_escape_string($this->conn, $_POST['cml']);
                  $this->message = mysqli_real_escape_string($this->conn,$_POST['cmsg']);
                  //Encrypt
                  $encry_nm = base64_encode($this->name);
                  $encry_em = base64_encode($this->email);
                  $encry_mes = base64_encode($this->message);
                  //Insert records
                  $query = mysqli_query($this->conn,"INSERT INTO messages (`clnm`,`clmail`,`clmsg`) VALUES ('$encry_nm','$encry_em','$encry_mes')");
                  if($query){
                     mail("classified.diligentwriting@gmail.com",$this->email,$this->message,"Message from .'$this->name'.");
                     //Done
                  }
            }
         }
         class order extends DB{
            private $ord_name;
            private $ord_email;
            private  $tpc;
            private $date;
            private $ord_doc;
            private $ord_specs;
            public $output;
            private $folder;
            public function make_order(){
               $this->ord_name = mysqli_real_escape_string($this->conn,$_POST['ord_nm']);
               $this->ord_email = mysqli_real_escape_string($this->conn, $_POST['ord_em']);
               $this->tpc = mysqli_real_escape_string($this->conn, $_POST['topic']);
               $this->date = mysqli_real_escape_string($this->conn, $_POST['date']);
               $this->ord_doc = mysqli_real_escape_string($this->conn,$_FILES['doc']['name']);
               $this->ord_specs = mysqli_real_escape_string($this->conn, $_POST['specs']);
               if(!empty($this->ord_name) &&!empty($this->ord_email)&&!empty($this->tpc) && !empty($this->date) && !empty($this->ord_doc) && !empty($this->ord_specs) ){
                  $this->folder = "../src/media";
                  $fil_name = basename($this->ord_doc);
                  $PATH = $this->folder.$fil_name;
                  $extension = pathinfo($PATH,PATHINFO_EXTENSION);
                  $formats = array('jpg','jpeg','png','webp','docx','pdf');
                  $tmp = $_FILES['ord_doc']['tmp_name'];
                  if(in_array($extension,$formats)){
                     if(move_uploaded_file($tmp,$PATH)){
                        //Encrypt
                        $enc_nm = base64_encode($this->ord_name);
                        $enc_eml = base64_encode($this->ord_email);
                        $enc_tpc = base64_encode($this->tpc);
                        $enc_dt = base64_encode($this->date);
                        $enc_doc_path = base64_encode($this->ord_doc);
                        $enc_specs = base64_encode($this->ord_specs);
                        $action = mysqli_query($this->conn,"INSERT INTO orders (`unm`,`email`,`topic`,`date`,`url`,`specs`) VALUES('$enc_nm','$enc_eml','$enc_tpc','$enc_dt','$enc_doc_path','$enc_specs')");

                     }
                  }  else{
                        $this->output = "Invalid File format";
                  }          
               }  
            }
         }



?>






