<?php
$name = (isset($_GET['name']) ? strval($_GET['name']) : null);
$artist = (isset($_GET['artist']) ? strval($_GET['artist']) : null);
$votes = (isset($_GET['votes']) ? intval($_GET['votes']) : null);

echo "$name $artist $votes";

$servername = "0.0.0.0";
$username = "root";
$password = "1234";
$dbname = "KMSA";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("UPDATE Playlist SET votes=$votes WHERE (title LIKE $name) AND (artist LIKE $artist);");
$stmt->execute();
$conn = null;
?>
