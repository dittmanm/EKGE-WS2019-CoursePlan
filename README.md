# EKGI-WS2019-CoursePlan - Lehrplanung
Die Anwendung „Lehrplanung“ ist im Rahmen der Lehrveranstaltung „Enterprise Knowledge Graph Implementation" entwickelt worden. Ziel des Projektes ist die Entwicklung einer Anwendung, welche die Dozenten bei der Modulplanung an der Technischen Hochschule Brandenburg unterstützt. Die Anwendung wurde von Grund auf neu entwickelt.

## Anforderungen die Rahmen dieses Projektes umgesetzt worden sind:
- Entwicklung eines Wissensschema
- Umsetzung eines RDF-Schemas mit Beispieldaten
- Kompaktes klares Design das alle notwendigen Informationen übersichtlich darstellt
- Auswahl der System-Architektur und Einrichtung der Server
- Entwicklung der Anwendung mit PHP und SPARQL
- Implementierung der Anwendung Lehrplanung
- Interaktive Zuordnung von Lehrveranstaltungen zu Dozenten mit paralleler Statusvisualisierung
- Ist innerhalb des Universitätsnetzes erreichbar, läuft auf einem internen Server
- Visualisiert den Planungsstatus von Studiensemestern, Modulen und Dozenten

## Design
Der erste Design Prototyp wurde mit Hilfe der Design Thinking Methode umgesetzt und wurden in einen iterativen Prozess stetig weiterentwickelt.
Durch Anwendung der Scrum Methode und die damit verbundenen regelmäßige Meetings, konnten die einzelnen Arbeitspakete schnell umgesetzt werden. Das Hauptziel war es einfache übersichtliche Oberfläche zu erstellen, damit alle relevanten Informationen schnell erreicht und kompakt dargestellt werden. Während des Entwicklungsprozesses wurde das Design stetig weiterentwickelt. Die Anforderungen und neue Funktionen konnten durch die agile Arbeitsweise und den regelmäßigen Austausch mit unserer Auftraggeberin (Fr. Prof. Dr. Vera G. Meister) schnell umgesetzt werden.

## Wissensschema Lehrplanung
Die Grundlage zur Entwicklung unserer Anwendung bildet das Wissensschema, mit dem Ziel, die Dozenten bei der Lehrplanung innerhalb der einzelnen Fakultäten der Technischen Hochschule Brandenburg zu unterstützen. Es wird die Struktur, sowie die Relationen zu den Studiengängen mit den einzelnen Modulen und Dozenten der Technischen Hochschule Brandenburg im Gesamtüberblick vermittelt und dient als Basis zur Entwicklung der Semantischen Anwendung. Die aktuelle Version des Wissen Schema umfasst neben den Modulen und Dozenten sowohl die Studiengänge als auch die Fachbereiche der Technischen Hochschule Brandenburg. In der aktuellen Entwicklung wird ausschließlich der Fachbereich Wirtschaft betrachtet. Sollte das Tool in der Zukunft, auch in den anderen Fachbereichen genutzt werden, ist mit dem Wissensschema bereits die Grundlage geschaffen und kann bei Bedarf erweitert werden. Die rot gekennzeichneten Klassen, Relationen und Attributen sind durch das Vokabular von schema.org definiert. Das grün gekennzeichnete Vokabular basiert auf die Sprache, die im Hochschulkontext verwendet wird und dem Vokabular, das in der der Technischen Hochschule Brandenburg verwendet wird. Die Modellierung dieses Wissensgraphen erfolgt mit Hilfe des Tools Cmap.

## Ergebnis
### Am Ende nochmal eine kleine Übersicht mit den Funktionen die im Rahmen des Projektes umgesetzt wurden.
- Darstellung der unterschiedlichen Sichten des Menüs je nach Sommersemester und Wintersemester
- Lehrplanung Übersicht aller Dozenten mit Dashboard
- Interaktive Zuordnung von Lehrveranstaltungen zu Dozenten mit paralleler Statusvisualisierung
- Visualisiert den Planungsstatus von Studiensemestern, Modulen und Dozenten 

### Einstellungen
- Die Möglichkeit neue Professoren anzulegen bearbeiten oder zu löschen
- Die Möglichkeit neue Module anzulegen editieren und löschen
- Sicherheitsabfrage ob der Datensatz wirklich gelöscht werden soll