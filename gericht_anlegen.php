<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Gericht anlegen</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Neues Gericht anlegen</h1>

    <form action="gericht_speichern.php" method="post">
        <!-- Dropdown für Köche -->
        <label for="kochID">Koch:</label>
        <select id="kochID" name="kochID" required>
            <?php
            require_once("db.inc.php");
            $koeche = $mysqli->query("SELECT kochID, vorname, nachname FROM Koch");
            while ($row = $koeche->fetch_assoc()) {
                echo '<option value="' . $row['kochID'] . '">' 
                     . htmlspecialchars($row['vorname'] . ' ' . $row['nachname']) . '</option>';
            }
            $mysqli->close();
            ?>
        </select><br><br>

        <!-- Dropdown für Rezepte -->
        <label for="rezeptID">Rezept:</label>
        <select id="rezeptID" name="rezeptID" required>
            <?php
            require_once("db.inc.php");
            $rezepte = $mysqli->query("SELECT rezeptID, rezept_name FROM Rezept");
            while ($row = $rezepte->fetch_assoc()) {
                echo '<option value="' . $row['rezeptID'] . '">' 
                     . htmlspecialchars($row['rezept_name']) . '</option>';
            }
            $mysqli->close();
            ?>
        </select><br><br>

        <input type="submit" value="Speichern">
    </form>
</body>
</html>