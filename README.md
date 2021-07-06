# E-Scooter-Verleih-Projekt

Mitarbeiter: Julius Drück und Henrik Adam
Hauptprojekt-Zeitraum: 22.06-06.07.2021

Test-User: Test Doe

# Test-Cases / Scenarios

Lehrer-Scenarios

- Die E-Scooter Bilder sollen in Form einer Bildgalerie zur Verfügung gestellt werden - index.php
- Nach Anlage des Kunden, soll dieser in der Kundendatei (Textdatei im Dateisystem) gespeichert werden  - file_save/user-data.json
- Beim Mieten eines E-Scooter kann der Kunde gesucht werden. Falls er gefunden wird, werden die entsprechenden Felder des Formulars vorausgefüllt sonst wird eine entsprechende Meldung angezeigt und er wird auf das Anlagenformular weitergeleitet - index.php Hinweis: Das System "sucht" selbst nach dem Kunden. 
- Die E-Scooter werden beim Mieten über entsprechende Auswahlelemente zur Auswahl bereitgestellt - index.php:Button:Zur Reservierung
- Nach der Bestätigung der Anmietung wird eine Seite mit den Daten der Person und des gemieteten Modells mit Datum angezeigt - Account.php: Web-Ansicht und Druck-Ansicht
- Es muss von jeder Seite durch einen Klick auf die Startseite gewechselt werden können - Hier ist bitte auf die Exakte Formulierung zu beachten und das diese eingehalten worden ist.

Test-Case

Login System
- index.php:Sign In:Button:Zur Registration - Anmelden vlt auch mit falschen Daten damit die Präventionsmaßnahmen gesichtet werden können. 
- login.php - anmelden mit den Kundendaten
Ergebnis:
- Erfolgreiches Anmelden und weiterleiten auf index.php mit einer dortigen Meldung

Reservierungssystem
- account.php:Button:Addressse hinzufügen
- index.php:Button:ZurReservierung
Ergebnis:
- Wenn angemeldet werden die eingetragenen Daten vorausgefüllt. 
- Sollten Sie nicht angemeldet sein können sie nicht bestellen.
- Sollten Sie versuchen in der Vergangenheit zu bestellen wird dies geblockt. 
- Nach erfolgreicher Bestellung werden sie auf die account.php weitergeleitet. 

Verschlüsselungssystem
- Daten durch eine registrierung oder eine reservierung einfügen.
Ergebnis:
- Daten werden bis auf das Datum und den user_name verschlüsselt. Siehe - file_save/*.json

Dynamischer Slider
- Bilder in img/products/<nr>_<title>.jpg speichern.
Ergebnis:
- Der Slider passt sich automatisch der anzahl der Bilder an. 

Logout
- In Index.php im Footer befindet sich ein logout.php
Ergebnis:
- Wenn der Knopf betätigt wurde bekommen Sie eine Meldung darüber und sind ausgeloggt. 

# Featurelist

- Login System
- Resveriungssystem
- Verschlüsselung der daten
- Dynamischer Slider
- Vorausgefülltes Reservierungsformular
- Logout
- Dynamisches Nav
- Angepasste Druck Ansicht auf der Account Seite
- 90% Responsive

# Fehlerbehebung
- Daten werden nicht gefunden -> Überprüfen sie die positionen der *.json Datein oder löschen sie die Daten aus diesen Datein. 
- Datum Fehlerhaft -> Überprüfen sie ihre Systemuhr und ob Xampp die Berechtigung dafür hat. 
- Tables oder andere CSS Styles werden nicht korrekt angezeigt. -> Wechseln sie den Browser oder clearen sie den Cache.

# Disclaimer
- Es ist mir bewusst das die Verschlüsselung nicht perfekt ist und das man Keys nicht so verwenden sollte. 