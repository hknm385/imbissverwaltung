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
        <input type="text" id="nachname" name="nachname" required><br><br>
        <label for="vorname">Vorname:</label><br>
        <input type="text" id="vorname" name="vorname" required><br><br>
        <label for="anzahl_von_sternen">Anzahl von Sternen:</label><br>
        <input type="number" id="anzahl_von_sternen" name="anzahl_von_sternen" min="0" max="5"><br><br>
        <label for="alter_koch">Alter:</label><br>
        <input type="number" id="alter_koch" name="alter_koch" min="18"><br><br>
        <label for="geschlecht">Geschlecht:</label><br>
        <select id="geschlecht" name="geschlecht">
            <option value="männlich">Männlich</option>
            <option value="weiblich">Weiblich</option>
        </select><br><br>
        <label for="spezialgebiet">Spezialgebiet:</label><br>
        <input type="checkbox" id="desserts" name="spezialgebiet[]" value="Desserts">
        <label for="desserts">Desserts</label><br>
        <input type="checkbox" id="hauptspeisen" name="spezialgebiet[]" value="Hauptspeisen">
        <label for="hauptspeisen">Hauptspeisen</label><br>
        <input type="checkbox" id="suppen" name="spezialgebiet[]" value="Suppen">
        <label for="suppen">Suppen</label><br>
        <input type="checkbox" id="vorspeisen" name="spezialgebiet[]" value="Vorspeisen">
        <label for="vorspeisen">Vorspeisen</label><br>
        <input type="checkbox" id="grillgerichte" name="spezialgebiet[]" value="Grillgerichte">
        <label for="grillgerichte">Grillgerichte</label><br><br>
        <input type="submit" value="Koch hinzufügen">
    </form>
</body>
</html>
