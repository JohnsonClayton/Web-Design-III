<?php
  include "mylib/Generator.php";

  $name="Clayton";
  $names = array("Alice", "Bob", "Cindy", "Alexander", "Joey");
  $cmd="Num is <?php echo rand(); ?> <br>";
  function sayHi(&$who) {
    echo "<br>Hi $who!\n";
    $who = "nobody";
  }
  
  class Page extends mylib\Generator {
    private function header() {
      echo "<html><title>No Title</title>";
    }
    private function footer() {
      echo "</html>";
    }
    private function body() {
      echo "<body>this is the body</body>";
    }
    public function generate() {
      $this->header();
      $this->body();
      $this->footer();
    }
  }

  $page = new Page();
  $page->generate();
?>
<html>
  Hi, <?php echo $name ?>!<br>
  Num is <?php echo rand(); ?> <br>

  <?php
  foreach ($names as $id=>$name) {
    echo "before $name\n";
    sayHi($name);
    echo "after $name\n";
  }
  ?>
</html>
