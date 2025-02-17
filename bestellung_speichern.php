<?php
ob_start(); // Output Buffering starten
require_once("db.inc.php");

// Daten aus dem Formular sichern und verarbeiten
$kundeID     = $mysqli->real_escape_string($_POST['kundeID']);
$gerichtID   = $mysqli->real_escape_string($_POST['gekochtesgerichtID']);
$zahlungsart = $mysqli->real_escape_string($_POST['zahlungsart']);
$zeitpunkt   = $mysqli->real_escape_string($_POST['zeitpunkt']);
$preis       = (float)$_POST['preis'];

$sql = "INSERT INTO Bestellung (kundeID, gekochtesgerichtID, zahlungsart, zeitpunkt, preis)
        VALUES ('$kundeID', '$gerichtID', '$zahlungsart', '$zeitpunkt', '$preis')";

if ($mysqli->query($sql) === TRUE) {
    $message = "Neue Bestellung erfolgreich angelegt.";
} else {
    $message = "Fehler beim Anlegen der Bestellung: " . $mysqli->error;
}

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="de">
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
    <h1><?php echo htmlspecialchars($message); ?></h1>
    <p><a href="bestellungen.php">Zurück zur Bestellungsübersicht</a></p>
  </div>
</body>
</html>
