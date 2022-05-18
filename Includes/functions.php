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


?>