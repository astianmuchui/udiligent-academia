 <?php
    define("APP_ROOT","../src/objects/classes.php");
    $output = "";
    if(isset($_POST['make_order'])){
        require_once APP_ROOT;

        $ord_mk = new order;
        $ord_mk->make_order();
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../assets/css/order.css">
   <link rel="stylesheet" href="../assets/css/main.css">
   <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
   <title>Order</title>
</head>
<body>
   <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
          <div class="container-fluid">
              <a class="navbar-brand" href="#">DILIGENT WRITING</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>

              <div class="collapse navbar-collapse" id="navbarColor01">
                  <ul class="navbar-nav me-auto">
                      <li class="nav-item">
                          <a class="nav-link" href="../">Home
                           <span class="visually-hidden">(current)</span>
                </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="../#features">Features</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="../#contact">Contact Us</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="../#about">About</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link active" href="./">Order

                          </a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="../support/">Support</a>
                      </li>
                  </ul>

              </div>
          </div>
      </nav>


  </header>
    <br>
    <center class="text-danger" style="text-align:center;"><?php echo $output; ?></center>
  <div class="main cont">
      <div class="form-wrap cont">
         <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
         
               <div class="form-group">
                  <label for="" class="form-label mt-4">Name</label>
                  <input type="text" class="form-control" required name="ord_nm">
              </div>
              <div class="form-group">
                  <label for="" class="form-label mt-4">Email</label>
                  <input type="email" class="form-control" required name="ord_em">
              </div>
              <div class="form-group">
                 <label for="" class="form-label mt-4">Topic</label>
                 <select name="topic" id="" class="form-control" required name="topic">
                    <option value="">-SELECT-</option>
                     <option value="essay">Essay</option>
                     <option value="matlab">Matlab</option>
                     <option value="math">Mathematics</option>
                     <option value="dissertation">Dissertation</option>
                     <option value="respaper">Research paper</option>
                     <option value="chem">Chemistry</option> 
                     <option value="economics">Economics</option>
                     <option value="law">Law</option>
                     <option value="politics">Political Science</option>
                     <option value="philosophy">Philosophy</option>
                     <option value="excel">Excel</option>   
                     <option value="powerpoint">Powerpoint</option>
                 </select>
              </div>
              <div class="form-group">
                 <label for="" class="form-label mt-4">Deadline</label>
                 <input type="date" name="date" id="" class="form-control" required>

              </div>
              <div class="form-group">
               <label for="" class="form-label mt-4">Document</label>
               <input type="file" name="doc" id="" class="form-control" required>
              </div>
              <div class="form-group">
                 <label for="" class="form-label mt-4">Specifications</label>
                 <textarea name="specs" id="" cols="30" rows="3" class="form-control" required></textarea>
              </div>
              <div class="">
                 <label for="" class="form-label mt-4"></label>
                 <input type="submit" value="Send " name="make_order" class="form-control btn btn-primary">
              </div>
         </form>
      </div>
  </div>
  <footer class="cont">
   <div class="footer cont">
       <div class="intr"><span>DILIGENT WRITING</span>
       <p>Top-notch Academic writing quality</p>
       </div>
       <div class="menu2">
           <nav>
               <ul>
                   <li><a href="../">Home</a></li>
                   <li><a href="../#features">Features</a></li>
                   <li><a href="../#contact">Contact Us</a></li>
                   <li><a href="../#about">About</a></li>
                   <li><a href="#">Order</a></li>
                   <li><a href="../support/">Support</a></li>
               </ul>
           </nav>
       </div>
       <div class="conts">
           <a href="https://twitter.com/onestheessay" target="_blank"><i class="fab fa-twitter "></i></a>
           <a href="mailto:diligentwriting20@gmail.com" target="_blank"><i class="far fa-envelope "></i></a>
           <a href="https://www.reddit.com/user/diligentacademia/"><i class="far fa-reddit"></i></a>
       </div>

   </div>
       <div class="dev cont">
           <p>Diligent writing &copy; 2022 All rights reserved</p>
           <p>Powered by  <a href="mailto:sebastianmuchui79@gmail.com">Astian</a></p>
       </div>
</footer>
   <script src="../assets/javascript/font_awesome_main.js"></script>
   <script src="../assets/javascript/jquery.min.js"></script>
   <script src="../assets/javascript/main.js"></script>

</body>
</html>


