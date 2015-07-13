<?php
header('Content-type: text/html; charset=utf-8');

include 'klasa.php';
static $runda=0;
$s = file_get_contents('store');
$a = file_get_contents('potwor');
$ro = file_get_contents('runda');
$ss = file_get_contents('start');
$geralt = unserialize($s);
$zgredek = unserialize($a);
$runda= unserialize($ro);
$start= unserialize($ss);

//$start=$geralt->zacznij($geralt->wez('szybkosc'), $zgredek->wez('szybkosc'));



echo $start;

if($start==1) {
    /** @var TYPE_NAME $geralt */
    $geralt->BonusCheck($runda);
    $geralt->DefCheck();
    ?>
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
    if (isset($_POST['list'])) {
        $val = $_POST['list'];

        echo "Runda";
        echo $runda;
        echo "<br>";
        switch ($val) {
            case 1: //Atak
                $tp = $geralt->atak($geralt->wez('sila'), $zgredek->wez('zycie'), $geralt->wez('zrecznosc'), $zgredek->wez('zrecznosc'));
                if ($tp <= 0) {
                    echo $tp . "<br>Wygrałeś!";
                    $zgredek->zwieksz($tp, 4);
                } else {
                    echo $tp;
                    $zgredek->zwieksz($tp, 4);
                }

                break;
            case 2:
                $qq = $geralt->sworzenie_eliksiru(1);
                $geralt->setE($qq);

                break;
            case 3:
                $qq = $geralt->sworzenie_eliksiru(2);
                $geralt->setE($qq);
                break;
            case 4:
                $qq = $geralt->sworzenie_eliksiru(3);
                $geralt->setE($qq);
                break;
            case 5:
                $geralt->wypicie_eliksiru();
                break;
            case 6:
                $geralt->obrona();
                break;
            case 7:
                $geralt->koniec_tury();
                $runda++;
                $start=0;
                break;

            default:
                echo "ptaszki ćwierkają, żaby kumkają, a słońce poleciało";
                break;

        }
    }
}
else
{
    if ($zgredek->wez('AP')<=0)
        $start=1;
    while($zgredek->wez('AP')>0)
    {
        echo '<p> Stworek atakuje! </p>';
        $dmg = $zgredek->atak($zgredek->wez('sila'), $geralt->wez('zycie'), $zgredek->wez('zrecznosc'), $geralt->wez('zrecznosc'));
        if ($dmg <= 0) {
            echo $dmg . "<p> Przegrałeś!</p>";
            $geralt->zwieksz($dmg, 4);
        } else {
            echo $dmg;
            $geralt->zwieksz($dmg, 4);
        }
    }
    ?>
    <form action="">
        <button type="submit">ok</button>
    </form>
<?php

}

if($geralt->wez('AP')<=0)
    $start=0;
if(($geralt->wez('AP')<=0) && ($zgredek->wez('AP')<=0))
{
    $runda++;
    $start=$geralt->zacznij($geralt->wez('szybkosc'), $zgredek->wez('szybkosc'));
    $geralt->przydzielAP($geralt->wez('szybkosc'), $zgredek->wez('szybkosc'));
    $zgredek->przydzielAP($zgredek->wez('szybkosc'), $geralt->wez('szybkosc'));
};
echo '<p>';
$geralt->przedstaw_sie();
echo "</p><p>";
$zgredek->przedstaw_sie();
echo '</p>';
$s=serialize($geralt);
$zgred = serialize($zgredek);
$r= serialize($runda);
$st=serialize($start);
file_put_contents('store', $s);
file_put_contents('potwor', $zgred);
file_put_contents('runda', $r);
file_put_contents('start', $st);
?>