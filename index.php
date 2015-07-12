<?php
header('Content-type: text/html; charset=utf-8');
//require_once 'index.php';
session_start();
?>
<form name="stworz" action="2.php" method="post" xmlns="http://www.w3.org/1999/html">
    <label><b>Wiedźmin</b></label><br>
    <label>Siła:</label>
    <input name="str" type="text"> </input>
    <label>Zręczość:</label>
    <input name="agi" type="text"> </input>
    <label>Szybkość:</label>
    <input name="speed" type="text"> </input>
    <label>Życie:</label>
    <input name="live" type="text"> </input>


<br>
<br><label><b>Przeciwnik Zgredek</b></label><br>
    <label>Siła:</label>
    <input name="str_zgredek" type="text"> </input>
    <label>Zręczość:</label>
    <input name="agi_zgredek" type="text"> </input>
    <label>Szybkość:</label>
    <input name="speed_zgredek" type="text"> </input>
    <label>Życie:</label>
    <input name="live_zgredek" type="text"> </input>
    <button type="submit">Zatwierdź</button>
</form>

<br><br><br>
<p>
    <form>
    <button type="submit">Użyj gotowych</button>
</form>
</p>