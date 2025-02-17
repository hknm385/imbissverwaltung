<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bestellungen</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Bestellungen</h1>
    <br>
    <a href="bestellung_anlegen.php" class="button">Neue Bestellung anlegen</a>
    <?php
    require_once("db.inc.php");

    $result = $mysqli->query("SELECT 
        b.bestellungID, 
        CONCAT(k.vorname, ' ', k.nachname) AS kundenname, 
        gg.gekochtesgerichtID, 
        b.zeitpunkt, 
        b.preis, 
        b.zahlungsart 
    FROM Bestellung b 
    JOIN Kunde k ON b.kundeID = k.kundeID 
    JOIN GekochtesGericht gg ON b.gekochtesgerichtID = gg.gekochtesgerichtID");

    if ($result->num_rows > 0) {
        echo '<div class="table-container">';
        echo '<table>';
        echo '<tr><th>ID</th><th>Kunde</th><th>Gekochtes Gericht</th><th>Zeitpunkt</th><th>Preis</th><th>Zahlungsart</th><th>Aktion</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['bestellungID'] . '</td>';
            echo '<td>' . htmlspecialchars($row['kundenname']) . '</td>';
            echo '<td>' . htmlspecialchars($row['gekochtesgerichtID']) . '</td>';
            echo '<td>' . htmlspecialchars($row['zeitpunkt']) . '</td>';
            echo '<td>' . htmlspecialchars($row['preis']) . '</td>';
            echo '<td>' . htmlspecialchars($row['zahlungsart']) . '</td>';
            echo '<td><a href="bestellung_bearbeiten.php?id=' . $row['bestellungID'] . '">Bearbeiten</a></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    } else {
        echo "Keine Bestellungen gefunden.";
    }

    $mysqli->close();
    ?>
    
</body>
</html>
