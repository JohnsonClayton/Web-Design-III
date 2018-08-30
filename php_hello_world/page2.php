<?php
  require_once "mylib/Page.php";

  class Page2 extends mylib\Page {
    public function title() {
      echo "Page 2</br>";
    }
    public function content() {
      echo "This is the second page!</br><a href='index.php'>Home Page</a></br><a href='page3.php'>Page 3</a></br>";
    }
  }

  $page = new Page2();
  $page->generate();
