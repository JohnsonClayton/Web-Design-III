<?php
while(true) {
  playSong();
}

function playSong() {

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
    $artist = $results['artist'];
    $votes = $results['votes'];
    $waitTime = $results['length'];

    $conn = null;

    if($votes >= 0) {
      sleep($waitTime);
    }

    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("DELETE FROM Playlist WHERE (title LIKE '$title') AND (artist LIKE '$artist');"); 
    $stmt->execute();
   
  } catch (PDOException $e) {
    echo "error: " . $e->getMessage();
  }
  $conn = null;
}


