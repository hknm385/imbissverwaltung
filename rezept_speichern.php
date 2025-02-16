<?php
require_once("db.inc.php");

$name = $mysqli->real_escape_string($_POST['name']);
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

<a href="rezepte.php">Zurück zur Rezeptübersicht</a>
