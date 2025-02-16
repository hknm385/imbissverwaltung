<?php
include 'db.inc.php';

// Eingabedaten holen und validieren
$kochID = (int)$_POST['kochID'];
$nachname = $mysqli->real_escape_string(trim($_POST['nachname']));
$vorname = $mysqli->real_escape_string(trim($_POST['vorname']));
$anzahl_von_sternen = isset($_POST['anzahl_von_sternen']) ? (int)$_POST['anzahl_von_sternen'] : 0;
$alter_koch = isset($_POST['alter_koch']) ? (int)$_POST['alter_koch'] : null;
$geschlecht = $mysqli->real_escape_string($_POST['geschlecht']);
$spezialgebiete = isset($_POST['spezialgebiet']) ? $_POST['spezialgebiet'] : [];
$spezialgebiet = implode(',', array_map([$mysqli, 'real_escape_string'], $spezialgebiete));

// Eingabedaten überprüfen (analog zur Erstellung)
$fehler = [];
if (empty($nachname)) { $fehler[] = "Der Nachname darf nicht leer sein."; }
if (empty($vorname)) { $fehler[] = "Der Vorname darf nicht leer sein."; }
if ($alter_koch !== null && $alter_koch < 18) { $fehler[] = "Der Koch muss mindestens 18 Jahre alt sein."; }
if (!in_array($geschlecht, ['männlich', 'weiblich'])) { $fehler[] = "Ungültige Geschlechtsangabe."; }

// Wenn es Fehler gibt, zeige sie an
if (!empty($fehler)) {
    echo "<h2>Fehler bei der Eingabe:</h2><ul>";
    foreach ($fehler as $fehlermeldung) {
        echo "<li>" . htmlspecialchars($fehlermeldung) . "</li>";
    }
    echo "</ul>";
    echo "<a href='koch_bearbeiten.php?id=$kochID'>Zurück zum Formular</a>";
} else {
    // SQL Update Statement
    $sql = "UPDATE Koch SET
            nachname = '$nachname',
            vorname = '$vorname',
            anzahl_von_sternen = $anzahl_von_sternen,
            alter_koch = $alter_koch,
            geschlecht = '$geschlecht',
            spezialgebiet = '$spezialgebiet'
            WHERE kochID = $kochID";

    if ($mysqli->query($sql) === TRUE) {
        echo "<h2>Daten erfolgreich aktualisiert.</h2>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'koeche.php';
                }, 3000);
              </script>";
    } else {
        echo "Fehler bei der Aktualisierung: " . $mysqli->error;
    }
}

$mysqli->close();
?>
