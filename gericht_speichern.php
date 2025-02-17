<?php
require_once("db.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kochID = (int)$_POST['kochID'];
    $rezeptID = (int)$_POST['rezeptID'];

    $stmt = $mysqli->prepare("INSERT INTO GekochtesGericht (kochID, rezeptID) VALUES (?, ?)");
    $stmt->bind_param("ii", $kochID, $rezeptID);

    if ($stmt->execute()) {
        header("Location: gekochte_gerichte.php");
    } else {
        die("Fehler: " . $stmt->error);
    }

    $stmt->close();
    $mysqli->close();
}
?>