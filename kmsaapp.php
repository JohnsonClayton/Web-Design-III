<?php
  require_once "mylib/Page.php";
  class KMSAVoting extends mylib\Page {
    public function head() {
      echo "<head>";
      $this->title();
      echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' type='text/css' href='./media/kmsaapp.css'>";
      echo "</head>";
    }
    public function title() {
      echo "<title>KMSA App</title>";
    }
    public function content() {
      echo "<div class='row'>
      <div class='col-8'></div>
      <div class='col-4'></div>
    </div>
      <div class='row'>
        <div class='col-5'></div>
        <div class='col-7'></div>
      </div>";

    }
  }

  $page = new KMSAVoting();
  $page->generate();
