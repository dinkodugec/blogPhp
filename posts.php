<?php require_once("Includes/db.php") ;?>
<?php require_once("Includes/functions.php") ;?>
<?php require_once("Includes/sessions.php") ;?>
     <?php  
        $_SESSION["trackingURL"]=$_SERVER["PHP_SELF"];
        //echo $_SESSION["trackingURL"];
    
        confirmLogin();   
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
    <title>Posts</title>
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
                        <a href="admin.php" class="nav-link">Manage Admins</a>  
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
                    <h1><i class="fas fa-blog" style="color:#27aae1;"></i>Blog Posts</h1>
                  </div>
                  <div class="col-lg-3 mb-2">
                    <a href="addNewPost.php" class="btn btn-primary btn-block">
                    <i class="fas fa-edit">Add New Post</i></a>
                  </div>
                  <div class="col-lg-3  mb-2">
                    <a href="categories.php" class="btn btn-info btn-block">
                    <i class="fas fa-folder-plus">Add New Category</i></a>
                  </div>
                  <div class="col-lg-3  mb-2">
                    <a href="admins.php" class="btn btn-warning btn-block">
                    <i class="fas fa-user-plus">Add New Admin</i></a>
                  </div>
                  <div class="col-lg-3  mb-2">
                    <a href="comments.php" class="btn btn-success btn-block">
                    <i class="fas fa-check">Approve Comments</i></a>
                  </div>
            </div>
      </div>
    </header>
    <!-- END OF HEADER -->

    <!-- MAIN AREA-->

      <section class="container py-2 mb-4">

      <div class="row">
        <div class="col-lg-12">
                 <?php echo ErrorMessage();
                      echo SuccessMessage();
                 ?>
          <table class="table table-striped table-hover">
            <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Category</th>
            <!--   <th>Date&Time</th> -->
              <th>Author</th>
              <th>Banner</th>
              <th>Comments</th>
              <th>Action</th>
              <th>LivePreview</th>
           </tr>
           </thead>
           <?php
              global $connectingDB;
              $sql = "SELECT * FROM posts";
              $stmt = $connectingDB->query($sql);
              $sr = 0;
                while($dataRows = $stmt->fetch()){
                  $id = $dataRows['id'];
                 /*  $dateTime = $dataRows['datetime']; */
                  $postTitle = $dataRows['title'];
                  $category = $dataRows['category'];
                  $admin = $dataRows['author'];
                  $image = $dataRows['image'];
                  $postText = $dataRows['post'];
                  $sr ++;
            ?>
            <tbody>
            <tr>
              <td><?php echo $sr; ?></td>
              <td class="table-danger">
                <?php 
                 if(strlen($postTitle)>20){
                    $postTitle=substr($postTitle,0,15);
                  }    
                echo $postTitle   ; 
                ?>
              </td>
              <td> <?php 
                 if(strlen($category)>8){
                    $category=substr($category,0,15);
                  }    
                echo $category   ; 
                ?>
                </td>
             <!--  <td><?php echo  $datetime  ; ?></td> -->
              <td class="table-primary"><?php echo   $admin  ; ?></td>  <!--  if want some blue color for this table row -->
              <td><img src="Upload/<?php echo  $image  ; ?>" width="170px;" height="50px"</td>
              <td>
                    <?php $total = ApproveCommentsAccordingtoPost($id);
                    if ($total>0) {
                      ?>
                      <span class="badge badge-success">
                        <?php
                      echo $total; ?>
                      </span>
                        <?php  }   ?>
                  <?php $total = DisApproveCommentsAccordingtoPost($id);
                  if ($total>0) {  ?>
                    <span class="badge badge-danger">
                      <?php
                      echo $total; ?>
                    </span>
                         <?php  }  ?>
                </td> 
              <td>
                  <a href="editPost.php?id=<?php echo $id; ?>"><span class="btn btn-warning">Edit</span></a>
                  <a href="deletePost.php?id=<?php echo $id; ?>"><span class="btn btn-danger">Delete</span></a> 
              </td>
              <td>
                <a href="fullPost.php?id=<?php echo $id; ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a>
              </td>
            </tr>
            </tbody>
            <?php } ?>

          </table>
        </div>
      </div>

      </section>



    <!-- MAIN EREA END -->

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