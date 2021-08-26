<?php
   session_start();
   
   //destroy sessions upon logout
   if(session_destroy()) {
     echo "<script>setTimeout(\"location.href = 'index.php';\",800);</script>";
   }
?>