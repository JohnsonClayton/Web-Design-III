<?php
$song = (isset($_GET['song']) ? strval($_GET['song']) : null);
$artist = (isset($_GET['artist']) ? strval($_GET['artist']) : null);
$album = (isset($_GET['album']) ? strval($_GET['album']) : null);
$length = (isset($_GET['length']) ? intval($_GET['length']) : null);
$votes = 0;

echo "Reached";

$servername = "0.0.0.0";
$username = "root";
$password = "1234";
$dbname = "KMSA";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("INSERT INTO Playlist VALUES('$song', '$artist', '$album', $length, $votes);");
  $stmt->execute();
  echo "Executed!";
}
catch (PDOException $e) {
  echo "error: " . $e->getMessage();
}
$conn = null;


?>
