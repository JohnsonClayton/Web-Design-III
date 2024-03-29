<?php
$query = (isset($_GET['q']) ? strval($_GET['q']) : null);  

echo "<table style='border-spacing:5px 0px;border: none;'>";
echo "<tr><th>Title</th><th>Artist</th><th>Album</th><th>Length</th><th style='display:none;'>Add</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='padding:15px; border:none;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "<td><button onClick='announceEvent(this.parentElement.parentElement.innerHTML);'>+</button></td></tr>" . "\n";
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
