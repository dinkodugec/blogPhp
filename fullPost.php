<?php require_once("Includes/db.php") ;?>
<?php require_once("Includes/functions.php") ;?>
<?php require_once("Includes/sessions.php") ;?>
<?php $searchQueryParameter = $_GET['id']; ?>

<?php 

if(isset($_POST["submit"])){        /* this submit must match name which you gave this buttom */
    $name = $_POST["commentarName"];
    $email = $_POST["commentarEmail"];
    $comment = $_POST["commentarThoughts"];
    
    if(empty($name)||empty($email)||empty($comment)){
          $_SESSION['ErrorMesage'] = "All fields must be filled out";
          redirectTo("fullPost.php?id={$searchQueryParameter}");
          }elseif(strlen($comment)>443){
            $_SESSION['ErrorMesage'] = "Comment lenght should be less than 444 charachters ";
            redirectTo("fullPost.php?id={$searchQueryParameter}");
          }else{
            //query to insert comment in DB when everything is fine
            global $connectingDB;
            $sql = "INSERT INTO comments(name,email,comment,approvedby,status, post_id)";
            $sql .= "VALUES(:name,:email,:comment,'Pending','OFF', :postIdFromURL)";
            $stmt = $connectingDB->prepare($sql);
            $stmt->bindValue(':name',$name);
            $stmt->bindValue(':email',$email);
            $stmt->bindValue(':comment',$comment);
            $stmt->bindValue(':postIdFromURL',$searchQueryParameter); 
            $excute=$stmt->execute();
              
               if($excute){
              $_SESSION['SuccessMessage']="Comment Submitted Successfully";
              redirectTo("fullPost.php?id={$searchQueryParameter}");
            }else{
              $_SESSION['ErrorMesage'] = "It is wrong sometimes, Try again ";
              redirectTo("fullPost.php?id={$searchQueryParameter}");
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
    <title>Blog php</title>
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

                  if(isset($_GET['searchButton'])){
                    $search = $_GET['search'];
                    $sql = "SELECT * FROM posts 
                            WHERE post LIKE :search 
                            OR title LIKE :search 
                            OR category LIKE :search";
                            $stmt=$connectingDB->prepare($sql);
                            $stmt->bindValue(':search', '%'.$search.'%');
                            $stmt->execute();
                    }else{
                      $postIdFromUrl=$_GET['id'];
                      if(!isset($postIdFromUrl)){
                        $_SESSION['ErrorMessage']="BAD REQUEST";  //FOR BAD people with not so good intentions
                        redirectTo("blog.php");
                      }
                    $sql= "SELECT * FROM posts WHERE id='$postIdFromUrl'";   
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
                   <small class="text-muted">written by <?php echo htmlentities($admin) ;?></</small>
                   <span style="float:right;" class="badge badge-dark text-light">Comments 20</span>
                   <hr>
                   <p class="card-text">
                     <?php 
                     echo htmlentities($postDescription)  ;?></</p>
                  
                </div>
             </div>     
              <?php } ?>    <!--  Ending while loop -->


            <div class="">
              <form class="" action="fullPost.php?=<?php echo $searchQueryParameter;  ?>" method="post">
                <div class="card mb-3">
                    <div class="card-header">
                      <h5 class="fieldInfo">Share your thoughts</h5>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" ><i class="fas fa-user"></i></span>
                        </div>
                        <input class="form-control" type="text" name="commentarName" placeholder="name" value="">
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" ><i class="fas fa-envelope"></i></span>
                        </div>
                        <input class="form-control" type="email" name="commentarEmail" placeholder="email" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <textarea name="commentarThoughts" class="form-control" id="" cols="30" rows="6"></textarea>
                    </div>
                    <div class="">
                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                   </div>
               
              </form>
            </div>  
          </div>
        <!--   **********Main Area End********** -->


        
        
        <!--    ********Side Area********* -->
          <div class="col-sm-4" style="min-height:40px; background:green; ">

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