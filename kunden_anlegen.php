<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neuen Kunden anlegen</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Neuen Kunden anlegen</h1>
    <form action="kunde_speichern.php" method="post">
        <label for="nachname">Nachname:</label><br>
        <input type="text" id="nachname" name="nachname" required><br><br>
        <label for="vorname">Vorname:</label><br>
        <input type="text" id="vorname" name="vorname" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>
        <label for="lieblingsgericht">Lieblingsgericht:</label><br>
        <textarea id="lieblingsgericht" name="lieblingsgericht"></textarea><br><br>
        <label for="plz">PLZ:</label><br>
        <input type="text" id="plz" name="plz"><br><br>
        <label for="ort">Ort:</label><br>
        <input type="text" id="ort" name="ort"><br><br>
        <label for="strasse">Strasse:</label><br>
        <input type="text" id="strasse" name="strasse"><br><br>
        <label for="strassenr">Strassenr:</label><br>
        <input type="text" id="strassenr" name="strassenr"><br><br>
        <label for="telefonnr">Telefonnr:</label><br>
        <input type="text" id="telefonnr" name="telefonnr"><br><br>
        <input type="submit" value="Kunde hinzufügen">
    </form>
</body>
</html>
