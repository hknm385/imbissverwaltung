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
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="dauer">Dauer:</label>
        <input type="number" id="dauer" name="dauer" required><br>
        <label for="speiseart">Speiseart:</label>
        <input type="text" id="speiseart" name="speiseart" required><br>
        <label for="rezeptbeschreibung">Beschreibung:</label>
        <textarea id="rezeptbeschreibung" name="rezeptbeschreibung" required></textarea><br>
        <input type="submit" value="Speichern">
    </form>
</body>
</html>
