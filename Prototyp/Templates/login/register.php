<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2>Registrierung zur Verwaltung der Bibliothek der Oberlinschule</h2>
<div class="new">
  <form action="index.php">
    <p>Name: <input name="title" type="text" /></p>
    <p>Vorname: <input name="subtitle" type="text" /></p>
    <p>Benutzername: <input name="isbn" type="text" /></p>
    <p>Anzahl: <input name="number" type="text" /></p>
    <p>Verlag: <input name="publisher" type="text" /></p>
    <p>Beschreibung: <br /><textarea name="description" cols="50" rows="10"></textarea></p>
    <input type='hidden' name="model" value="<?php echo $table; ?>" />
    <input type='hidden' name="controller" value="list" />
    <input type='hidden' name="action" value="create" />
    <p><input value="SPEICHERN" name="button" type="submit"></p>
  </form>
</div>
<p class="back">
  <?php echo '<a href="?model='.$table.'&controller=list">Zurück zur Listen-Ansicht</a>'; ?>
</p>
<p>&nbsp;</p>

<p>Name: <input name="lastname" type="text" /></p>
        <p>Vorname: <input name="firstname" type="text" /></p>
        <select name="schoolpart">
          <option value="Grundstufe">Grundstufe</option>
          <option value="Sekundarstufe">Sekundarstufe</option>
          <option value="Geistige-Entwicklung">Schulbereich Geistige Entwicklung</option>
          <option value="Taubblinde/Hörsehbehinderte">Schulbereich Taubblinde/Hörsehbehinderte</option>
        </select>
        <p>Position: <input name="position" type="text" /></p>
        <p>E-Mail: <input name="email" type="text" /></p>
        <input type='hidden' name="model" value="Users" />
        <input type='hidden' name="controller" value="new" />
        <p><input value="SPEICHERN" name="button" type="submit"></p>