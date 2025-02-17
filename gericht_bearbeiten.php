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
    $gerichtID = (int)$_GET['id'];

    // Gerichtdaten laden
    $stmt = $mysqli->prepare("SELECT kochID, rezeptID FROM GekochtesGericht WHERE gekochtesgerichtID = ?");
    $stmt->bind_param("i", $gerichtID);
    $stmt->execute();
    $result = $stmt->get_result();
    $gericht = $result->fetch_assoc();
    ?>

    <form action="gericht_aktualisieren.php" method="post">
        <input type="hidden" name="gerichtID" value="<?php echo $gerichtID; ?>">

        <!-- Dropdown für Köche -->
        <label for="kochID">Koch:</label>
        <select id="kochID" name="kochID" required>
            <?php
            $koeche = $mysqli->query("SELECT kochID, vorname, nachname FROM Koch");
            while ($row = $koeche->fetch_assoc()) {
                $selected = ($row['kochID'] == $gericht['kochID']) ? 'selected' : '';
                echo '<option value="' . $row['kochID'] . '" ' . $selected . '>' 
                     . htmlspecialchars($row['vorname'] . ' ' . $row['nachname']) . '</option>';
            }
            ?>
        </select><br><br>

        <!-- Dropdown für Rezepte -->
        <label for="rezeptID">Rezept:</label>
        <select id="rezeptID" name="rezeptID" required>
            <?php
            $rezepte = $mysqli->query("SELECT rezeptID, rezept_name FROM Rezept");
            while ($row = $rezepte->fetch_assoc()) {
                $selected = ($row['rezeptID'] == $gericht['rezeptID']) ? 'selected' : '';
                echo '<option value="' . $row['rezeptID'] . '" ' . $selected . '>' 
                     . htmlspecialchars($row['rezept_name']) . '</option>';
            }
            ?>
        </select><br><br>

        <input type="submit" value="Speichern">
    </form>

    <?php $mysqli->close(); ?>
</body>
</html>