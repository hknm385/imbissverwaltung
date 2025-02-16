<?php
include 'db.inc.php';

// Eingabedaten holen und validieren
$kundeID = (int)$_POST['kundeID'];
$nachname = $mysqli->real_escape_string(trim($_POST['nachname']));
$vorname = $mysqli->real_escape_string(trim($_POST['vorname']));
$email = $mysqli->real_escape_string(trim($_POST['email']));
$lieblingsgericht = $mysqli->real_escape_string(trim($_POST['lieblingsgericht']));
$plz = $mysqli->real_escape_string(trim($_POST['plz']));
$ort = $mysqli->real_escape_string(trim($_POST['ort']));
$strasse = $mysqli->real_escape_string(trim($_POST['strasse']));
$strassenr = $mysqli->real_escape_string(trim($_POST['strassenr']));
$telefonnr = $mysqli->real_escape_string(trim($_POST['telefonnr']));

// Eingabedaten überprüfen (analog zur Erstellung)
$fehler = [];
if (empty($nachname)) { $fehler[] = "Der Nachname darf nicht leer sein."; }
if (empty($vorname)) { $fehler[] = "Der Vorname darf nicht leer sein."; }

// Wenn es Fehler gibt, zeige sie an
if (!empty($fehler)) {
    echo "<h2>Fehler bei der Eingabe:</h2><ul>";
    foreach ($fehler as $fehlermeldung) {
        echo "<li>" . htmlspecialchars($fehlermeldung) . "</li>";
    }
    echo "</ul>";
    echo "<a href='kunde_bearbeiten.php?id=$kundeID'>Zurück zum Formular</a>";
} else {
    // SQL Update Statement
    $sql = "UPDATE Kunde SET
            nachname = '$nachname',
            vorname = '$vorname',
            email = '$email',
            lieblingsgericht = '$lieblingsgericht',
            plz = '$plz',
            ort = '$ort',
            strasse = '$strasse',
            strassenr = '$strassenr',
            telefonnr = '$telefonnr'
            WHERE kundeID = $kundeID";

    if ($mysqli->query($sql) === TRUE) {
        echo "<h2>Daten erfolgreich aktualisiert.</h2>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'kunden.php';
                }, 3000);
              </script>";
    } else {
        echo "Fehler bei der Aktualisierung: " . $mysqli->error;
    }
}

$mysqli->close();
?>
