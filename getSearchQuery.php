<?php
$query = (isset($_GET['q']) ? strval($_GET['q']) : null);  

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Title</th><th>Artist</th><th>Album</th><th>Length</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}

$servername = "0.0.0.0";
$username = "root";
$password = "1234";
$dbname = "KMSA";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT title, artist, album, length FROM Music WHERE (title LIKE '%$query%') OR (artist LIKE '%$query%') OR (album LIKE '%$query%');");
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
