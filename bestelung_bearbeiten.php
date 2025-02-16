<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bestellung bearbeiten</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Bestellung bearbeiten</h1>

    <?php
    require_once("db.inc.php");

    $bestellungID = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($bestellungID > 0) {
        $result = $mysqli->query("SELECT * FROM Bestellung WHERE bestellungID = $bestellungID");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Kunden-Auswahl
            $kundeResult = $mysqli->query("SELECT kundeld, CONCAT(nachname, ' ', vorname) AS kundenname FROM Kunde");

            // Gekochtes Gericht-Auswahl
            $gerichtResult = $mysqli->query("SELECT gg.gekochtesgerichtID, k.nachname AS kochname, r.name AS rezeptname 
                                             FROM GekochtesGericht gg 
                                             JOIN Koch k ON gg.kochID = k.kochID 
                                             JOIN Rezept r ON gg.rezeptID = r.rezeptID");
            ?>
            <form action="bestellung_aktualisieren.php" method="post">
                <input type="hidden" name="bestellungID" value="<?php echo $row['bestellungID']; ?>">
                <label for="kundeID">Kunde:</label>
                <select id="kundeID" name="kundeID" required>
                    <?php while ($kundeRow = $kundeResult->fetch_assoc()) { ?>
                        <option value="<?php echo $kundeRow['kundeld']; ?>" <?php echo ($kundeRow['kundeld'] == $row['kundeID']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($kundeRow['kundenname']); ?>
                        </option>
                    <?php } ?>
                </select>
                <br>
                <label for="gekochtesgerichtID">Gekochtes Gericht:</label>
                <select id="gekochtesgerichtID" name="gekochtesgerichtID" required>
                    <?php while ($gerichtRow = $gerichtResult->fetch_assoc()) { ?>
                        <option value="<?php echo $gerichtRow['gekochtesgerichtID']; ?>" <?php echo ($gerichtRow['gekochtesgerichtID'] == $row['gekochtesgerichtID']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($gerichtRow['kochname']) . ' - ' . htmlspecialchars($gerichtRow['rezeptname']); ?>
                        </option>
                    <?php } ?>
                </select>
                <br>
                <label for="zeitpunkt">Zeitpunkt:</label>
                <input type="datetime-local" id="zeitpunkt" name="zeitpunkt" value="<?php echo date('Y-m-d\TH:i', strtotime($row['zeitpunkt'])); ?>" required><br>
                <label for="preis">Preis:</label>
                <input type="number" id="preis" name="preis" step="0.01" value="<?php echo $row['preis']; ?>" required><br>
                <label for="zahlungsart">Zahlungsart:</label>
                <select id="zahlungsart" name="zahlungsart" required>
                    <option value="bargeld" <?php echo ($row['zahlungsart'] == 'bargeld') ? 'selected' : ''; ?>>Bargeld</option>
                    <option value="karte" <?php echo ($row['zahlungsart'] == 'karte') ? 'selected' : ''; ?>>Karte</option>
                    <option value="gutschein" <?php echo ($row['zahlungsart'] == 'gutschein') ? 'selected' : ''; ?>>Gutschein</option>
                </select>
                <br>
                <input type="submit" value="Aktualisieren">
            </form>
            <?php
        } else {
            echo "Bestellung nicht gefunden.";
        }
    } else {
        echo "Ungültige Bestellungs-ID.";
    }

    $mysqli->close();
    ?>
    <a href="bestellungen.php">Zurück zur Bestellungsübersicht</a>
</body>
</html>
