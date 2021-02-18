# Seitenfelder mit Vererbung

Die Erweiterung ergänzt zwei zusätzliche Felder in der Seitenstruktur und im Seiten-Stamm (Startpunkt einer Webseite) die auf die Unterseiten vererbt werden. Im Backend wird der jeweils vererbte Wert als grauer Platzhalter angezeigt.

### CSS-Klasse mit Vererbung
Feld «CSS-Klasse» wird auf die Unterseiten vererbt und automatisch im `<body>` als Klasse hinzugefügt. Es ist keine weitere Konfiguration nötig.

### Eigener Wert mit Vererbung
Feld «Eigener Wert» wird auf die Unterseiten vererbt und über das Modul «Seitenfeld mit Vererbung» hinzugefügt. So kann beispielsweise pro Seiten-Stamm eine zusätzliche CSS-Datei geladen werden.
- Modul «Seitenfeld mit Vererbung» erstellen
- Template anpassen
- Modul über Themes -> Layout oder per Inserttag platzieren

![alt text](https://github.com/delirius/contao-pagefieldinherit/blob/main/screen.jpg?raw=true)

### Was die Erweiterung nicht macht
Das Feld CSS-Klasse wird in der Navigation **nicht** ergänzt.
- Es macht wenig Sinn jedem Navigationspunkt der Unterseiten eine übergeordnete Klasse zuzuweisen. Dies kann mit der Contao eigenen CSS-Klasse besser gelöst werden.
- Es ist (ein bisschen) rechenintensiv beim Aufbau der Navigation für jeden Navigationspunkt die Vererbung zu berechnen.
