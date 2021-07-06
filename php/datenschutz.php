<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/others.css">
    <link rel="stylesheet" href="../css/notifications.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Datenschutz</title>
</head>
<?php
require('support_logic.php');
?>

<body>
    <div class="nav-parent">
        <div class="nav">
            <a href="../index.php">Home</a>
            <a href="account.php"><?php echo ($navIf) ?></a>
        </div>
    </div>
    <div class="center-container">
    <p><strong><big>Datenschutzerklärung</big></strong></p>
    <p><strong>Allgemeiner Hinweis und Pflichtinformationen</strong></p>
    <p><strong>Benennung der verantwortlichen Stelle</strong></p>
    <p>Die verantwortliche Stelle für die Datenverarbeitung auf dieser Website ist:</p>
    <p><span id="s3-t-firma">Risee Gmbh</span><br><span id="s3-t-ansprechpartner">Projekt Risee</span><br><span id="s3-t-strasse">Hibiskusstraße 31</span><br><span id="s3-t-plz">66655</span> <span id="s3-t-ort">Projekt</span></p>
    <p></p>
    <p>Die verantwortliche Stelle entscheidet allein oder gemeinsam mit anderen über die Zwecke und Mittel der Verarbeitung von personenbezogenen Daten (z.B. Namen, Kontaktdaten o. Ä.).</p>

    <p><strong>Widerruf Ihrer Einwilligung zur Datenverarbeitung</strong></p>
    <p>Nur mit Ihrer ausdrücklichen Einwilligung sind einige Vorgänge der Datenverarbeitung möglich. Ein Widerruf Ihrer bereits erteilten Einwilligung ist jederzeit möglich. Für den Widerruf genügt eine formlose Mitteilung per E-Mail. Die Rechtmäßigkeit der bis zum Widerruf erfolgten Datenverarbeitung bleibt vom Widerruf unberührt.</p>

    <p><strong>Recht auf Beschwerde bei der zuständigen Aufsichtsbehörde</strong></p>
    <p>Als Betroffener steht Ihnen im Falle eines datenschutzrechtlichen Verstoßes ein Beschwerderecht bei der zuständigen Aufsichtsbehörde zu. Zuständige Aufsichtsbehörde bezüglich datenschutzrechtlicher Fragen ist der Landesdatenschutzbeauftragte des Bundeslandes, in dem sich der Sitz unseres Unternehmens befindet. Der folgende Link stellt eine Liste der Datenschutzbeauftragten sowie deren Kontaktdaten bereit: <a href="https://www.bfdi.bund.de/DE/Infothek/Anschriften_Links/anschriften_links-node.html" target="_blank">https://www.bfdi.bund.de/DE/Infothek/Anschriften_Links/anschriften_links-node.html</a>.</p>

    <p><strong>Recht auf Datenübertragbarkeit</strong></p>
    <p>Ihnen steht das Recht zu, Daten, die wir auf Grundlage Ihrer Einwilligung oder in Erfüllung eines Vertrags automatisiert verarbeiten, an sich oder an Dritte aushändigen zu lassen. Die Bereitstellung erfolgt in einem maschinenlesbaren Format. Sofern Sie die direkte Übertragung der Daten an einen anderen Verantwortlichen verlangen, erfolgt dies nur, soweit es technisch machbar ist.</p>

    <p><strong>Recht auf Auskunft, Berichtigung, Sperrung, Löschung</strong></p>
    <p>Sie haben jederzeit im Rahmen der geltenden gesetzlichen Bestimmungen das Recht auf unentgeltliche Auskunft über Ihre gespeicherten personenbezogenen Daten, Herkunft der Daten, deren Empfänger und den Zweck der Datenverarbeitung und ggf. ein Recht auf Berichtigung, Sperrung oder Löschung dieser Daten. Diesbezüglich und auch zu weiteren Fragen zum Thema personenbezogene Daten können Sie sich jederzeit über die im Impressum aufgeführten Kontaktmöglichkeiten an uns wenden.</p>

    <p><strong>SSL- bzw. TLS-Verschlüsselung</strong></p>
    <p>Aus Sicherheitsgründen und zum Schutz der Übertragung vertraulicher Inhalte, die Sie an uns als Seitenbetreiber senden, nutzt unsere Website eine SSL-bzw. TLS-Verschlüsselung. Damit sind Daten, die Sie über diese Website übermitteln, für Dritte nicht mitlesbar. Sie erkennen eine verschlüsselte Verbindung an der „https://“ Adresszeile Ihres Browsers und am Schloss-Symbol in der Browserzeile.</p>

    <p><strong>Server-Log-Dateien</strong></p>
    <p>In Server-Log-Dateien erhebt und speichert der Provider der Website automatisch Informationen, die Ihr Browser automatisch an uns übermittelt. Dies sind:</p>
    <ul>
        <li>Besuchte Seite auf unserer Domain</li>
        <li>Datum und Uhrzeit der Serveranfrage</li>
        <li>Browsertyp und Browserversion</li>
        <li>Verwendetes Betriebssystem</li>
        <li>Referrer URL</li>
        <li>Hostname des zugreifenden Rechners</li>
        <li>IP-Adresse</li>
    </ul>
    <p>Es findet keine Zusammenführung dieser Daten mit anderen Datenquellen statt. Grundlage der Datenverarbeitung bildet Art. 6 Abs. 1 lit. b DSGVO, der die Verarbeitung von Daten zur Erfüllung eines Vertrags oder vorvertraglicher Maßnahmen gestattet.</p>

    <p><strong>Datenübermittlung bei Vertragsschluss für Warenkauf und Warenversand</strong></p>
    <p>Personenbezogene Daten werden an Dritte nur übermittelt, sofern eine Notwendigkeit im Rahmen der Vertragsabwicklung besteht. Dritte können beispielsweise Bezahldienstleister oder Logistikunternehmen sein. Eine weitergehende Übermittlung der Daten findet nicht statt bzw. nur dann, wenn Sie dieser ausdrücklich zugestimmt haben.</p>
    <p>Grundlage für die Datenverarbeitung ist Art. 6 Abs. 1 lit. b DSGVO, der die Verarbeitung von Daten zur Erfüllung eines Vertrags oder vorvertraglicher Maßnahmen gestattet.</p>

    <p><strong>Registrierung auf dieser Website</strong></p>
    <p>Zur Nutzung bestimmter Funktionen können Sie sich auf unserer Website registrieren. Die übermittelten Daten dienen ausschließlich zum Zwecke der Nutzung des jeweiligen Angebotes oder Dienstes. Bei der Registrierung abgefragte Pflichtangaben sind vollständig anzugeben. Andernfalls werden wir die Registrierung ablehnen.</p>
    <p>Im Falle wichtiger Änderungen, etwa aus technischen Gründen, informieren wir Sie per E-Mail. Die E-Mail wird an die Adresse versendet, die bei der Registrierung angegeben wurde.</p>
    <p>Die Verarbeitung der bei der Registrierung eingegebenen Daten erfolgt auf Grundlage Ihrer Einwilligung (Art. 6 Abs. 1 lit. a DSGVO). Ein Widerruf Ihrer bereits erteilten Einwilligung ist jederzeit möglich. Für den Widerruf genügt eine formlose Mitteilung per E-Mail. Die Rechtmäßigkeit der bereits erfolgten Datenverarbeitung bleibt vom Widerruf unberührt.</p>
    <p>Wir speichern die bei der Registrierung erfassten Daten während des Zeitraums, den Sie auf unserer Website registriert sind. Ihren Daten werden gelöscht, sollten Sie Ihre Registrierung aufheben. Gesetzliche Aufbewahrungsfristen bleiben unberührt.</p>

    <p><strong>Kontaktformular</strong></p>
    <p>Per Kontaktformular übermittelte Daten werden einschließlich Ihrer Kontaktdaten gespeichert, um Ihre Anfrage bearbeiten zu können oder um für Anschlussfragen bereitzustehen. Eine Weitergabe dieser Daten findet ohne Ihre Einwilligung nicht statt.</p>
    <p>Die Verarbeitung der in das Kontaktformular eingegebenen Daten erfolgt ausschließlich auf Grundlage Ihrer Einwilligung (Art. 6 Abs. 1 lit. a DSGVO). Ein Widerruf Ihrer bereits erteilten Einwilligung ist jederzeit möglich. Für den Widerruf genügt eine formlose Mitteilung per E-Mail. Die Rechtmäßigkeit der bis zum Widerruf erfolgten Datenverarbeitungsvorgänge bleibt vom Widerruf unberührt.</p>
    <p>Über das Kontaktformular übermittelte Daten verbleiben bei uns, bis Sie uns zur Löschung auffordern, Ihre Einwilligung zur Speicherung widerrufen oder keine Notwendigkeit der Datenspeicherung mehr besteht. Zwingende gesetzliche Bestimmungen - insbesondere Aufbewahrungsfristen - bleiben unberührt.</p>

    <p><strong>YouTube</strong></p>
    <p>Für Integration und Darstellung von Videoinhalten nutzt unsere Website Plugins von YouTube. Anbieter des Videoportals ist die YouTube, LLC, 901 Cherry Ave., San Bruno, CA 94066, USA.</p>
    <p>Bei Aufruf einer Seite mit integriertem YouTube-Plugin wird eine Verbindung zu den Servern von YouTube hergestellt. YouTube erfährt hierdurch, welche unserer Seiten Sie aufgerufen haben.</p>
    <p>YouTube kann Ihr Surfverhalten direkt Ihrem persönlichen Profil zuzuordnen, sollten Sie in Ihrem YouTube Konto eingeloggt sein. Durch vorheriges Ausloggen haben Sie die Möglichkeit, dies zu unterbinden.</p>
    <p>Die Nutzung von YouTube erfolgt im Interesse einer ansprechenden Darstellung unserer Online-Angebote. Dies stellt ein berechtigtes Interesse im Sinne von Art. 6 Abs. 1 lit. f DSGVO dar.</p>
    <p>Einzelheiten zum Umgang mit Nutzerdaten finden Sie in der Datenschutzerklärung von YouTube unter: <a href="https://www.google.de/intl/de/policies/privacy">https://www.google.de/intl/de/policies/privacy</a>.</p>

    <p><strong>Cookies</strong></p>
    <p>Unsere Website verwendet Cookies. Das sind kleine Textdateien, die Ihr Webbrowser auf Ihrem Endgerät speichert. Cookies helfen uns dabei, unser Angebot nutzerfreundlicher, effektiver und sicherer zu machen. </p>
    <p>Einige Cookies sind “Session-Cookies.” Solche Cookies werden nach Ende Ihrer Browser-Sitzung von selbst gelöscht. Hingegen bleiben andere Cookies auf Ihrem Endgerät bestehen, bis Sie diese selbst löschen. Solche Cookies helfen uns, Sie bei Rückkehr auf
        unserer Website wiederzuerkennen.</p>
    <p>Mit einem modernen Webbrowser können Sie das Setzen von Cookies überwachen, einschränken oder unterbinden. Viele Webbrowser lassen sich so konfigurieren, dass Cookies mit dem Schließen des Programms von selbst gelöscht werden. Die Deaktivierung von Cookies
        kann eine eingeschränkte Funktionalität unserer Website zur Folge haben.</p>
    <p>Das Setzen von Cookies, die zur Ausübung elektronischer Kommunikationsvorgänge oder der Bereitstellung bestimmter, von Ihnen erwünschter Funktionen (z.B. Warenkorb) notwendig sind, erfolgt auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO. Als Betreiber dieser
        Website haben wir ein berechtigtes Interesse an der Speicherung von Cookies zur technisch fehlerfreien und reibungslosen Bereitstellung unserer Dienste. Sofern die Setzung anderer Cookies (z.B. für Analyse-Funktionen) erfolgt, werden diese in dieser
        Datenschutzerklärung separat behandelt.</p>

    <p><strong>PayPal</strong></p>
    <p>Unsere Website ermöglicht die Bezahlung via PayPal. Anbieter des Bezahldienstes ist die PayPal (Europe) S.à.r.l. et Cie, S.C.A., 22-24 Boulevard Royal, L-2449 Luxembourg.</p>
    <p>Wenn Sie mit PayPal bezahlen, erfolgt eine Übermittlung der von Ihnen eingegebenen Zahlungsdaten an PayPal.</p>
    <p>Die Übermittlung Ihrer Daten an PayPal erfolgt auf Grundlage von Art. 6 Abs. 1 lit. a DSGVO (Einwilligung) und Art. 6 Abs. 1 lit. b DSGVO (Verarbeitung zur Erfüllung eines Vertrags). Ein Widerruf Ihrer bereits erteilten Einwilligung ist jederzeit möglich.
        In der Vergangenheit liegende Datenverarbeitungsvorgänge bleiben bei einem Widerruf wirksam.</p>
    </div>
    <footer>
        <div class="flex-footer">
            <div>
                <a href="impressum.php">Impressum</a>
                <a href="datenschutz.php">Datenschutz</a>
                <a href="agb.php">AGB</a>
                <a href="logout.php"><?php echo ($logoutIf) ?></a>
            </div>
        </div>
    </footer>
</body>

</html>