<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neues Gericht anlegen</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Neues Gericht anlegen</h1>

    <?php
    require_once("db.inc.php");

    // Koch-Auswahl
    $kochResult = $mysqli->query("SELECT kochID, CONCAT(nachname, ' ', vorname) AS kochname FROM Koch");

    // Rezept-Auswahl
    $rezeptResult = $mysqli->query("SELECT rezeptID, name FROM Rezept");
    ?>

    <form action="gericht_speichern.php" method="post">
        <label for="kochID">Koch:</label>
        <select id="kochID" name="kochID" required>
            <?php while ($kochRow = $kochResult->fetch_assoc()) { ?>
                <option value="<?php echo $kochRow['kochID']; ?>"><?php echo htmlspecialchars($kochRow['kochname']); ?></option>
            <?php } ?>
        </select>
        <br>
        <label for="rezeptID">Rezept:</label>
        <select id="rezeptID" name="rezeptID" required>
            <?php while ($rezeptRow = $rezeptResult->fetch_assoc()) { ?>
                <option value="<?php echo $rezeptRow['rezeptID']; ?>"><?php echo htmlspecialchars($rezeptRow['name']); ?></option>
            <?php } ?>
        </select>
        <br>
        <input type="submit" value="Speichern">
    </form>
</body>
</html>
