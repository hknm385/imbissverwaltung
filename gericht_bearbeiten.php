<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Gericht bearbeiten</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Gericht bearbeiten</h1>

    <?php
    require_once("db.inc.php");

    $gekochtesgerichtID = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($gekochtesgerichtID > 0) {
        $result = $mysqli->query("SELECT * FROM GekochtesGericht WHERE gekochtesgerichtID = $gekochtesgerichtID");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Koch-Auswahl
            $kochResult = $mysqli->query("SELECT kochID, CONCAT(nachname, ' ', vorname) AS kochname FROM Koch");

            // Rezept-Auswahl
            $rezeptResult = $mysqli->query("SELECT rezeptID, name FROM Rezept");
            ?>
            <form action="gericht_aktualisieren.php" method="post">
                <input type="hidden" name="gekochtesgerichtID" value="<?php echo $row['gekochtesgerichtID']; ?>">
                <label for="kochID">Koch:</label>
                <select id="kochID" name="kochID" required>
                    <?php while ($kochRow = $kochResult->fetch_assoc()) { ?>
                        <option value="<?php echo $kochRow['kochID']; ?>" <?php echo ($kochRow['kochID'] == $row['kochID']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($kochRow['kochname']); ?>
                        </option>
                    <?php } ?>
                </select>
                <br>
                <label for="rezeptID">Rezept:</label>
                <select id="rezeptID" name="rezeptID" required>
                    <?php while ($rezeptRow = $rezeptResult->fetch_assoc()) { ?>
                        <option value="<?php echo $rezeptRow['rezeptID']; ?>" <?php echo ($rezeptRow['rezeptID'] == $row['rezeptID']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($rezeptRow['name']); ?>
                        </option>
                    <?php } ?>
                </select>
                <br>
                <input type="submit" value="Aktualisieren">
            </form>
            <?php
        } else {
            echo "Gericht nicht gefunden.";
        }
    } else {
        echo "Ungültige Gericht-ID.";
    }

    $mysqli->close();
    ?>
    <a href="gekochte_gerichte.php">Zurück zur Gerichtsübersicht</a>
</body>
</html>
