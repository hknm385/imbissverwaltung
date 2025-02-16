<?php
require_once("db.inc.php");

$rezeptID = isset($_POST['rezeptID']) ? (int)$_POST['rezeptID'] : 0;
$name = $mysqli->real_escape_string($_POST['name']);
$dauer = (int)$_POST['dauer'];
$speiseart = $mysqli->real_escape_string($_POST['speiseart']);
$rezeptbeschreibung = $mysqli->real_escape_string($_POST['rezeptbeschreibung']);

$sql = "UPDATE Rezept SET 
    name = '$name', 
    dauer = $dauer, 
    speiseart = '$speiseart', 
    rezeptbeschreibung = '$rezeptbeschreibung'
    WHERE rezeptID = $rezeptID";

if ($mysqli->query($sql) === TRUE) {
    echo "Rezept erfolgreich aktualisiert.";
} else {
    echo "Fehler: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>

<a href="rezepte.php">Zurück zur Rezeptübersicht</a>
