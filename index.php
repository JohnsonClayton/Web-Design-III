<?php
  require_once "mylib/Page.php";

  class ThisPage extends mylib\Page {
    public function title() { 
      echo "Welcome to the Home Page</br>\n"; 
    }
    public function content() { 
      echo "<a href='page2.php'>Page 2</a></br><a href='page3.php'>Page 3</a></br>"; 
    }
  }

  $page = new ThisPage();
  $page->generate();
?>
