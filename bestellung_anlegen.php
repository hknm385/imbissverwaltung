<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neue Bestellung anlegen</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Neue Bestellung anlegen</h1>

    <?php
    require_once("db.inc.php");

    // Kunden-Auswahl
    $kundeResult = $mysqli->query("SELECT kundeld, CONCAT(nachname, ' ', vorname) AS kundenname FROM Kunde");

    // Gekochtes Gericht-Auswahl
    $gerichtResult = $mysqli->query("SELECT gg.gekochtesgerichtID, k.nachname AS kochname, r.name AS rezeptname 
                                     FROM GekochtesGericht gg 
                                     JOIN Koch k ON gg.kochID = k.kochID 
                                     JOIN Rezept r ON gg.rezeptID = r.rezeptID");
    ?>

    <form action="bestellung_speichern.php" method="post">
        <label for="kundeID">Kunde:</label>
        <select id="kundeID" name="kundeID" required>
            <?php while ($kundeRow = $kundeResult->fetch_assoc()) { ?>
                <option value="<?php echo $kundeRow['kundeld']; ?>"><?php echo htmlspecialchars($kundeRow['kundenname']); ?></option>
            <?php } ?>
        </select>
        <br>
        <label for="gekochtesgerichtID">Gekochtes Gericht:</label>
        <select id="gekochtesgerichtID" name="gekochtesgerichtID" required>
            <?php while ($gerichtRow = $gerichtResult->fetch_assoc()) { ?>
                <option value="<?php echo $gerichtRow['gekochtesgerichtID']; ?>"><?php echo htmlspecialchars($gerichtRow['kochname']) . ' - ' . htmlspecialchars($gerichtRow['rezeptname']); ?></option>
            <?php } ?>
        </select>
        <br>
        <label for="zeitpunkt">Zeitpunkt:</label>
        <input type="datetime-local" id="zeitpunkt" name="zeitpunkt" required><br>
        <label for="preis">Preis:</label>
        <input type="number" id="preis" name="preis" step="0.01" required><br>
        <label for="zahlungsart">Zahlungsart:</label>
        <select id="zahlungsart" name="zahlungsart" required>
            <option value="bargeld">Bargeld</option>
            <option value="karte">Karte</option>
            <option value="gutschein">Gutschein</option>
        </select>
        <br>
        <input type="submit" value="Speichern">
    </form>
</body>
</html>
