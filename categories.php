<?php require_once("Includes/db.php") ;?>
<?php require_once("Includes/functions.php") ;?>
<?php require_once("Includes/sessions.php") ;?>

<?php 

if(isset($_POST['submit'])){        /* this submit must match name which you gave this buttom */

    $category = $_POST['categoryTitle'];
     
    if(empty($category)){
      $_SESSION['ErrorMesage'] = "All fields must be filled out";
      redirectTo("categories.php");

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
    <title>Categories</title>
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
                    <h1><i class="fas fa-edit"></i>Manage Categories</h1>
                  </div>
            </div>
      </div>
    </header>
    <!-- END OF HEADER -->

       <!-- Main Area -->
  
       <section class="container py-2 mb-4">
         <div class="row">
           <div class="offset-lg-1 col-lg-10" style="min-height:400px">
                <?php echo ErrorMessage();
                      echo SuccessMessage();
                ?>
              <form action="categories.php" method="post">
                <div class="card bg-secondary text-light mb-3">
                  <div class="card-header">
                    <h1>Add New Categories</h1>
                  </div>
                  <div class="card-body bg-dark">
                    <div class="form-group">
                      <label for="title"><span class="fieldInfo">Category Title:</span> </label>
                      <input class="form-control" type="text" name="categoryTitle" id="title" placeholder="Type title here" value="">
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