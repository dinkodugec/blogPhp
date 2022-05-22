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


?>