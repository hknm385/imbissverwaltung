<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Gekochte Gerichte</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Gekochte Gerichte</h1>
    
    <a href="gericht_anlegen.php" class="button">Neues Gericht anlegen</a><br><br>

    <?php
    require_once("db.inc.php");

    // Alle Gerichte mit Koch- und Rezeptdaten laden
    $sql = "SELECT 
                gg.gekochtesgerichtID,
                k.vorname AS koch_vorname,
                k.nachname AS koch_nachname,
                r.rezept_name
            FROM GekochtesGericht gg
            JOIN Koch k ON gg.kochID = k.kochID
            JOIN Rezept r ON gg.rezeptID = r.rezeptID";

    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Koch</th><th>Rezept</th><th>Aktion</th></tr>';
        
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['gekochtesgerichtID'] . '</td>';
            echo '<td>' . htmlspecialchars($row['koch_vorname']) . ' ' . htmlspecialchars($row['koch_nachname']) . '</td>';
            echo '<td>' . htmlspecialchars($row['rezept_name']) . '</td>';
            echo '<td>
                    <a href="gericht_bearbeiten.php?id=' . $row['gekochtesgerichtID'] . '">Bearbeiten</a> 
                    <a href="gericht_loeschen.php?id=' . $row['gekochtesgerichtID'] . '" onclick="return confirm(\'Wirklich löschen?\')">Löschen</a>
                  </td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "Keine Einträge gefunden.";
    }

    $mysqli->close();
    ?>
</body>
</html>