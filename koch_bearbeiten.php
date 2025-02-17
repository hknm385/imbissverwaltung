<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Koch bearbeiten</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Koch bearbeiten</h1>

    <?php
    require_once("db.inc.php");
    $kochID = (int)$_GET['id'];

    // Daten des Kochs laden
    $stmt = $mysqli->prepare("SELECT * FROM Koch WHERE kochID = ?");
    $stmt->bind_param("i", $kochID);
    $stmt->execute();
    $result = $stmt->get_result();
    $koch = $result->fetch_assoc();
    ?>

    <form action="koch_aktualisieren.php" method="post">
        <input type="hidden" name="kochID" value="<?php echo $kochID; ?>">

        <label for="nachname">Nachname:</label><br>
        <input type="text" id="nachname" name="nachname" 
               value="<?php echo htmlspecialchars($koch['nachname']); ?>" required><br><br>

        <label for="vorname">Vorname:</label><br>
        <input type="text" id="vorname" name="vorname" 
               value="<?php echo htmlspecialchars($koch['vorname']); ?>" required><br><br>

        <label for="anzahl_von_sternen">Sterne:</label><br>
        <input type="number" id="anzahl_von_sternen" name="anzahl_von_sternen" 
               value="<?php echo htmlspecialchars($koch['anzahl_von_sternen']); ?>" min="0" max="5"><br><br>

        <label for="alter_koch">Alter:</label><br>
        <input type="number" id="alter_koch" name="alter_koch" 
               value="<?php echo htmlspecialchars($koch['alter_koch']); ?>" min="18"><br><br>

        <label for="geschlecht">Geschlecht:</label><br>
        <select id="geschlecht" name="geschlecht">
            <option value="männlich" <?php echo ($koch['geschlecht'] === 'männlich' ? 'selected' : ''); ?>>Männlich</option>
            <option value="weiblich" <?php echo ($koch['geschlecht'] === 'weiblich' ? 'selected' : ''); ?>>Weiblich</option>
        </select><br><br>

        <label>Spezialgebiet/e:</label><br>
        <div class="checkbox-group">
              <?php
              require_once("db.inc.php");

              // Alle Spezialgebiete laden
              $spezialgebiete = $mysqli->query("SELECT * FROM Spezialgebiete");
              while ($row = $spezialgebiete->fetch_assoc()) {
                     // Prüfen, ob das Spezialgebiet ausgewählt ist
                     $stmt = $mysqli->prepare("
                     SELECT 1 FROM Koch_Spezialgebiete 
                     WHERE kochID = ? AND spezialgebietID = ?
                     ");
                     $stmt->bind_param("ii", $kochID, $row['spezialgebietID']);
                     $stmt->execute();
                     $checked = $stmt->get_result()->num_rows > 0 ? 'checked' : '';

                     echo '<label class="checkbox-label">';
                     echo '<input type="checkbox" name="spezialgebiete[]" value="' . $row['spezialgebietID'] . '" ' . $checked . '> ';
                     echo htmlspecialchars($row['name']);
                     echo '</label>';
              }
              $mysqli->close();
              ?>
        </div>

        <input type="submit" value="Speichern">
    </form>
</body>
</html>