<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Rezepte</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <?php require_once("navigation.inc.php"); ?>
    <h1>Rezepte</h1>

    <!-- Suchformular -->
    <form method="GET" action="rezepte.php">
        <!-- Dropdown für Rezeptname -->
        <label for="search_name">Rezeptname:</label>
        <select id="search_name" name="search_name">
            <option value="">Alle Rezepte</option>
            <?php
            require_once("db.inc.php");
            // Verbindung 1 für Rezeptnamen
            $mysqli_rezepte = new mysqli("localhost", "root", "", "imbissverwaltung");
            $rezeptNamen = $mysqli_rezepte->query("SELECT rezept_name FROM Rezept");
            while ($row = $rezeptNamen->fetch_assoc()) {
                $selected = ($_GET['search_name'] ?? '') === $row['rezept_name'] ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($row['rezept_name']) . '" ' . $selected . '>' 
                    . htmlspecialchars($row['rezept_name']) . '</option>';
            }
            $mysqli_rezepte->close(); // Nur diese Verbindung schließen
            ?>
        </select>
        <br>

        <!-- Checkboxen für Speisearten -->
        <label>Speiseart:</label><br>
        <?php
        require_once("db.inc.php");
        // Verbindung 2 für Speisearten (getrennt von der ersten)
        $mysqli_speisearten = new mysqli("localhost", "root", "", "imbissverwaltung");
        $speisearten = $mysqli_speisearten->query("SELECT DISTINCT speiseart FROM Rezept");
        while ($row = $speisearten->fetch_assoc()) {
            $checked = isset($_GET['speiseart']) && in_array($row['speiseart'], $_GET['speiseart']) ? 'checked' : '';
            echo '<label><input type="checkbox" name="speiseart[]" value="' . htmlspecialchars($row['speiseart']) . '" ' 
                . $checked . '> ' . htmlspecialchars($row['speiseart']) . '</label><br>';
        }
        $mysqli_speisearten->close(); // Nur diese Verbindung schließen
        ?>
        <br>

        <input type="submit" value="Suchen">
    </form>
    <br>
    <br>
    <a href="rezept_anlegen.php" class="button">Neues Rezept anlegen</a>
    <?php
    require_once("db.inc.php");

    // Suchparameter holen
    $search_name = $_GET['search_name'] ?? '';
    $selected_speisearten = $_GET['speiseart'] ?? [];

    // SQL-Query mit Prepared Statements
    $sql = "SELECT * FROM Rezept WHERE 1=1";
    $types = "";
    $params = [];

    // Rezeptname-Suche (Dropdown)
    if (!empty($search_name)) {
        $sql .= " AND rezept_name = ?";
        $params[] = $search_name;
        $types .= "s";
    }

    // Speiseart-Suche (Checkboxen)
    if (!empty($selected_speisearten)) {
        $placeholders = implode(',', array_fill(0, count($selected_speisearten), '?'));
        $sql .= " AND speiseart IN ($placeholders)";
        $types .= str_repeat("s", count($selected_speisearten));
        $params = array_merge($params, $selected_speisearten);
    }

    // Prepared Statement
    $stmt = $mysqli->prepare($sql);
    if ($stmt && !empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    // Tabelle anzeigen
    if ($result->num_rows > 0) {
        echo '<div class="table-container">';
        echo '<table>';
        echo '<tr><th>ID</th><th>Name</th><th>Dauer</th><th>Speiseart</th><th>Beschreibung</th><th>Aktion</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['rezeptID'] . '</td>';
            echo '<td>' . htmlspecialchars($row['rezept_name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['dauer']) . ' Minuten</td>';
            echo '<td>' . htmlspecialchars($row['speiseart']) . '</td>';
            echo '<td>' . htmlspecialchars($row['rezeptbeschreibung']) . '</td>';
            echo '<td><a href="rezept_bearbeiten.php?id=' . $row['rezeptID'] . '">Bearbeiten</a></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
    } else {
        echo "Keine Rezepte gefunden.";
    }

    $stmt->close();
    $mysqli->close();
    ?>

    
</body>
</html>