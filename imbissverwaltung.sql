CREATE DATABASE imbissverwaltung;
USE imbissverwaltung;

-- Tabelle Koch
CREATE TABLE Koch (
    kochID INT PRIMARY KEY AUTO_INCREMENT,
    nachname VARCHAR(50) NOT NULL,
    vorname VARCHAR(50) NOT NULL,
    anzahl_von_sternen INT,
    alter_koch INT,
    geschlecht ENUM('männlich', 'weiblich'),
    spezialgebiet ENUM('desserts', 'hauptspeisen', 'suppen', 'vorspeisen', 'grillgerichte')
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- Tabelle Kunde
CREATE TABLE Kunde (
    kundeID INT PRIMARY KEY AUTO_INCREMENT,
    nachname VARCHAR(50) NOT NULL,
    vorname VARCHAR(50) NOT NULL,
    email VARCHAR(255),
    lieblingsgericht TEXT,
    plz VARCHAR(10),
    ort VARCHAR(50),
    strasse VARCHAR(50),
    strassenr VARCHAR(10),
    telefonnr VARCHAR(20)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- Tabelle Rezept
CREATE TABLE Rezept (
    rezeptID INT PRIMARY KEY AUTO_INCREMENT,
    rezept_name VARCHAR(100) NOT NULL,
    dauer INT,
    speiseart VARCHAR(50),
    rezeptbeschreibung TEXT
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- Tabelle GekochtesGericht
CREATE TABLE GekochtesGericht (
    gekochtesgerichtID INT PRIMARY KEY AUTO_INCREMENT,
    kochID INT NOT NULL,
    rezeptID INT NOT NULL,
    FOREIGN KEY (kochID) REFERENCES Koch(kochID),
    FOREIGN KEY (rezeptID) REFERENCES Rezept(rezeptID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- Tabelle Bestellung
CREATE TABLE Bestellung (
    bestellungID INT PRIMARY KEY AUTO_INCREMENT,
    kundeID INT NOT NULL,
    gekochtesgerichtID INT NOT NULL,
    zeitpunkt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    preis DECIMAL(10,2),
    zahlungsart ENUM('bar', 'karte', 'gutschein'),
    FOREIGN KEY (kundeID) REFERENCES Kunde(kundeID),
    FOREIGN KEY (gekochtesgerichtID) REFERENCES GekochtesGericht(gekochtesgerichtID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;



-- Hinzufügen von Testdaten

-- 1. Koch hinzufügen
INSERT INTO Koch (nachname, vorname, anzahl_von_sternen, alter_koch, geschlecht, spezialgebiet)
VALUES 
    ('Müller', 'Hans', 3, 45, 'männlich', 'Hauptspeisen'),
    ('Schmidt', 'Anna', 4, 32, 'weiblich', 'Desserts'),
    ('Fischer', 'Thomas', 5, 50, 'männlich', 'Suppen'),
    ('Weber', 'Julia', 2, 28, 'weiblich', 'Vorspeisen'),
    ('Becker', 'Michael', 4, 40, 'männlich', 'Grillgerichte');


-- 2. Kunde hinzufügen
INSERT INTO Kunde (nachname, vorname, email, lieblingsgericht, plz, ort, strasse, strassenr, telefonnr)
VALUES 
    ('Meier', 'Peter', 'peter.meier@email.de', 'Spaghetti Carbonara', '10115', 'Berlin', 'Hauptstraße', '12', '030-12345678'),
    ('Schulz', 'Lisa', 'lisa.schulz@email.de', 'Tiramisu', '80331', 'München', 'Bahnhofstraße', '5A', '089-98765432'),
    ('Wagner', 'Markus', 'markus.wagner@email.de', 'Gulaschsuppe', '50667', 'Köln', 'Domstraße', '7', '0221-55555555'),
    ('Hoffmann', 'Sarah', 'sarah.hoffmann@email.de', 'Cheeseburger', '60311', 'Frankfurt', 'Zeil', '10', '069-1234567'),
    ('Schneider', 'Laura', 'laura.schneider@email.de', 'Pizza Margherita', '70173', 'Stuttgart', 'Königstraße', '15', '0711-9876543');


-- 3. Rezept hinzufügen
INSERT INTO Rezept (rezept_name, dauer, speiseart, rezeptbeschreibung)
VALUES 
    ('Spaghetti Carbonara', 30, 'Hauptgericht', 'Klassisches italienisches Gericht mit Ei, Pecorino und Guanciale.'),
    ('Tiramisu', 60, 'Dessert', 'Italienische Nachspeise mit Löffelbiskuits und Mascarpone.'),
    ('Gulaschsuppe', 90, 'Suppe', 'Ungarische Suppe mit Rindfleisch, Paprika und Kartoffeln.'),
    ('Cheeseburger', 20, 'Burger', 'Burger mit Rindfleisch, Käse, Salat und Tomaten.'),
    ('Pizza Margherita', 45, 'Pizza', 'Klassische Pizza mit Tomatensauce, Mozzarella und Basilikum.'),
    ('Caesar Salad', 15, 'Vorspeise', 'Salat mit Romana-Salat, Croutons und Parmesan.'),
    ('Grillhähnchen', 60, 'Grillgericht', 'Hähnchen mariniert mit Kräutern und gegrillt.'),
    ('Döner', 7, 'Hauptgericht', 'Yufka mit Fleisch und Gemüse. Wahlweise Sauce. Vay Vay!');
    


-- 4. GekochtesGericht hinzufügen
INSERT INTO GekochtesGericht (kochID, rezeptID)
VALUES 
    (1, 1), -- Hans Müller kocht Spaghetti Carbonara
    (2, 2), -- Anna Schmidt kocht Tiramisu
    (3, 3), -- Thomas Fischer kocht Gulaschsuppe
    (4, 6), -- Julia Weber kocht Caesar Salad
    (5, 7), -- Michael Becker kocht Grillhähnchen
    (1, 5), -- Hans Müller kocht Pizza Margherita
    (2, 8); -- Anna Schmidt kocht Schokoladenmousse


-- 5. Bestellung hinzufügen
INSERT INTO Bestellung (kundeID, gekochtesgerichtID, preis, zahlungsart)
VALUES 
    (1, 1, 12.50, 'bar'),   -- Peter Meier bestellt Spaghetti Carbonara
    (2, 2, 8.90, 'karte'),   -- Lisa Schulz bestellt Tiramisu
    (3, 3, 9.50, 'gutschein'), -- Markus Wagner bestellt Gulaschsuppe
    (4, 4, 6.50, 'bar'),     -- Sarah Hoffmann bestellt Caesar Salad
    (5, 5, 14.90, 'karte'),  -- Laura Schneider bestellt Grillhähnchen
    (1, 6, 10.50, 'bar'),    -- Peter Meier bestellt Pizza Margherita
    (2, 7, 7.90, 'karte');   -- Lisa Schulz bestellt Schokoladenmousse