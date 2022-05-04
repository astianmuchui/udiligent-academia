
<?php
   class DB{
      protected $dbname = "rangyrich";
      protected $dbhost = "localhost";
      protected $dbuser = "root";
      protected $dbpwd = "";
      public $conn;
      public function execute_connection(){
        //oops , was to write something but too bad
        $this->conn = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpwd,$this->dbname);
      }
   }
   class unit_test{
      public function unit_test_db(){
         //Test database
         $t = new DB;
         $t->execute_connection();
      }
   }

   class sendmsg extends DB{
      private $name;
      private $email;
      private $message;
      public function deliver_message(){
         $this->conn = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpwd,$this->dbname);
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
               if(mail("classified.diligentwriting@gmail.com","Message from .'$this->name'.",$this->email,$this->message)){
                  header("Location: ./?1");
               }else{
                  header("Location: ./?2");
               }
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
        $this->conn = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpwd,$this->dbname);
         $this->ord_name = mysqli_real_escape_string($this->conn,$_POST['ord_nm']);
         $this->ord_email = mysqli_real_escape_string($this->conn, $_POST['ord_em']);
         $this->tpc = mysqli_real_escape_string($this->conn,$_POST['topic']);
         $this->date =  mysqli_real_escape_string($this->conn,$_POST['date']);
          $this->ord_doc = mysqli_real_escape_string($this->conn,$_FILES['doc']['name']);
         $this->ord_specs = mysqli_real_escape_string($this->conn,$_POST['specs']);
         if(!empty($this->ord_name) &&!empty($this->ord_email)&&!empty($this->tpc) && !empty($this->date) && !empty($this->ord_doc) && !empty($this->ord_specs) ){
            $this->folder = "../src/media/";
            $fil_name = basename($this->ord_doc);
            $PATH = $this->folder.$fil_name;
            $extension = pathinfo($PATH,PATHINFO_EXTENSION);
            $formats = array('jpg','jpeg','png','webp','docx','pdf');
            $tmp = $_FILES['doc']['tmp_name'];
            global $output;
            
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
                  if($action){
                     $mail_body = "A new order has been placed by '.$this->ord_name.' , '.$this->ord_email.' Please login to view the order ";
                     if(mail("diligentwriting20@gmail.com","classified.diligentwriting@gmail.com","New order",$mail_body)){
                        header("Location: ./?1");
                     }else{
                        header("Location: ./?2");
                     }


                  }
               }
            }  else{

                  $output = "Invalid File format";
                  
            }          
         }  
      }
   }
   class support extends DB{
         private $ctm_nm;
         private $ctm_em;
         private $cmplnt;
         public function send_complaint(){
            $this->conn = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpwd,$this->dbname);
            $this->ctm_nm = mysqli_real_escape_string($this->conn,$_POST['cmp-nm']);
            $this->ctm_em =  mysqli_real_escape_string($this->conn,$_POST['cmp-email']);
            $this->cmplnt = mysqli_real_escape_string($this->conn, $_POST['cmp']);
            //Encrypt Data
            $enc_cmp_nm = base64_encode($this->ctm_nm);
            $enc_cmp_em = base64_encode($this->ctm_em);
            $enc_ctm_cmp = base64_encode($this->cmplnt);
            //Enter to database
            $exec = mysqli_query(
               $this->conn,
            "INSERT INTO support (`cmpnm`,`cmpem`,`cmpmsg`) 
            VALUES ('$enc_cmp_nm','$enc_cmp_em','$enc_ctm_cmp')"
            );
            if($exec){
               if(mail("diligentwriting20@gmail.com","classified.diligentwriting@gmail.com","New Complaint",                    
                "A new order has been placed by '.$this->ctm_nm.' , '.$this->ctm_em.' Please login to view the complaint ")){
                  header("Location: ../?1");
               }else{
                  header("Location: ../?2");
               }
            }
         }
   }

   // Admin Functions 
   class db_acess extends DB {
      private $server_connection;
      private $result;

      private function establish_server_connection(){
         return $this->server_connection = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpwd,$this->dbname);
        
      }

      private function exec_query($query){
         return $this->result = mysqli_query(self::establish_server_connection(),$query);
      }

      private function close_server_connection(){
         return mysqli_close(db_acess::establish_server_connection());
      }

      public function get_orders_count(){

         $this->result = db_acess::exec_query("SELECT * FROM orders");
         $rows = mysqli_fetch_all($this->result,MYSQLI_ASSOC);
         mysqli_free_result($this->result);
         self::close_server_connection();
         print(count($rows));
      
      }

      public function get_messages_count(){
         $this->result = db_acess::exec_query("SELECT * FROM messages");
         $rows = mysqli_fetch_all($this->result,MYSQLI_ASSOC);
         mysqli_free_result($this->result);
         self::close_server_connection();
         print(count($rows));
      }
      public function get_complaints_count(){
         $this->result = db_acess::exec_query("SELECT * FROM support");
         $rows = mysqli_fetch_all($this->result,MYSQLI_ASSOC);
         mysqli_free_result($this->result);
         self::close_server_connection();
         print(count($rows));
      }

      public function latest_orders(){
         $this->result = db_acess::exec_query("SELECT * FROM orders ORDER BY id DESC LIMIT 6");
         $latest_orders = mysqli_fetch_all($this->result,MYSQLI_ASSOC);
         mysqli_free_result($this->result);
         self::close_server_connection();
         foreach ($latest_orders as $latest_order):
            $dcrypt_name = base64_decode($latest_order['unm']);
            $dcrypt_topic = base64_decode($latest_order['topic']);
            $enc_id = base64_encode($latest_order['id']);
            $div = '
                  <div>
                     <p>'.$dcrypt_name.'</p>
                     <small>Topic : '.$dcrypt_topic.'</small>
                     <a href="./view_order.php?id='.$enc_id.'" class="btn-view">Details</a>
               </div>
            ';
            echo $div;
         endforeach;
      }
      public function view_indiv_ord(){
         $dcry_id = base64_decode($_GET['id']);
         $this->result = db_acess::exec_query("SELECT * FROM orders WHERE id= $dcry_id");

         $this->individual_order = mysqli_fetch_assoc($this->result);
         // Decrypting data..................

         $dcrypt_name = base64_decode($this->individual_order['unm']);
         $dcrypt_email = base64_decode($this->individual_order['email']);
         $dcrypt_tpc = base64_decode($this->individual_order['topic']);
         $dcrypt_time = base64_decode($this->individual_order['date']);
         $decrypt_url = base64_decode($this->individual_order['url']);
         $dcrypt_specs = base64_decode($this->individual_order['specs']);

         $div = ' 
                  <div class="stuff ">
                     <h1>'.$dcrypt_name.'.</h1>
                     <small> <span class="highlight">Posted </span> '.substr($this->individual_order['time'],0,16).' </small> <br>
                     <small><span class="highlight">Topic </span> '.$dcrypt_tpc.'</small> <br>
                     <small><span class="highlight">Deadline </span>'.$dcrypt_time.'</small> <br>
                     <small><a href="../src/media/'.$decrypt_url.'" class="pdf-btn" download><i class="fas fa-download"></i>  </a><span class="highlight">  PDF</span></small>
                  <p>
                     '.$dcrypt_specs.'
                  </p>
                  <div class="link">
                     <a href="#" class="rep-link green-b">Accept Order</a>
                     <a href="#" class="rep-link red-b">Decline Order</a>
                  </div>

               </div>
      ';
      echo $div;
      }
      public function get_orders(){
         $this->result = self::exec_query("SELECT * FROM orders ORDER by id desc");
         $this->orders = mysqli_fetch_all($this->result,MYSQLI_ASSOC);
         foreach($this->orders as $order){
            //Reverse cipher
             $rvr_cipher_nm = base64_decode($order['unm']);
             $rvr_cipher_em = base64_decode($order['email']);
             $rvr_cipher_tp = base64_decode($order['topic']);
             $rvr_cipher_date = base64_decode($order['date']);
             $rvr_cipher_url = base64_decode($order['url']);
             $rvr_cipher_specs = base64_decode($order['specs']);
            $enc_id = base64_encode($order['id']);
             $div = '
             
             <div class="ord-card">
             <p>'.$rvr_cipher_nm.'</p>
             <span>'.$rvr_cipher_tp.'</span><br>
             <small>'.substr($rvr_cipher_specs,0,74).'.........</small> <br> 
             <a href="./view_order.php?id='.$enc_id.'">View</a>
          </div>

             ';
             print $div;
             
         }

      }

      public function fetch_messages(){
         $this->result = self::exec_query("SELECT * FROM messages ORDER by id DESC");
         $this->messages = mysqli_fetch_all($this->result,MYSQLI_ASSOC);
         foreach($this->messages as $msg){
            //Deciphering ....................

            $dcphr_name = base64_decode($msg['clnm']);
            $dcphr_msg =
             base64_decode(
               substr(
                  $msg['clmsg']
                  ,
                  0
                  ,
                  157

                  ));
                  $nc_id = base64_encode($msg['id']);
                  $div  = '                  
                  <a href="./view_message.php?id='.$nc_id.'" class="msg_box">
               <p class="text-yellow" >'.$dcphr_name.'</p>
               <small>'.$dcphr_msg.'</small>
               </a>

                  ';
                  print($div);
         }
      }

      public function support_queries(){
         $this->result = self::exec_query("SELECT * FROM support ORDER BY id DESC");
         $this->queries = mysqli_fetch_all($this->result,MYSQLI_ASSOC);

         foreach($this->queries as $querie)
            {
               //Decipher info ....

               $dcphr_nm = base64_decode($querie['cmpnm']);
               $dcphr_msg = base64_decode(
                  substr(
                  $querie['cmpmsg'],
                  0,
                  157
               ));
               $nc_id = base64_encode($querie['id']);

                  $div = '
                  
                  <a href="" class="msg_box">
                  <span class="text-yellow"> '.$dcphr_nm.' </span>
                  <small>'.$dcphr_msg.'</small>
                  </a>

                  ';
               echo $div;
            }
      }

      public function view_message(){
         if(isset($_GET['id'])){
            $id =base64_decode( $_GET['id']);

            $this->result = self::exec_query("SELECT * FROM messages WHERE id = $id");
            $this->ses_msg = mysqli_fetch_assoc($this->result);
            //Needed parameters are date , name , email and message
            #Decipher.................




            $dc_name = base64_decode($this->ses_msg['clnm']);
            $dc_time = (
               substr
               (
                  $this->ses_msg['time']
               ,0,
               16
               
            ));

            $dc_msg = base64_decode($this->ses_msg['clmsg']);
            $dc_email = base64_decode($this->ses_msg['clmail']);

            $div = '
            
            <div class="stuff">
               <h1>'.$dc_name.'.</h1>
               <small> '.$dc_time.' </small>
               <p> '.$dc_msg.' </p>
                  <a href="mailto: '.$dc_email.' " class="rep-link">Reply Message</a>
            </div>


            ';

            echo $div;

            
         }

      }

   }
   ?>