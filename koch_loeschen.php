<?php
require_once("db.inc.php");

if (isset($_GET['id'])) {
    $kochID = (int)$_GET['id'];

    // Prepared Statement für DELETE
    $stmt = $mysqli->prepare("DELETE FROM Koch WHERE kochID = ?");
    $stmt->bind_param("i", $kochID);

    if ($stmt->execute()) {
        header("Location: koeche.php");
    } else {
        echo "Fehler: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>