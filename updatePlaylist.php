<?php

$song = (isset($_GET['song']) ? strval($_GET['song']) : null);
$artist = (isset($_GET['artist']) ? strval($_GET['artist']) : null);
$album = (isset($_GET['album']) ? strval($_GET['album']) : null);


class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:50px;border:none;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}

$login = parse_ini_file('db.ini');

$servername = "0.0.0.0";
$username = $login['username'];
$password = $login['password'];
$dbname = $login['db'];

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT title, artist, album, length FROM Music WHERE (title LIKE '$song') AND (artist LIKE '$artist') AND (album LIKE '$album');");
  $stmt->execute();

  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
}
catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";

?>
