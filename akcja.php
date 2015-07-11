<form action="efekt.php" method="POST" name="wybor" id="wybor">
    <select name="list">
        <option value="1">Atak(-1)</option>
        <option value="2">Stwórz eliksir 1-poziomu(-1)</option>
        <option value="3">Stwórz eliksir 2-poziomu(-2)</option>
        <option value="4">Stwórz eliksir 3-poziomu(-3)</option>
        <option value="5">Wypicie eliksiru(-1)</option>
        <option value="6">obrona(2)</option>
        <option value="7">Pass(+1)</option>
    </select>
    <button type="submit">ok</button>
</form>
<?php
include "index.php";

?>