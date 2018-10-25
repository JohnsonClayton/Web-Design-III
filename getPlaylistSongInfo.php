<?php
$name = (isset($_GET['name']) ? strval($_GET['name']) : null);
$artist = (isset($_GET['artist']) ? strval($_GET['artist']) : null);

$servername = "0.0.0.0";
$username = "root";
$password = "1234";
$dbname = "KMSA";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT votes FROM Playlist WHERE (title LIKE $name) AND (artist LIKE $artist);");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
//echo $result;
//$arr = $stmt->fetchAll();
//echo $stmt->fetchAll();
$test = $stmt->fetchAll()[0]['votes'];
echo "$test";
$conn = null;
?>
