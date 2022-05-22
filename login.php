<?php require_once("Includes/db.php") ;?>
<?php require_once("Includes/functions.php") ;?>
<?php require_once("Includes/sessions.php") ;?>

<?php

 if(isset($_SESSION["userId"])){
  redirectTo("dashboard.php");
}
 
   if(isset($_POST["submit"])) {
      $username = $_POST["username"];
      $password = $_POST["password"];
         if (empty($username)||empty($password)) {
          $_SESSION["ErrorMessage"]= "All fields must be filled out";
          redirectTo("login.php");
         }else {

         

   // code for checking username and password from Database
    $foundAccount=Login_Attempt( $username,$password);
      if ($foundAccount) {
        $_SESSION["userId"]=$foundAccount["id"];
        $_SESSION["username"]=$foundAccount["username"];
        $_SESSION["adminName"]=$foundAccount["aname"];
        $_SESSION["SuccessMessage"]= "Wellcome ".$_SESSION["adminName"]."!";
        if(isset( $_SESSION["trackingURL"])){
          redirectTo($_SESSION["trackingURL"]);
        }else{
          redirectTo("dashboard.php");
        }
        }else {
        $_SESSION["ErrorMessage"]="Incorrect Username/Password";
        redirectTo("login.php");
    }
  } 
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <script src="https://kit.fontawesome.com/7156340534.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css"
      integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/styles.css">
    <title>Document</title>
  </head>
  <body>
  
    
    <!-- NAVBAR -->
     <div style="height:10px; background:#27aae1;"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">   <!--  <nav class="navbar navbar-expand-lg bg-primary, bg-success"></nav> -->
          <div class="container">    <!-- <div class="container" style="height: 30px; background:red;"> Just to see container style</div> -->
            <a href="#" class="navbar-brand">Dinko Dugec</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
                  <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarcollapseCMS">
           
          

           <!--  <ul class="navbar-nav ml-auto">
                 <li class="nav-item">
                       <a href="logout.php" class="nav-link text-danger"><i class="fas fa-user-times ml-auto"></i>Logout</a>
                 </li>   
            </ul> -->
          </div>
          </div>
    </nav>
    <div style="height:10px; background:#27aae1;"></div>
     </nav>
     <!-- NAVBAR END -->

     <!-- HEADER -->
    <header class="bg-dark text-white py-4">    <!-- p means padding  -->
      <div class="container">
            <div class="row">
                  <div class="col-md-12">
                <h2>Header</h2>
                  </div>
            </div>
      </div>
    </header>
    <!-- END OF HEADER -->

   <!-- Main Area Start -->
   <section class="container py-2 mb-4">
      <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height:500px;">
        <br><br>
                <?php echo ErrorMessage();
                      echo SuccessMessage();
                 ?>
          <div class="card bg-secondary text-light">
              <div class="card-header">
               <h4>Wellcome Back !</h4>
              </div>
          <div class="card-body bg-dark">
             
              <form action="login.php" method="post">
                <div class="form-group">
                  <label for="username"><span class="fieldInfo">Username:</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-info"> <i class="fas fa-user"></i> </span>
                    </div>
                    <input type="text" class="form-control" name="username" id="username" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password"><span class="fieldInfo">Password:</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-info"> <i class="fas fa-lock"></i> </span>
                    </div>
                    <input type="password" class="form-control" name="password" id="password" value="">
                  </div>
                </div>
                <input type="submit" name="submit" class="btn btn-info btn-block" value="login">
              </form>

          </div> 

          </div>

        </div>

      </div>

    </section>
    <!-- Main Area End -->


   <!--   FOOTER -->
     <footer class="bg-dark text-white">
      <div class="container">
            <div class="row">    <!--  row-all accros container, that kind class in bootstrap -->
               <div class="col">
                  <p class="lead text-center">Theme By Dinko Dugec | <span id="year"></span> All reight reserved</p> 
              </div> 
           </div>  
      </div>
    </footer>
    <!--  END FOOTER -->


    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js"
      integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js"
      integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
      crossorigin="anonymous"
    ></script>

    <script>
      $('#year').text(new Date().getFullYear());
    </script>

  </body>
</html>


<!-- for a white navigation <nav class="navbar navbar-expand-lg navbar-light bg-light" -->