<?php
include 'db.inc.php';

$kochID = (int)$_GET['id'];

// Koch-Daten aus der Datenbank holen
$sql = "SELECT * FROM Koch WHERE kochID = $kochID";
$result = $mysqli->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $spezialgebiete = explode(',', $row['spezialgebiet']);
    ?>
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
        <form action="koch_aktualisieren.php" method="post">
            <input type="hidden" name="kochID" value="<?php echo $row['kochID']; ?>">
            <label for="nachname">Nachname:</label><br>
            <input type="text" id="nachname" name="nachname" value="<?php echo htmlspecialchars($row['nachname']); ?>" required><br><br>
            <label for="vorname">Vorname:</label><br>
            <input type="text" id="vorname" name="vorname" value="<?php echo htmlspecialchars($row['vorname']); ?>" required><br><br>
            <label for="anzahl_von_sternen">Anzahl von Sternen:</label><br>
            <input type="number" id="anzahl_von_sternen" name="anzahl_von_sternen" value="<?php echo $row['anzahl_von_sternen']; ?>" min="0" max="5"><br><br>
            <label for="alter_koch">Alter:</label><br>
            <input type="number" id="alter_koch" name="alter_koch" value="<?php echo $row['alter_koch']; ?>" min="18"><br><br>
            <label for="geschlecht">Geschlecht:</label><br>
            <select id="geschlecht" name="geschlecht">
                <option value="männlich" <?php if($row['geschlecht'] == 'männlich') echo 'selected'; ?>>Männlich</option>
                <option value="weiblich" <?php if($row['geschlecht'] == 'weiblich') echo 'selected'; ?>>Weiblich</option>
            </select><br><br>
            <label for="spezialgebiet">Spezialgebiet:</label><br>
            <input type="checkbox" id="desserts" name="spezialgebiet[]" value="Desserts" <?php if(in_array('Desserts', $spezialgebiete)) echo 'checked'; ?>>
            <label for="desserts">Desserts</label><br>
            <input type="checkbox" id="hauptspeisen" name="spezialgebiet[]" value="Hauptspeisen" <?php if(in_array('Hauptspeisen', $spezialgebiete)) echo 'checked'; ?>>
            <label for="hauptspeisen">Hauptspeisen</label><br>
            <input type="checkbox" id="suppen" name="spezialgebiet[]" value="Suppen" <?php if(in_array('Suppen', $spezialgebiete)) echo 'checked'; ?>>
            <label for="suppen">Suppen</label><br>
            <input type="checkbox" id="vorspeisen" name="spezialgebiet[]" value="Vorspeisen" <?php if(in_array('Vorspeisen', $spezialgebiete)) echo 'checked'; ?>>
            <label for="vorspeisen">Vorspeisen</label><br>
            <input type="checkbox" id="grillgerichte" name="spezialgebiet[]" value="Grillgerichte" <?php if(in_array('Grillgerichte', $spezialgebiete)) echo 'checked'; ?>>
            <label for="grillgerichte">Grillgerichte</label><br><br>
            <input type="submit" value="Änderungen speichern">
        </form>
    </body>
    </html>
    <?php
} else {
    echo "Koch nicht gefunden.";
}

$mysqli->close();
?>
