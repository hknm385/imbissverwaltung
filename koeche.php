<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Köche</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Köche</h1>

    <form method="GET" action="koeche.php" class="search-form">
        <label for="search_name">Nachname oder Vorname:</label>
        <input type="text" id="search_name" name="search_name" placeholder="Nachname oder Vorname">
        <br>
        <label for="search_anzahl_von_sternen">Anzahl von Sternen:</label>
        <input type="number" id="search_anzahl_von_sternen" name="search_anzahl_von_sternen" min="0" max="5" placeholder="0-5">
        <br>
        <label for="search_alter_koch">Alter:</label>
        <input type="number" id="search_alter_koch" name="search_alter_koch" min="18" placeholder="Alter">
        <br>
        <label for="search_geschlecht">Geschlecht:</label>
        <select id="search_geschlecht" name="search_geschlecht">
            <option value="">Alle</option>
            <option value="männlich">Männlich</option>
            <option value="weiblich">Weiblich</option>
            <br>
        </select>
        <br>
        <label for="search_spezialgebiet">Spezialgebiet:</label>
        
        <div id="search_spezialgebiet">
        <input type="checkbox" name="search_spezialgebiet[]" value="Vorspeisen"> Vorspeisen
        <input type="checkbox" name="search_spezialgebiet[]" value="Hauptgerichte"> Hauptgerichte
        <input type="checkbox" name="search_spezialgebiet[]" value="Beilagen"> Beilagen
        <input type="checkbox" name="search_spezialgebiet[]" value="Desserts"> Desserts
        <input type="checkbox" name="search_spezialgebiet[]" value="Suppen und Eintöpfe"> Suppen und Eintöpfe
        <input type="checkbox" name="search_spezialgebiet[]" value="Salate"> Salate
        <input type="checkbox" name="search_spezialgebiet[]" value="Saucen und Dips"> Saucen und Dips
        <input type="checkbox" name="search_spezialgebiet[]" value="Grillgerichte"> Grillgerichte
        <input type="checkbox" name="search_spezialgebiet[]" value="Vegetarisches und veganes"> Vegetarisches und veganes
        </div>
        <br>
        <input type="submit" value="Suchen">
    </form>
    <br>
    <a href="koch_anlegen.php" class="button">Neuen Koch anlegen</a>
<?php
require_once("db.inc.php");

// Überprüfe, ob eine Suchanfrage vorliegt
$search_name = isset($_GET['search_name']) ? $mysqli->real_escape_string($_GET['search_name']) : '';
$search_anzahl_von_sternen = isset($_GET['search_anzahl_von_sternen']) ? (int)$_GET['search_anzahl_von_sternen'] : '';
$search_alter_koch = isset($_GET['search_alter_koch']) ? (int)$_GET['search_alter_koch'] : '';
$search_geschlecht = isset($_GET['search_geschlecht']) ? $mysqli->real_escape_string($_GET['search_geschlecht']) : '';
$search_spezialgebiet = isset($_GET['search_spezialgebiet']) ? $_GET['search_spezialgebiet'] : [];

$sql = "SELECT * FROM Koch WHERE 1=1";

if ($search_name !== '') {
    $sql .= " AND (nachname LIKE '%$search_name%' OR vorname LIKE '%$search_name%')";
}
if ($search_anzahl_von_sternen !== '') {
    $sql .= " AND anzahl_von_sternen = $search_anzahl_von_sternen";
}
if ($search_alter_koch !== '') {
    $sql .= " AND alter_koch = $search_alter_koch";
}
if ($search_geschlecht !== '') {
    $sql .= " AND geschlecht = '$search_geschlecht'";
}
if (!empty($search_spezialgebiet)) {
    $sql .= " AND Koch.kochID IN (
        SELECT Koch_Spezialgebiete.kochID 
        FROM Koch_Spezialgebiete 
        JOIN Spezialgebiete ON Koch_Spezialgebiete.spezialgebietID = Spezialgebiete.spezialgebietID
        WHERE Spezialgebiete.name IN ('" . implode("','", array_map([$mysqli, 'real_escape_string'], $search_spezialgebiet)) . "')
    )";
}


$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="table-container">';
    echo '<table>';
    echo '<tr><th>ID</th><th>Nachname</th><th>Vorname</th><th>Sterne</th><th>Alter</th><th>Geschlecht</th><th>Spezialgebiet</th><th>Aktion</th></tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['kochID'] . '</td>';
        echo '<td>' . htmlspecialchars($row['nachname']) . '</td>';
        echo '<td>' . htmlspecialchars($row['vorname']) . '</td>';
        echo '<td>' . $row['anzahl_von_sternen'] . '</td>';
        echo '<td>' . $row['alter_koch'] . '</td>';
        echo '<td>' . $row['geschlecht'] . '</td>';
        echo '<td>' . htmlspecialchars($row['spezialgebiet']) . '</td>';
        echo '<td>
                <a href="koch_bearbeiten.php?id=' . $row['kochID'] . '">Bearbeiten</a> 
                <a href="koch_loeschen.php?id=' . $row['kochID'] . '" onclick="return confirm(\'Koch wirklich löschen?\')">Löschen</a>
            </td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
} else {
    echo "Keine Köche gefunden.";
}

$mysqli->close();
?>
</body>
</html>
