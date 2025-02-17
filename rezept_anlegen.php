<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neues Rezept anlegen</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Neues Rezept anlegen</h1>
    <form action="rezept_speichern.php" method="post">
        <label for="rezept_name">Rezeptname:</label><br>
        <input type="text" id="rezept_name" name="rezept_name" 
               value="<?php echo htmlspecialchars($_POST['rezept_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
               required><br><br>

        <label for="dauer">Dauer (Minuten):</label><br>
        <input type="number" id="dauer" name="dauer" 
               value="<?php echo htmlspecialchars($_POST['dauer'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
               required><br><br>

        <label for="speiseart">Speiseart:</label><br>
        <select id="speiseart" name="speiseart">
            <?php
            // Optionen dynamisch aus der Datenbank laden (z. B. "Hauptgericht", "Dessert")
            require_once("db.inc.php");
            $speisearten = $mysqli->query("SELECT DISTINCT speiseart FROM Rezept");
            while ($row = $speisearten->fetch_assoc()) {
                $selected = (($_POST['speiseart'] ?? '') === $row['speiseart'] ? 'selected' : '');
                echo '<option value="' . htmlspecialchars($row['speiseart'], ENT_QUOTES, 'UTF-8') . '" ' . $selected . '>' 
                     . htmlspecialchars($row['speiseart'], ENT_QUOTES, 'UTF-8') . '</option>';
            }
            $mysqli->close();
            ?>
        </select><br><br>

        <label for="rezeptbeschreibung">Beschreibung:</label><br>
        <textarea id="rezeptbeschreibung" name="rezeptbeschreibung"><?php 
            echo htmlspecialchars($_POST['rezeptbeschreibung'] ?? '', ENT_QUOTES, 'UTF-8'); 
        ?></textarea><br><br>

        <input type="submit" value="Rezept hinzufügen">
    </form>
</body>
</html>