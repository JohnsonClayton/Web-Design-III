<?php
if($_GET['cmd'] == 1) {
  getCurrentPlaylist();
}
if($_GET['update'] == 1) {
  getCurrentSong();
}
function getCurrentPlaylist() {

  class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
      parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
      return "<td style='padding:5px;border:none;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
      echo "<tr>";
    }

    function endChildren() {
      echo "<td><button onClick='voteUp(this)'>Up</button><button onClick='voteDown(this)'>Down</button></td></tr>" . "\n";
    }
  }

  $servername = "0.0.0.0";
  $username = "root";
  $password = "1234";
  $dbname = "KMSA";
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT title, artist, votes FROM Playlist;");
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
      echo $v;
    }
  }
  catch (PDOException $e) {
    echo "error: " . $e->getMessage();
  }
  $conn = null;
}

function getCurrentSong() {

  $servername = "0.0.0.0";
  $username = "root";
  $password = "1234";
  $dbname = "KMSA";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM Playlist LIMIT 1;");
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
    $results = $stmt->fetchAll()[0];
    $title = $results['title'];
    $waitTime = $results['length'];

    echo $title . " " .$waitTime;
    
  } catch (PDOException $e) {
    echo "error: " . $e->getMessage();
  }
  $conn = null;
}


