<?php
include 'db.inc.php';

// Eingabedaten holen und validieren
$nachname = $mysqli->real_escape_string(trim($_POST['nachname']));
$vorname = $mysqli->real_escape_string(trim($_POST['vorname']));
$email = $mysqli->real_escape_string(trim($_POST['email']));
$lieblingsgericht = $mysqli->real_escape_string(trim($_POST['lieblingsgericht']));
$plz = $mysqli->real_escape_string(trim($_POST['plz']));
$ort = $mysqli->real_escape_string(trim($_POST['ort']));
$strasse = $mysqli->real_escape_string(trim($_POST['strasse']));
$strassenr = $mysqli->real_escape_string(trim($_POST['strassenr']));
$telefonnr = $mysqli->real_escape_string(trim($_POST['telefonnr']));

// Eingabedaten überprüfen
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
    echo "<a href='kunden_anlegen.php'>Zurück zum Formular</a>";
} else {
    // SQL Statement erstellen
    $sql = "INSERT INTO Kunde (nachname, vorname, email, lieblingsgericht, plz, ort, strasse, strassenr, telefonnr)
            VALUES ('$nachname', '$vorname', '$email', '$lieblingsgericht', '$plz', '$ort', '$strasse', '$strassenr', '$telefonnr')";

    // Daten in die Datenbank einfügen
    if ($mysqli->query($sql) === TRUE) {
        echo "<h2>Neuer Kunde erfolgreich angelegt.</h2>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'kunden.php';
                }, 3000);
              </script>";
    } else {
        echo "Fehler beim Einfügen: " . $mysqli->error;
    }
}

$mysqli->close();
?>
