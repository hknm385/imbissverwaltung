<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kunden bearbeiten</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Kunden bearbeiten</h1>

    <?php
    require_once("db.inc.php");

    $kundeID = isset($_GET['id']) ? (int)$_GET['id'] : 0;

    if ($kundeID > 0) {
        $result = $mysqli->query("SELECT * FROM Kunde WHERE kundeID = $kundeID");
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form action="kunde_aktualisieren.php" method="post">
                <input type="hidden" name="kundeID" value="<?php echo $row['kundeID']; ?>">
                <label for="nachname">Nachname:</label>
                <input type="text" id="nachname" name="nachname" value="<?php echo htmlspecialchars($row['nachname']); ?>" required><br>
                <label for="vorname">Vorname:</label>
                <input type="text" id="vorname" name="vorname" value="<?php echo htmlspecialchars($row['vorname']); ?>" required><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required><br>
                <label for="lieblingsgericht">Lieblingsgericht:</label>
                <input type="text" id="lieblingsgericht" name="lieblingsgericht" value="<?php echo htmlspecialchars($row['lieblingsgericht']); ?>"><br>
                <label for="plz">PLZ:</label>
                <input type="text" id="plz" name="plz" value="<?php echo htmlspecialchars($row['plz']); ?>" required><br>
                <label for="ort">Ort:</label>
                <input type="text" id="ort" name="ort" value="<?php echo htmlspecialchars($row['ort']); ?>" required><br>
                <label for="strasse">Straße:</label>
                <input type="text" id="strasse" name="strasse" value="<?php echo htmlspecialchars($row['strasse']); ?>" required><br>
                <label for="strassenr">Straßennr:</label>
                <input type="text" id="strassenr" name="strassenr" value="<?php echo htmlspecialchars($row['strassenr']); ?>" required><br>
                <label for="telefonnr">Telefonnummer:</label>
                <input type="text" id="telefonnr" name="telefonnr" value="<?php echo htmlspecialchars($row['telefonnr']); ?>" required><br>
                <input type="submit" value="Aktualisieren">
            </form>
            <?php
        } else {
            echo "Kunde nicht gefunden.";
        }
    } else {
        echo "Ungültige Kunden-ID.";
    }

    $mysqli->close();
    ?>
    <a href="kunden.php">Zurück zur Kundenübersicht</a>
</body>
</html>
