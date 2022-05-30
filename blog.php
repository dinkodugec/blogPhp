<?php require_once("Includes/db.php") ;?>
<?php require_once("Includes/functions.php") ;?>
<?php require_once("Includes/sessions.php") ;?>

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
    <title>Blog php</title>
    <style media="screen">
      .heading {
          font-family: Bitter, Georgia, "Times New Roman", Times, serif;
          font-weight: bold;
          color: #005E90;
        }

        .heading:hover {
          color: #0090DB;
        }

    </style>
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
  
      <div class="container">
        <div class="row mt-4">

             <!--  ******Main Area****** -->
           <div class="col-sm-8">
              <h1>The Complete ResponsiveBlog</h1>
              <h1 class="lead">The Complete Blog Using Php by Dinko Dugec</h1>
              <?php echo ErrorMessage();
                      echo SuccessMessage();
                ?>
              <?php
                   global $connectingDB;
                // SQL  query when search button is active
                  if(isset($_GET['searchButton'])){
                    $search = $_GET['search'];
                    $sql = "SELECT * FROM posts 
                            WHERE post LIKE :search 
                            OR title LIKE :search 
                            OR category LIKE :search";
                            $stmt=$connectingDB->prepare($sql);
                            $stmt->bindValue(':search', '%'.$search.'%');
                            $stmt->execute();
                    }// Query When Pagination is Active i.e Blog.php?page=1
                    elseif(isset($_GET['page'])){
                        $page = $_GET['page'];
                         if($page==0 || $page<1){
                          $showPostFrom=0;
                        }else{
                          $showPostFrom = ($page*5)-5;
                        }
                        $sql = "SELECT * FROM posts ORDER BY id desc LIMIT $showPostFrom,5";
                        $stmt = $connectingDB->query($sql);
                        //Query when category is active in URL tab
                    }elseif(isset($_GET['category'])){
                        $category = $_GET['category'];
                        $sql = "SELECT * FROM posts WHERE category='$category' ORDER BY id desc";
                        $stmt = $connectingDB->query($sql);

                    }
                    else{
                    $sql= "SELECT * FROM posts ORDER BY id DESC LIMIT 0,3";   /* beacause is desc it shows last post */
                    $stmt=$connectingDB->query($sql);
                  }   
                  

                    while($dataRows = $stmt->fetch()){
                        $postId=$dataRows['id'];
                        $postTitle=$dataRows['title'];
                        $category=$dataRows['category'];
                        $admin=$dataRows['author'];
                        $image=$dataRows['image'];
                        $postDescription=$dataRows['post'];

                     ?>

              <div class="card">
                <img src="Upload/<?php echo htmlentities($image) ;?>" style="max: height 450px;" class="img-fluid card-img-top"/>
                <div class="card-body">
                   <h4 class="card-title"><?php echo htmlentities($postTitle)  ;?></h4>
                   <small class="text-muted">Category: <span class="text-dark"> <a href="blog.php?category=<?php echo htmlentities($category); ?>"> <?php echo htmlentities($category); ?> </a></span> & Written by <span class="text-dark"> <a href="Profile.php?username=<?php echo htmlentities($admin); ?>"> <?php echo htmlentities($admin); ?></a></small>
                   <span style="float:right;" class="badge badge-dark text-light">Comments 
                   <?php echo ApproveCommentsAccordingtoPost($postId);  ?></span>
                   <hr>
                   <p class="card-text">
                     <?php if(strlen($postDescription)>150){
                       $postDescription = substr($postDescription,0,150)."...";
                     }
                     echo $postDescription ;?></</p>
                   <a href="fullPost.php?id=<?php echo $postId; ?>"
                      style="float:right">
                    <span class="btn btn-info">Read More</span>
                  </a>
                </div>
             </div>     
              <?php } ?>    <!--  Ending while loop -->

          <!--     Pagination  -->

          <nav>
            <ul class="pagination pagination-lg">
              <!-- Creating Backward Button -->
              <?php if(isset($page) ) {
                if ($page>1 ) {?>
             <li class="page-item">
                 <a href="blog.php?page=<?php echo $page-1; ?>" class="page-link">&laquo;</a>
               </li>
             <?php } }?>
            <?php
            global $connectingDB;
            $sql           = "SELECT COUNT(*) FROM posts";
            $stmt          = $connectingDB->query($sql);
            $rowPagination = $stmt->fetch();
            $totalPosts    = array_shift($rowPagination);
            // echo $totalPosts."<br>";
            $postPagination=$totalPosts/5;
            $postPagination=ceil($postPagination);
            // echo $postPagination;
            for ($i=1; $i <=$postPagination ; $i++) {
              if( isset($page) ){
                if ($i == $page) {  ?>
              <li class="page-item active">
                <a href="blog.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
              </li>
              <?php
            }else {
              ?>  <li class="page-item">
                  <a href="blog.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
                </li>
            <?php  }
          } } ?>
          <!-- Creating Forward Button -->
          <?php  if(isset($page) && !empty($page) ) {
                  if($page+1 <= $postPagination) {?>
                    <li class="page-item">
                    <a href="blog.php?page=<?php  echo $page+1; ?>" class="page-link">&raquo;</a>
           </li>
            <?php } }?>
            </ul>
          </nav>
          </div>
        <!--   **********Main Area End********** -->


        
        
        <!--    ********Side Area********* -->
          <div class="col-sm-4">
               <div class="card mt-4">
                  <div class="card-body">
                    <img src="images/startblog.png" class="d-block img-fluid mb-3" alt="">
                    <div class="text-center">
                      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veniam, possimus eveniet! Ipsa beatae ipsam, 
                       molestiae amet, 
                      vel quidem doloribus odio aliquam dolor tempore neque non libero harum nesciunt exercitationem iusto.
                    </div>
                  </div>
               </div>
               <br>
               <div class="card">
                 <div class="card-header bg-dark text-light">
                  <h2 class="lead">Sign Up</h2>
                 </div>
                 <div class="card-body">
                   <button type="button" class="btn btn-success btn-block text-center text-white mb-4" name="button">Join Forum</button>
                   <button type="button" class="btn btn-danger btn-block text-center text-white mb-4" name="button">Login</button>
                   <div class="input-group mb-3">
                     <input type="text" class="form-control" name="" placeholder="Enter your email" value="">
                     <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">Subscribe now</button>
                   </div>
                 </div>
               </div>
               <div class="card">
                 <div class="card-header bg-primary text-light">
                   <h2 class="lead">Categories</h2>
                   <div class="card-body">
                     <?php
                       global $connectingDB;
                       $sql = "SELECT * FROM category ORDER BY id desc";
                       $stmt = $connectingDB->query($sql);
                       while ($dataRows = $stmt->fetch()) {
                        $categoryId     = $dataRows['id'];
                        $categoryName  = $dataRows['title'];
                        ?>
                        <a href="blog.php?category=<?php echo $categoryName; ?>"><span class="heading"><?php echo $categoryName; ?></span></a> <br>
                      <?php } ?>
                   </div>
                 </div>
               </div>
           </div>
        <!--   ************Side Area End********* -->
        </div>
      </div>

    <!-- END OF HEADER -->


   <!--   FOOTER -->
     <footer class="bg-dark text-white mt-4">
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