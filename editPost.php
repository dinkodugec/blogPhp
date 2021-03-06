<?php require_once("Includes/db.php") ;?>
<?php require_once("Includes/functions.php") ;?>
<?php require_once("Includes/sessions.php") ;?>
<?php  confirmLogin();   ?>

<?php 

$searchQueryParameter = $_GET['id'];

if(isset($_POST['submit'])){        /* this submit must match name which you gave this buttom */

    $postTitle = $_POST['postTitle'];
    $category=$_POST['category'];
    $image = $_FILES['image']['name'];
    $target = "Upload/".basename( $_FILES['image']['name']);
    $postText = $_POST['postDescription'];
    $admin = "Dinko";


    date_default_timezone_set("Asia/Karachi");
    $currentTime=time();
    $dateTime=strftime("%B-%d-%Y %H:%M:%S", $currentTime);
    


     
    if(empty($postTitle)){
      $_SESSION['ErrorMesage'] = "Title can not be empty";
      redirectTo("editPost.php");
          }elseif(strlen($postTitle)<3){
            $_SESSION['ErrorMesage'] = "Post title should be greather than two charachters ";
            redirectTo("posts.php");
          }elseif(strlen($postTitle)>9999){   /* because we put in database varchar(50) */
            $_SESSION['ErrorMesage'] = "Post description should be less than 1000 charachters ";
            redirectTo("posts.php");
        }else{
            //query to update post in DB when everything is fine
           global $connectingDB;
           if(!empty($_FILES['image']['name'])){
              $sql = "UPDATE posts
              SET title='$postTitle', category='$category', image='$image', post='$postText'
              WHERE id='$searchQueryParameter'";
           }else{
              $sql = "UPDATE posts
              SET title='$postTitle', category='$category', post='$postText'
              WHERE id='$searchQueryParameter'";
           }
        
           $excute = $connectingDB->query($sql);

            move_uploaded_file($_FILES['image']['tmp_name'], $target);

           

             if($excute){
              $_SESSION['SuccessMessage']="Post updated Successfully";
              redirectTo('posts.php');
            }else{
              $_SESSION['ErrorMesage'] = "It is wrong sometimes, try again ";
              redirectTo("posts.php");
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
    <title>Edit Post</title>
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
                    <h1><i class="fas fa-edit"></i>Edit Post</h1>
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
                      //Fetching Existing Content according to our

                      global $connectingDB;
                     
                      $sql = "SELECT * FROM posts WHERE id='$searchQueryParameter'";
                      $stmt = $connectingDB->query($sql);

                      while($dataRows = $stmt->fetch()){
                        $titleToBeUpdated = $dataRows['title'];
                        $categoryToBeUpdated = $dataRows['category'];
                        $imageToBeUpdated = $dataRows['image'];
                        $postToBeUpdated = $dataRows['post'];
                      }
                ?>
              <form action="editPost.php?id=<?php echo $searchQueryParameter; ?>" method="post" enctype="multipart/form-data">
                <div class="card bg-secondary text-light mb-3">
                  <div class="card-body bg-dark">
                    <div class="form-group">
                      <label for="title"><span class="fieldInfo">Post Title:</span> </label>
                      <input class="form-control" type="text" name="postTitle" id="title" placeholder="Type title here" value="<?php echo $titleToBeUpdated   ?>">
                    </div>
                    <div class="form-group">
                      <span class="fieldInfo">Existing Category: </span>
                      <?php echo $categoryToBeUpdated; ?>
                      <label for="categoryTitle"><span class="fieldInfo">Choose Category:</span> </label>
                        <select class="form-control" name="category" id="categoryTitle">
                           <?php
                               global $connectingDB;
                               $sql = "SELECT id,title FROM category";
                               $stmt = $connectingDB->query($sql);
                               while($dataRows = $stmt->fetch()){
                                    $id = $dataRows['id'];
                                    $categoryName = $dataRows['title'];
                               
                            ?>
                            <option><?php echo $categoryName; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                    <span class="fieldInfo">Existing Image: </span>
                    <img class="mb-1" src="Upload/<?php echo $imageToBeUpdated; ?>" width="170px"; height="70px" alt="">
                        <div class="custom-file">
                         <input class="custom-file-input" type="file" name="image" id="imageSelect" value="">
                         <label for="imageSelect" class="custom-file-label">Select Image</label>
                       </div>
                    </div>
                    <div class="form-group">
                      <label for="post"><span class="fieldInfo">Post :</span></label>
                      <textarea class="form-control" name="postDescription" id="post" cols="30" rows="10">
                        <?php echo $postToBeUpdated;?>
                      </textarea>
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