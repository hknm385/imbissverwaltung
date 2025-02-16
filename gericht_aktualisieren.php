<?php
require_once("db.inc.php");

$gekochtesgerichtID = isset($_POST['gekochtesgerichtID']) ? (int)$_POST['gekochtesgerichtID'] : 0;
$kochID = isset($_POST['kochID']) ? (int)$_POST['kochID'] : 0;
$rezeptID = isset($_POST['rezeptID']) ? (int)$_POST['rezeptID'] : 0;

$sql = "UPDATE GekochtesGericht SET 
    kochID = $kochID, 
    rezeptID = $rezeptID 
    WHERE gekochtesgerichtID = $gekochtesgerichtID";

if ($mysqli->query($sql) === TRUE) {
    echo "Gericht erfolgreich aktualisiert.";
} else {
    echo "Fehler: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>

<a href="gekochte_gerichte.php">Zurück zur Gerichtsübersicht</a>
