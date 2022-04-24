<?php
   require  "../src/functions/functions.php";
         
   if(isset($_POST['login'])){
      login();
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong|Roboto|Tangerine">
   <link rel="stylesheet" href="../assets/css/cpanel.css">
   <link rel="stylesheet" href="../assets/css/login.css">

   <title>Admin | Login </title>
</head>
<body>
   <header>
      <p class="title">
         Diligent <span>Writing</span>
      </p>

</header>
<div class="form-mn-wrapper">
   <div class="cont-mn">
      <div class="opn" >
         <span>Login to your panel <span>.</span> </span> <br>
         <center><small style="color:red; font-size :17px;"><?php show_error();?></small ></center>
      </div>
      <div class="forms">
         <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" name="u_nm" placeholder="Username" id="" required  autocomplete="off">
            <input type="password" name="u_pwd" placeholder="Password" id="" required autocomplete="off">
            <button type="submit" name="login">Login</button>
         </form>
      </div>
      
   </div>
</div>

</body>
</html>