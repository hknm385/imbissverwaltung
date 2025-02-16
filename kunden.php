<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kunden</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Kunden</h1>

    <form method="GET" action="kunden.php" class="search-form">
        <label for="search_name">Nachname oder Vorname:</label>
        <input type="text" id="search_name" name="search_name" placeholder="Nachname oder Vorname">
        <br>
        <label for="search_email">Email:</label>
        <input type="text" id="search_email" name="search_email" placeholder="Email">
        <br>
        <label for="search_lieblingsgericht">Lieblingsgericht:</label>
        <input type="text" id="search_lieblingsgericht" name="search_lieblingsgericht" placeholder="Lieblingsgericht">
        <br>
        <label for="search_plz">PLZ:</label>
        <input type="text" id="search_plz" name="search_plz" placeholder="PLZ">
        <br>
        <label for="search_ort">Ort:</label>
        <input type="text" id="search_ort" name="search_ort" placeholder="Ort">
        <br>
        <label for="search_strasse">Straße:</label>
        <input type="text" id="search_strasse" name="search_strasse" placeholder="Straße">
        <br>
        <label for="search_telefonnr">Telefonnummer:</label>
        <input type="text" id="search_telefonnr" name="search_telefonnr" placeholder="Telefonnummer">
        <br>
        <input type="submit" value="Suchen">
    </form>
    <br>
    
    <a href="kunden_anlegen.php" class="button">Neuen Kunden anlegen</a>
    <br>
<?php
require_once("db.inc.php");

// Überprüfe, ob eine Suchanfrage vorliegt
$search_name = isset($_GET['search_name']) ? $mysqli->real_escape_string($_GET['search_name']) : '';
$search_email = isset($_GET['search_email']) ? $mysqli->real_escape_string($_GET['search_email']) : '';
$search_lieblingsgericht = isset($_GET['search_lieblingsgericht']) ? $mysqli->real_escape_string($_GET['search_lieblingsgericht']) : '';
$search_plz = isset($_GET['search_plz']) ? $mysqli->real_escape_string($_GET['search_plz']) : '';
$search_ort = isset($_GET['search_ort']) ? $mysqli->real_escape_string($_GET['search_ort']) : '';
$search_strasse = isset($_GET['search_strasse']) ? $mysqli->real_escape_string($_GET['search_strasse']) : '';
$search_telefonnr = isset($_GET['search_telefonnr']) ? $mysqli->real_escape_string($_GET['search_telefonnr']) : '';

$sql = "SELECT * FROM Kunde WHERE 1=1";

if ($search_name !== '') {
    $sql .= " AND (nachname LIKE '%$search_name%' OR vorname LIKE '%$search_name%')";
}
if ($search_email !== '') {
    $sql .= " AND email LIKE '%$search_email%'";
}
if ($search_lieblingsgericht !== '') {
    $sql .= " AND lieblingsgericht LIKE '%$search_lieblingsgericht%'";
}
if ($search_plz !== '') {
    $sql .= " AND plz LIKE '%$search_plz%'";
}
if ($search_ort !== '') {
    $sql .= " AND ort LIKE '%$search_ort%'";
}
if ($search_strasse !== '') {
    $sql .= " AND strasse LIKE '%$search_strasse%'";
}
if ($search_telefonnr !== '') {
    $sql .= " AND telefonnr LIKE '%$search_telefonnr%'";
}

$result = $mysqli->query($sql);

echo '<div class="table-container">';
if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>ID</th><th>Nachname</th><th>Vorname</th><th>Email</th><th>Lieblingsgericht</th><th>PLZ</th><th>Ort</th><th>Strasse</th><th>Strassenr</th><th>Telefonnr</th><th>Aktion</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['kundeID'] . '</td>';
        echo '<td>' . htmlspecialchars($row['nachname']) . '</td>';
        echo '<td>' . htmlspecialchars($row['vorname']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
        echo '<td>' . htmlspecialchars($row['lieblingsgericht']) . '</td>';
        echo '<td>' . htmlspecialchars($row['plz']) . '</td>';
        echo '<td>' . htmlspecialchars($row['ort']) . '</td>';
        echo '<td>' . htmlspecialchars($row['strasse']) . '</td>';
        echo '<td>' . htmlspecialchars($row['strassenr']) . '</td>';
        echo '<td>' . htmlspecialchars($row['telefonnr']) . '</td>';
        echo '<td><a href="kunden_bearbeiten.php?id=' . $row['kundeID'] . '">Bearbeiten</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo "Keine Kunden gefunden.";
}
echo '</div>';

$mysqli->close();
?>



    
</body>
</html>
