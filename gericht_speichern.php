<?php
require_once("db.inc.php");

$kochID = (int)$_POST['kochID'];
$rezeptID = (int)$_POST['rezeptID'];

$sql = "INSERT INTO GekochtesGericht (kochID, rezeptID) VALUES ($kochID, $rezeptID)";

if ($mysqli->query($sql) === TRUE) {
    echo "Neues Gericht erfolgreich angelegt.";
} else {
    echo "Fehler: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>

<a href="gekochte_gerichte.php">Zurück zur Gerichtsübersicht</a>
