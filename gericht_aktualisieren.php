<?php
require_once("db.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gerichtID = (int)$_POST['gerichtID'];
    $kochID = (int)$_POST['kochID'];
    $rezeptID = (int)$_POST['rezeptID'];

    $stmt = $mysqli->prepare("UPDATE GekochtesGericht SET kochID = ?, rezeptID = ? WHERE gekochtesgerichtID = ?");
    $stmt->bind_param("iii", $kochID, $rezeptID, $gerichtID);

    if ($stmt->execute()) {
        header("Location: gekochtes_gerichte.php");
    } else {
        die("Fehler: " . $stmt->error);
    }

    $stmt->close();
    $mysqli->close();
}
?>