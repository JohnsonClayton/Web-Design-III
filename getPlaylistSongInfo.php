<?php
$name = (isset($_GET['name']) ? strval($_GET['name']) : null);
$artist = (isset($_GET['artist']) ? strval($_GET['artist']) : null);

$login = parse_ini_file('db.ini');

$servername = "0.0.0.0";
$username = $login['username'];
$password = $login['password'];
$dbname = $login['db'];
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT votes FROM Playlist WHERE (title LIKE $name) AND (artist LIKE $artist);");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

$test = $stmt->fetchAll()[0]['votes'];
echo "$test";
$conn = null;
?>
