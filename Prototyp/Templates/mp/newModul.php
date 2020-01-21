<h2>Modul anlegen</h2>
<div class="new">
  <form action="index.php" method="POST">
    <p>Name: <input name="name" type="text" /></p>
    <p>timeRequired: <input name="timeRequired" type="text" /></p>
    <p>Semester:
      <select name="semesterSeason" size="1">
        <option value="WiSe">WiSe</option>
        <option value="SoSe">SoSe</option>
      </select>
    </p>
    <p>isPartOf:
      <select name="isPartOf" size="1">
        <option value="wi_ba">WI BA</option>
        <option value="wi_ma">WI MA</option>
        <option value="bwl_ba">BWL BA</option>
        <option value="bwl_ma">BWL MA</option>
        <option value="secm_ma">Secm MA</option>
      </select>
    </p>
    <p>startDate:
      <select name="startDate" size="1">
        <option value="1. Semester">1. Semester</option>
        <option value="2. Semester">2. Semester</option>
        <option value="3. Semester">3. Semester</option>
        <option value="4. Semester">4. Semester</option>
        <option value="5. Semester">5. Semester</option>
      </select>
    </p>
    <input type='hidden' name="model" value="mp" />
    <input type='hidden' name="controller" value="mp" />
    <input type='hidden' name="action" value="create" />
    <p><input value="SPEICHERN" name="button" type="submit"></p>
    <p><input value="ZURÜCKSETZEN" name="button" type="reset"></p>
  </form>
</div>