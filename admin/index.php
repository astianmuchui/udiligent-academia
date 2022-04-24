<?php
   require "../src/functions/functions.php";
   require "../src/objects/classes.php";
   check_acess();
   $db_acess = new db_acess();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong|Roboto|Tangerine">
   <link rel="stylesheet" href="../assets/css/cpanel.css">

   <script src="../assets/javascript/font_awesome_main.js" crossorigin="anonymous"></script>
   <title>Admin</title>
</head>
<body>
   <header>
         <p class="title">
            Diligent <span>Writing</span>
         </p>

   </header>
   <main>
      <a href="./"><img src="../assets/images/admin-icon-12-removebg-preview.png" height="100"  width="100" alt="admin avatar" loading="lazy" title="Home"></a>
      <nav>
         <ul>
            <li>  <a href="./messages.php" ><i class="fas fa-inbox child" title="messages"></i></a> </li>
            <li><a href="./orders.php"> <i class="fas fa-cart-plus inter" title="orders"></i> </a></li>
            <li><a href="./support.php"> <i class="fas fa-user-clock last" title="support"></i></a></li>
            <li><a href=""> <i class="fas fa-sign-out-alt finl" title="logout"></i></a></li>
            <li><a href="../"> <i class="fas fa-arrow-circle-left  finl" title="back to website"></i></a></li>
            <li><a href="#"> <i class="fas fa-redo finl" id="reload" title="reload"></i></a></li>
            <li><a href="https://twitter.com/onestheessay/"> <i class="fab fa-twitter finl" title="Twitter"></i></a></li>
            <li>  <a href="https://mail.google.com/mail/u/0/"><i class="far fa-envelope child" title="mailbox"></i></a> </li>
         </ul>
      </nav>

   </main>
   <section class="content">
      <div class="stats-grid-cont">
         <div class="grid-cont">
            <div class="child_one">
               <p>Total Orders</p>
               <span><?php $db_acess->get_orders_count(); ?></span>
            </div>
            <div class="child_two">
               <p>Total Messages</p>
               <span><?php $db_acess->get_messages_count(); ?></span>
            </div>
            <div class="child_three">
               <p>Total Complaints</p>
               <span><?php $db_acess->get_complaints_count(); ?></span>
            </div>
         </div>
      </div>
      <div class="incoming">
         <h4>Latest Orders</h4>
         <div class="grid-w">
            <?php
               $db_acess->latest_orders();
            ?>
         </div>
      </div>
   </section>
   <script src="../assets/javascript/reloader.js"></script>
</body>
</html>