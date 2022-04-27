<?php

session_start();

 function ErrorMessage()
{
  if(isset($_SESSION['ErrorMesage'])){
     $output = "<div class=\"alert alert-danger\">";
     $output .= htmlentities($_SESSION['ErrorMesage']);    /*   htmlentities- that we do not break any html */
     $output .= "</div>";
     $_SESSION['ErrorMesage'] = null;  /*  clearing session to null, so that when is message showed, and we refresh, message is remove from browser*/
   
     return $output;
  }
}

function SuccessMessage()
{
  if(isset($_SESSION['SuccessMessage'])){
     $output = "<div class=\"alert alert-success\">";
     $output .= htmlentities($_SESSION['SuccessMessage']);    /*   htmlentities- that we do not break any html */
     $output .= "</div>";
     $_SESSION['SuccessMessage'] = null;  /*  clearing session to null */
   
     return $output;
  }
}


?>