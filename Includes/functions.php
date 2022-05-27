<?php require_once("Includes/db.php") ;?>
<?php

function redirectTo($newLocation){
  header("Location:".$newLocation);
  exit;
}

function checkUserNameExistsOrNot($username)
{
  global $connectingDB;
  $sql    = "SELECT username FROM admins WHERE username=:userName";
  $stmt   = $connectingDB->prepare($sql);
  $stmt->bindValue(':userName',$username);
  $stmt->execute();
  $result = $stmt->rowcount();
  if ($result==1) {
    return true;
  }else {
    return false;
  }
}

function Login_Attempt($username,$password)
{
  global $connectingDB;
  $sql = "SELECT * FROM admins WHERE username=:username AND password=:password LIMIT 1";
  $stmt = $connectingDB->prepare($sql);
  $stmt->bindValue(':username',$username);
  $stmt->bindValue(':password',$password);
  $stmt->execute();
  $result = $stmt->rowcount();
    if($result==1) {
    return  $foundAccount = $stmt->fetch();
    }else {
    return null;
  }
}

 function confirmLogin()
 {
     if(isset($_SESSION['userId'])){
       return true;
     }else{
      $_SESSION["ErrorMessage"]="Login Required !";
      redirectTo("login.php");
     }

 }

 function totalPosts()
 {
  global $connectingDB;
  $sql = "SELECT COUNT(*) FROM posts";
  $stmt = $connectingDB->query($sql);
  $totalRows = $stmt->fetch();
  $totalPosts = array_shift($totalRows);
  echo $totalPosts;
 }

 function totalCategories()
 {
  global $connectingDB;
  $sql = "SELECT COUNT(*) FROM category";
  $stmt = $connectingDB->query($sql);
  $totalRows = $stmt->fetch();
  $totalCategories = array_shift($totalRows);
  echo $totalCategories;

 }

 function totalAdmins()
 {
  global $connectingDB;
  $sql = "SELECT COUNT(*) FROM admins";
  $stmt = $connectingDB->query($sql);
  $totalRows = $stmt->fetch();
  $totalAdmins = array_shift($totalRows);
  echo $totalAdmins;
 }

 function totalComments()
 {
  global $connectingDB;
  $sql = "SELECT COUNT(*) FROM comments";
  $stmt = $connectingDB->query($sql);
  $totalRows = $stmt->fetch();
  $totalComments = array_shift($totalRows);
  echo $totalComments;

 }

 function ApproveCommentsAccordingtoPost($postId){
  global $connectingDB;
  $sqlApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$postId' AND status='ON'";
  $stmtApprove =$connectingDB->query($sqlApprove);
  $rowsTotal = $stmtApprove->fetch();
  $total = array_shift($rowsTotal);
  return $total;
}

function DisApproveCommentsAccordingtoPost($postId){
  global $connectingDB;
  $sqlDisApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$postId' AND status='OFF'";
  $stmtDisApprove =$connectingDB->query($sqlDisApprove);
  $rowsTotal = $stmtDisApprove->fetch();
  $total = array_shift($rowsTotal);
  return $total;
}





?>