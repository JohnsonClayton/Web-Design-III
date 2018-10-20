<?php
  require_once "mylib/Page.php";
  class KMSAVoting extends mylib\Page {
    public function head() {
      echo "<head>";
      $this->title();
      echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' type='text/css' href='./media/kmsaapp.css'>
            <script type='text/javascript' src='./js/kmsaapp.js'></script>";
      echo "</head>";
    }
    public function title() {
      echo "<title>KMSA App</title>";
    }
    
    public function buildPage() {
      $this->head();
      $this->content();
      $this->footer();
    }

    public function content() {
      $this->buildRow1();
      $this->buildRow2();
    }

    public function buildRow1() {
      echo "<div class='row'>
        <div id='current-container-outer' class='col-8'>";
      $this->buildCurrentSong();
      echo "</div>";
      echo "<div class='col-4'>";
      $this->buildPlaylist();
      echo "</div></div>";
    }

    public function buildRow2() {
      echo "<div class='row'>
        <div class='col-5'>";
      $this->buildSearchBar();
      echo "</div>";
      echo "<div class='col-7'>";
      $this->buildSearchResults();
      echo "</div></div>";
    }

    public function buildCurrentSong() {
      echo "<div id='current-container-inner' class='col-8'></div>";

    }

    public function buildPlaylist() {


    }

    public function buildSearchBar() {
      echo "<h3>Add Songs to the Playlist!</h3>";
      echo "<label>Search for a song: <input type='text' id='searchQuery'>";
      echo "<button id='searchQuerySubmit' onClick='updateSearchTable();'>Go!</button>";

    }

    public function buildSearchResults() {
      echo "<div id='searchQueryResults'></div>";
    }

    public function addListeners() {

    }

    public function generate() {
      $this->buildPage();
      $this->addListeners();
    }

  }

  $page = new KMSAVoting();
  $page->generate();
 
