<?php
  $query = (isset($_GET['q']) ? strval($_GET['q']) : null);  

  echo "<h1>".$query."</h1>";
?>
