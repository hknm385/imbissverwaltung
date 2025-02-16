<?php
require_once("db.inc.php");

$kundeID = (int)$_POST['kundeID'];
$gekochtesgerichtID = (int)$_POST['gekochtesgerichtID'];
$zeitpunkt = $mysqli->real_escape_string($_POST['zeitpunkt']);
$preis = (float)$_POST['preis'];
$zahlungsart = $mysqli->real_escape_string($_POST['zahlungsart']);

$sql = "INSERT INTO Bestellung (kundeID, gekochtesgerichtID, zeitpunkt, preis, zahlungsart) VALUES ($kundeID, $gekochtesgerichtID, '$zeitpunkt', $preis, '$zahlungsart')";

if ($mysqli->query($sql) === TRUE) {
    echo "Neue Bestellung erfolgreich angelegt.";
} else {
    echo "Fehler: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>

<a href="bestellungen.php">Zurück zur Bestellungsübersicht</a>
