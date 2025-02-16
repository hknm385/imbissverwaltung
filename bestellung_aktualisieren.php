<?php
require_once("db.inc.php");

$bestellungID = isset($_POST['bestellungID']) ? (int)$_POST['bestellungID'] : 0;
$kundeID = isset($_POST['kundeID']) ? (int)$_POST['kundeID'] : 0;
$gekochtesgerichtID = isset($_POST['gekochtesgerichtID']) ? (int)$_POST['gekochtesgerichtID'] : 0;
$zeitpunkt = isset($_POST['zeitpunkt']) ? $mysqli->real_escape_string($_POST['zeitpunkt']) : '';
$preis = isset($_POST['preis']) ? (float)$_POST['preis'] : 0;
$zahlungsart = isset($_POST['zahlungsart']) ? $mysqli->real_escape_string($_POST['zahlungsart']) : '';

$sql = "UPDATE Bestellung SET 
    kundeID = $kundeID, 
    gekochtesgerichtID = $gekochtesgerichtID, 
    zeitpunkt = '$zeitpunkt', 
    preis = $preis, 
    zahlungsart = '$zahlungsart' 
    WHERE bestellungID = $bestellungID";

if ($mysqli->query($sql) === TRUE) {
    echo "Bestellung erfolgreich aktualisiert.";
} else {
    echo "Fehler: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>

<a href="bestellungen.php">Zurück zur Bestellungsübersicht</a>
