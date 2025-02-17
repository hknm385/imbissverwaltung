<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neuen Koch anlegen</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Neuen Koch anlegen</h1>
    <form action="koch_speichern.php" method="post">
        <label for="nachname">Nachname:</label><br>
        <input type="text" id="nachname" name="nachname" 
               value="<?php echo htmlspecialchars($_POST['nachname'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
               required><br><br>

        <label for="vorname">Vorname:</label><br>
        <input type="text" id="vorname" name="vorname" 
               value="<?php echo htmlspecialchars($_POST['vorname'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
               required><br><br>

        <label for="anzahl_von_sternen">Anzahl von Sternen:</label><br>
        <input type="number" id="anzahl_von_sternen" name="anzahl_von_sternen" 
               value="<?php echo htmlspecialchars($_POST['anzahl_von_sternen'] ?? 0, ENT_QUOTES, 'UTF-8'); ?>" 
               min="0" max="5"><br><br>

        <label for="alter_koch">Alter:</label><br>
        <input type="number" id="alter_koch" name="alter_koch" 
               value="<?php echo htmlspecialchars($_POST['alter_koch'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" 
               min="18"><br><br>

        <label for="geschlecht">Geschlecht:</label><br>
        <select id="geschlecht" name="geschlecht">
            <option value="männlich" <?php echo (($_POST['geschlecht'] ?? '') === 'männlich' ? 'selected' : ''); ?>>Männlich</option>
            <option value="weiblich" <?php echo (($_POST['geschlecht'] ?? '') === 'weiblich' ? 'selected' : ''); ?>>Weiblich</option>
        </select><br><br>

        <label>Spezialgebiet/e:</label><br>
       <div class="checkbox-group">
              <?php
              require_once("db.inc.php");
              $spezialgebiete = $mysqli->query("SELECT * FROM Spezialgebiete");
              while ($row = $spezialgebiete->fetch_assoc()) {
                     echo '<label class="checkbox-label">';
                     echo '<input type="checkbox" name="spezialgebiete[]" value="' . $row['spezialgebietID'] . '"> ';
                     echo htmlspecialchars($row['name']);
                     echo '</label>';
              }
              $mysqli->close();
              ?>
       </div>

        <input type="submit" value="Koch hinzufügen">
    </form>
</body>
</html>