<?php
require_once("db.inc.php");

$name = $mysqli->real_escape_string($_POST['rezept_name']);
$dauer = (int)$_POST['dauer'];
$speiseart = $mysqli->real_escape_string($_POST['speiseart']);
$rezeptbeschreibung = $mysqli->real_escape_string($_POST['rezeptbeschreibung']);

$sql = "INSERT INTO Rezept (name, dauer, speiseart, rezeptbeschreibung) VALUES ('$name', '$dauer', '$speiseart', '$rezeptbeschreibung')";

if ($mysqli->query($sql) === TRUE) {
    echo "Neues Rezept erfolgreich angelegt.";
} else {
    echo "Fehler: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>
<?php
// ... Insert ausgeführt ...

// Hier beenden wir ggf. den PHP-Block und schreiben HTML
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Bestellung gespeichert</title>
  <link rel="stylesheet" href="styles.css">
  <!-- Automatischer Seitenwechsel nach 3 Sekunden -->
  <meta http-equiv="refresh" content="3;url=bestellungen.php" />
</head>
<body>
  <?php include("navigation.inc.php"); ?>
  <div class="success">
    Neue Bestellung erfolgreich angelegt. <br>
    <a href="bestellungen.php">Zurück zur Bestellungsübersicht</a>
  </div>
</body>
</html>

<a href="rezepte.php">Zurück zur Rezeptübersicht</a>
