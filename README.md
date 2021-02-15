# Seitenfelder mit Vererbung

Die Erweiterung ergänzt die Seite (tl_page) mit 2 Felder die auf die Unterseiten vererbt werden.

### CSS-Klasse mit Vererbung
Feld «CSS-Klasse» wird auf die Unterseiten vererbt und automatisch im <body> als Klasse hinzugefügt. Es ist keine Konfiguration mehr nötig.

### Eigener Wert mit Vererbung
Feld «Eigener Wert» wird auf die Unterseiten vererbt und wird über das Modul «Seitenfeld mit Vererbung» hinzugefügt. So kann beispielsweise pro Seiten-Stamm ein zusätzliches .css geladen werden.
- Modul «Seitenfeld mit Vererbung» erstellen
- Template anpassen
- Modul über Themes -> Layout oder per Inserttag platzieren

![alt text](https://github.com/delirius/pageinherit/blob/main/screen.jpg?raw=true)

### Was die Erweiterung nicht macht
Das Feld CSS-Klasse wird in der Navigation **nicht** ergänzt.
- Es macht wenig Sinn jedem Navigationspunkt der Unterseiten eine übergeordnete Klasse zuzuweisen. Dies kann mit der Contao eigenen CSS-Klasse besser gelöst werden.
- Es ist (ein bisschen) rechenintensiv beim Aufbau der Navigation für jeden Navigationspunkt die Vererbung zu berechnen.
