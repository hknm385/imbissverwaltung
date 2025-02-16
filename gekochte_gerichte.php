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
    <br>
    <a href="gericht_anlegen.php" class="button">Neues Gericht anlegen</a>
    <?php
    require_once("db.inc.php");

    // Korrigierte SQL-Abfrage mit den richtigen Spaltennamen
    $result = $mysqli->query("
        SELECT gg.gekochtesgerichtID, 
            CONCAT(k.vorname, ' ', k.nachname) AS kochname, 
            r.rezept_name AS rezeptname 
        FROM GekochtesGericht gg 
        JOIN Koch k ON gg.kochID = k.kochID 
        JOIN Rezept r ON gg.rezeptID = r.rezeptID
    ");

    if ($result->num_rows > 0) {
        echo '<div class="table-container">';
        echo '<table>';
        echo '<tr><th>ID</th><th>Koch</th><th>Rezept</th><th>Aktion</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['gekochtesgerichtID'] . '</td>';
            echo '<td>' . htmlspecialchars($row['kochname']) . '</td>';
            echo '<td>' . htmlspecialchars($row['rezeptname']) . '</td>';
            echo '<td><a href="gericht_bearbeiten.php?id=' . $row['gekochtesgerichtID'] . '">Bearbeiten</a></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    } else {
        echo "Keine gekochten Gerichte gefunden.";
    }

    $mysqli->close();
    ?>
    
</body>
</html>
