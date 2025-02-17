<?php
require_once("db.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Eingabedaten holen und validieren
    $nachname = trim($_POST['nachname']);
    $vorname = trim($_POST['vorname']);
    $anzahl_von_sternen = (int)$_POST['anzahl_von_sternen'];
    $alter_koch = (int)$_POST['alter_koch'];
    $geschlecht = trim($_POST['geschlecht']);
    $spezialgebiete = $_POST['spezialgebiete'] ?? []; // Array von Spezialgebiet-IDs

    // Validierung
    $fehler = [];
    if (empty($nachname)) $fehler[] = "Nachname fehlt.";
    if (empty($geschlecht)) $fehler[] = "Geschlecht fehlt.";

    if (empty($fehler)) {
        try {
            // Transaktion starten
            $mysqli->begin_transaction();

            // 1. Koch in die Haupttabelle einfügen
            $stmt = $mysqli->prepare("
                INSERT INTO Koch 
                (nachname, vorname, anzahl_von_sternen, alter_koch, geschlecht) 
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->bind_param(
                "ssiis", 
                $nachname, 
                $vorname, 
                $anzahl_von_sternen, 
                $alter_koch, 
                $geschlecht
            );
            
            if (!$stmt->execute()) {
                throw new Exception("Fehler beim Speichern des Kochs: " . $stmt->error);
            }

            // 2. Letzte eingefügte Koch-ID holen
            $kochID = $mysqli->insert_id;

            // 3. Spezialgebiete verknüpfen
            // Vor dem Speichern alte Spezialgebiete des Kochs löschen
            $stmt_delete = $mysqli->prepare("DELETE FROM Koch_Spezialgebiete WHERE kochID = ?");
            $stmt_delete->bind_param("i", $kochID);
            $stmt_delete->execute();

            if (!empty($spezialgebiete)) {
                $stmt_spezial = $mysqli->prepare("
                    INSERT INTO Koch_Spezialgebiete 
                    (kochID, spezialgebietID) 
                    VALUES (?, ?)
                ");

                foreach ($spezialgebiete as $spezialgebietID) {
                    $spezialgebietID = (int)$spezialgebietID;
                    $stmt_spezial->bind_param("ii", $kochID, $spezialgebietID);
                    
                    if (!$stmt_spezial->execute()) {
                        throw new Exception("Fehler beim Speichern der Spezialgebiete: " . $stmt_spezial->error);
                    }
                }
            }


            // Alles erfolgreich → Transaktion bestätigen
            $mysqli->commit();
            header("Location: koeche.php");
            exit();

        } catch (Exception $e) {
            // Bei Fehlern: Transaktion rückgängig machen
            $mysqli->rollback();
            die("Fehler: " . $e->getMessage());
        }
    } else {
        // Fehler anzeigen
        echo "<h2>Fehler:</h2><ul>";
        foreach ($fehler as $f) {
            echo "<li>" . htmlspecialchars($f) . "</li>";
        }
        echo "</ul>";
        echo "<a href='koch_anlegen.php'>Zurück zum Formular</a>";
    }
}
?>