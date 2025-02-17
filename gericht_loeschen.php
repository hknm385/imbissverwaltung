<?php
require_once("db.inc.php");

if (isset($_GET['id'])) {
    $gerichtID = (int)$_GET['id'];

    $stmt = $mysqli->prepare("DELETE FROM GekochtesGericht WHERE gekochtesgerichtID = ?");
    $stmt->bind_param("i", $gerichtID);

    if ($stmt->execute()) {
        header("Location: gekochtes_gerichte.php");
    } else {
        die("Fehler: " . $stmt->error);
    }

    $stmt->close();
    $mysqli->close();
}
?>