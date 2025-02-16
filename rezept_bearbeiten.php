<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Rezept bearbeiten</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Rezept bearbeiten</h1>

    <?php
    require_once("db.inc.php");

    $rezeptID = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($rezeptID > 0) {
        $result = $mysqli->query("SELECT * FROM Rezept WHERE rezeptID = $rezeptID");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form action="rezept_aktualisieren.php" method="post">
                <input type="hidden" name="rezeptID" value="<?php echo $row['rezeptID']; ?>">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br>
                <label for="dauer">Dauer:</label>
                <input type="number" id="dauer" name="dauer" value="<?php echo $row['dauer']; ?>" required><br>
                <label for="speiseart">Speiseart:</label>
                <input type="text" id="speiseart" name="speiseart" value="<?php echo htmlspecialchars($row['speiseart']); ?>" required><br>
                <label for="rezeptbeschreibung">Beschreibung:</label>
                <textarea id="rezeptbeschreibung" name="rezeptbeschreibung" required><?php echo htmlspecialchars($row['rezeptbeschreibung']); ?></textarea><br>
                <input type="submit" value="Aktualisieren">
            </form>
            <?php
        } else {
            echo "Rezept nicht gefunden.";
        }
    } else {
        echo "Ungültige Rezept-ID.";
    }

    $mysqli->close();
    ?>
    <a href="rezepte.php">Zurück zur Rezeptübersicht</a>
</body>
</html>
