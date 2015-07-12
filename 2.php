<b><p>Statystyki Wiedźmina</p></b>
<br>
<?php
header('Content-type: text/html; charset=utf-8');
include 'klasa.php';

$str=$_POST['str'];
$agi=$_POST['agi'];
$speed=$_POST['speed'];
$live=$_POST['live'];

$str_zgredek=$_POST['str_zgredek'];
$agi_zgredek=$_POST['agi_zgredek'];
$spee_zgredekd=$_POST['speed_zgredek'];
$live_zgredek=$_POST['live_zgredek'];

$geralt= new wiedzmin($speed, $str, $agi, $live);
$zgredek = new stworek($spee_zgredekd, $str_zgredek, $agi_zgredek, $live_zgredek);
$geralt->zwieksz(0,5);
$zgredek->zwieksz(0,5);
$geralt -> przedstaw_sie();
$s=serialize($geralt);
$zgred = serialize($zgredek);
file_put_contents('store', $s);
file_put_contents('potwor', $zgred);
$_SESSION['obj'] = $geralt;
$_SESSION['obj'] = $zgredek;
$runda =0;
$s=serialize($geralt);
$zgred = serialize($zgredek);
$r= serialize($runda);
file_put_contents('store', $s);
file_put_contents('potwor', $zgred);
file_put_contents('runda', $r);

?>
<form action="akcja.php">
    <button type="submit">Zatwierdź</button>
</form>
