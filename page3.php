<?php
  require_once "mylib/Page.php";

  class Page3 extends mylib\Page {
    public function title() {
      echo "This is the third page</br>";
    }
    public function content() {
      echo "<a href='index.php'>Go home</a></br><a href='page2.php'>Check out page 2 again!</a></br>";
    }
  }

  $page = new Page3();
  $page->generate();
