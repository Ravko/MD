<?php
//require_once 'index.php';
session_start();
?>
<form name="stworz" action="2.php" method="post" xmlns="http://www.w3.org/1999/html">
    <label>Siła:</label>
    <input name="str" type="text"> </input>
    <label>Zręczość:</label>
    <input name="agi" type="text"> </input>
    <label>Szybkość:</label>
    <input name="speed" type="text"> </input>
    <label>Życie:</label>
    <input name="live" type="text"> </input>
    <button type="submit">ok</button>

<br>
<br>
    <label>Siła:</label>
    <input name="str_zgredek" type="text"> </input>
    <label>Zręczość:</label>
    <input name="agi_zgredek" type="text"> </input>
    <label>Szybkość:</label>
    <input name="speed_zgredek" type="text"> </input>
    <label>Życie:</label>
    <input name="live_zgredek" type="text"> </input>
    <button type="submit">ok</button>
</form>
