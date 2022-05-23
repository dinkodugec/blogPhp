<?php require_once("Includes/db.php") ;?>
<?php require_once("Includes/functions.php") ;?>
<?php require_once("Includes/sessions.php") ;?>


<?php
    if(isset($_GET['id'])){
      $searchQueryParameter = $_GET['id'];
      global $connectingDB;
      $admin =$_SESSION["adminName"];
      $sql = "UPDATE comments SET status='ON', approvedby='$admin' WHERE id='$searchQueryParameter'";
      $execute = $connectingDB->query($sql);
        if($execute){
          $_SESSION['SuccessMessage'] = "Comment Approved Successfully";
          redirectTo("comments.php");
        }else{
          $_SESSION['ErrorMessage'] = "Something Went Wrong, try again!";
          redirectTo("comments.php");
        }
    }



?>