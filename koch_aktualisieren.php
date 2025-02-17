<?php
require_once("db.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kochID = (int)$_POST['kochID'];
    $nachname = trim($_POST['nachname']);
    $vorname = trim($_POST['vorname']);
    $anzahl_von_sternen = (int)$_POST['anzahl_von_sternen'];
    $alter_koch = (int)$_POST['alter_koch'];
    $geschlecht = trim($_POST['geschlecht']);
    $spezialgebiet = trim($_POST['spezialgebiet']);

    // Prepared Statement für UPDATE
    $stmt = $mysqli->prepare("
        UPDATE Koch 
        SET nachname = ?, vorname = ?, anzahl_von_sternen = ?, alter_koch = ?, geschlecht = ?, spezialgebiet = ?
        WHERE kochID = ?
    ");
    $stmt->bind_param("ssiissi", 
        $nachname, 
        $vorname, 
        $anzahl_von_sternen, 
        $alter_koch, 
        $geschlecht, 
        $spezialgebiet, 
        $kochID
    );

    if ($stmt->execute()) {
        header("Location: koeche.php");
    } else {
        echo "Fehler: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>