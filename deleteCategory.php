<?php require_once("Includes/db.php") ;?>
<?php require_once("Includes/functions.php") ;?>
<?php require_once("Includes/sessions.php") ;?>


<?php
    if(isset($_GET['id'])){
      $searchQueryParameter = $_GET['id'];
      global $connectingDB;
      $sql = "DELETE FROM category WHERE id='$searchQueryParameter'";
      $execute = $connectingDB->query($sql);
        if($execute){
          $_SESSION['SuccessMessage'] = "Category DELETED Successfully";
          redirectTo("categories.php");
        }else{
          $_SESSION['ErrorMessage'] = "Something Went Wrong, try again!";
          redirectTo("categories.php");
        }
    }



?>