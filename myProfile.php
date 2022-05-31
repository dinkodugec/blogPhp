<?php require_once("Includes/db.php") ;?>
<?php require_once("Includes/functions.php") ;?>
<?php require_once("Includes/sessions.php") ;?>
     <?php  
      $_SESSION["trackingURL"]=$_SERVER["PHP_SELF"];
     confirmLogin();   
    ?>

<?php 
/* fetching existing admin data start */
    $adminId = $_SESSION['userId'];
    global $connectingDB;
    $sql = "SELECT * FROM admins WHERE id='$adminId'";
    $stmt = $connectingDB->query($sql);
    while($dataRows = $stmt->fetch()){
      $existingName = $dataRows['aname'];
      $existingUsername = $dataRows['username'];
      $existingHeadline = $dataRows['aheadline'];
      $existingBio = $dataRows['abio'];
      $existingImage = $dataRows['aimage'];

    }
    /* fetching existing admin data end */

    if(isset($_POST['submit'])){   
      $aName = $_POST['name'];
      $aHeadline = $_POST['headline'];
      $aBio = $_POST['bio'];
      $aImage = $_FILES['image']['name'];
      $target = "Images/".basename( $_FILES['image']['name']);
    
     
    if(strlen($aHeadline)>30){
            $_SESSION['ErrorMessage'] = "Headline should be less than 30 charachters";
            redirectTo("myProfile.php");
          }elseif(strlen($aBio)>255){   
            $_SESSION['ErrorMessage'] = "Bio should be less than 500 charachters ";
            redirectTo("myProfile.php");
        }else{
            //query to update admin data in DB when everything is fine
            global $connectingDB;
             if(!empty($_FILES['image']['name'])){
              $sql = "UPDATE admins
                      SET aname='$aName', aheadline='$aHeadline', abio='$aBio', aimage='$aImage'
              WHERE id='$adminId'";
           }else{
            $sql = "UPDATE admins
                    SET aname='$aName', aheadline='$aHeadline', abio='$aBio'
                    WHERE id='$adminId'";
           }
        
           $excute = $connectingDB->query($sql);

            move_uploaded_file($_FILES['image']['tmp_name'], $target);

            if($excute){
              $_SESSION['SuccessMessage']="Details Updated successfully";
              redirectTo('myProfile.php');
            }else{
              $_SESSION['ErrorMessage'] = "It is wrong sometimes ";
              redirectTo("myProfile.php");
            }
        }

}  /*  Ending of submit button if-condition */

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
    <title>My profile</title>
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
                      <a href="myProfile.php" class="nav-link"><i class="fas fa-user text-success"></i>My Profile</a>  
                 </li>
                  <li class="nav-item">
                        <a href="dashboard.php" class="nav-link">Dashboard</a>  
                  </li>
                  <li class="nav-item">
                        <a href="posts.php" class="nav-link">Posts</a>  
                  </li>
                  <li class="nav-item">
                        <a href="categories.php" class="nav-link">Categories</a>  
                  </li>
                  <li class="nav-item">
                        <a href="admins.php" class="nav-link">Manage Admins</a>  
                  </li>
                  <li class="nav-item">
                        <a href="comments.php" class="nav-link">Comments</a>  
                  </li>
                  <li class="nav-item">
                        <a href="blog.php?page=1" class="nav-link">Live Blog</a>  
                  </li>
            </ul>
          

            <ul class="navbar-nav ml-auto">
                 <li class="nav-item">
                       <a href="logout.php" class="nav-link text-danger"><i class="fas fa-user-times ml-auto"></i>Logout</a>
                 </li>   
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
                  <div class="col-md-12">
                    <h1><i class="fas fa-user mr-2"></i><?php  echo  $existingUsername; ?></h1>
                  </div>
            </div>
      </div>
    </header>
    <!-- END OF HEADER -->

       <!-- Main Area -->
  
       <section class="container py-2 mb-4">
         <div class="row">
           <!-- left area -->
           <div class="col-md-3">
             <div class="card">
               <div class="card-header bg-dark text-light">
                  <h3><?php  echo $existingName;  ?></h3>
               </div>
               <div class="card-body">
                 <img src="images/<?php echo $existingImage  ; ?>" class="block img-fluid mb-3" alt="">
                 <div>
                    <?php echo $existingBio;  ?>
                 </div>
               </div>
             </div>
           </div>
       <!--     right Area -->
           <div class="col-md-9" style="min-height:400px">
                <?php echo ErrorMessage();
                      echo SuccessMessage();
                ?>
              <form action="myProfile.php" method="post" enctype="multipart/form-data">
                <div class="card bg-secondary text-light">
                  <div class="card-header bg-secondary text-light">
                    <h4>Edit Profile</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <input class="form-control" type="text" name="name" placeholder="Your name">                    
                    </div>
                    <div class="form-group">
                      <input class="form-control" type="text" name="headline" placeholder="headline">
                      <small class="text-muted">Add a professional headline like, 'Enginer' at XYZ or  'Arhitect'</small>
                      <span class="text-danger">Not more than 12 charachters</span>
                    </div>
                    <div class="form-group">
                      <textarea placeholder="BIO" class="form-control" name="bio" cols="30" rows="10"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-file">
                         <input class="custom-file-input" type="file" name="image">
                         <label for="imageSelect" class="custom-file-label">Select Image</label>
                       </div>
                    </div>
                   
                    <div class="row">
                       <div class="col-lg-6 mb-2">
                         <a href="dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Back To Dashboard</a>
                       </div>
                       <div class="col-lg-6 mb-2">
                       <button type="submit" name="submit" class="btn btn-success btn-block">
                         <i class="fas fa-check"></i>Publish
                       </button>
                    </div>
                  </div>
                </div>
                </div>
              </form>
           </div>
         </div>
       </section>

     <!-- The End area -->
    

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