<?php require_once("Includes/db.php") ;?>
<?php require_once("Includes/functions.php") ;?>
<?php require_once("Includes/sessions.php") ;?>

<?php
   $searchQueryParameter = $_GET['username'];
   global $connectingDB;
   $sql = "SELECT aname, aheadline,abio,aimage FROM admins WHERE username=:username";
   $stmt = $connectingDB->prepare($sql);
   $stmt->bindValue(':username', $searchQueryParameter);
   $stmt->execute();
   $result = $stmt->rowCount();

   if($result==1){
     while($dataRows = $stmt->fetch()){
       $existingName = $dataRows['aname'];
       $existingBio = $dataRows['abio'];
       $existingImage = $dataRows['aimage'];
       $existingHeadline = $dataRows['aheadline'];
     }
   }else{
     $_SESSION['ErrorMessage']="BAD REQUEST";   //do not trust no one
     redirectTo("blog.php?page=1");
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
    <!--  <h1 class="display-1">Hello World</h1>
    <h1 class="display-2">Hello World</h1>
    <h1 class="display-3">Hello World</h1>
    <h1 class="display-4">Hello World</h1>  ALL H1 Classes  -->


    
   <!-- NAVBAR -->
   <div style="height:10px; background:#27aae1;"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">   <!--  <nav class="navbar navbar-expand-lg bg-primary, bg-success"></nav> -->
          <div class="container">    <!-- <div class="container" style="height: 30px; background:red;"> Just to see container style</div> -->
            <a href="#" class="navbar-brand">Dinko Dugec</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
                  <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarcollapseCMS">
            <ul class="navbar-nav mr-auto"> <!--  margin reight:auto -->
                 
                  <li class="nav-item">
                        <a href="blog.php" class="nav-link">Home</a>  
                  </li>
                  <li class="nav-item">
                        <a href="#" class="nav-link">About Us</a>  
                  </li>
                  <li class="nav-item">
                        <a href="blog.php" class="nav-link">Blog</a>  
                  </li>
                  <li class="nav-item">
                        <a href="#" class="nav-link">Contact Us</a>  
                  </li>
                  <li class="nav-item">
                        <a href="#" class="nav-link">Features</a>  
                  </li>
            </ul>
          

            <ul class="navbar-nav ml-auto">
                <form action="blog.php" class="form-inline d-none d-sm-block" >
                  <div class="form-group">
                    <input type="text" class="form-control mr-2" name="search" placeholder="Search here..." value="">
                    <button class="btn btn-primary" name="searchButton">Go</button>
                  
                  </div>
                </form> 
            </ul>
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
                  <div class="col-md-6">
                    <h1><i class="fas fa-user text-success mr-2" style="color:#27aae1"></i><?php echo $existingName; ?></h1>
                    <h3><?php echo $existingHeadline; ?></h3>
                  </div>
            </div>
      </div>
    </header>
    <!-- END OF HEADER -->

    <section class="container py-2 mb-4">
       <div class="row">
         <div class="col-md-3">
            <img src="images/<?php echo $existingImage; ?>" class="d-block img-fluid mb-3 rounded-circle" alt="">
         </div>
         <div class="col-md-9" style="min-height:400px">
           <div class="card">
             <div class="card-body">
               <p class="lead"><?php echo $existingBio;?></p>
             </div>
           </div>
         </div>
       </div>
    </section>


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