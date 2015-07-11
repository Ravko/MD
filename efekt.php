<?php
include 'index.php';
$s = file_get_contents('store');
$a = file_get_contents('potwor');
$geralt = unserialize($s);
$zgredek = unserialize($a);
$geralt->przedstaw_sie();
$zgredek->przedstaw_sie();
include "akcja.php";
if (isset($_POST['list'])){
    $val = $_POST['list'];
    global $qq;
    $eliksir;
    echo $qq;
    switch ($val) {
        case 1: //Atak
            $tp = $geralt->atak($geralt->wez('sila'), $zgredek->wez('zycie'), $geralt->wez('zrecznosc'), $zgredek->wez('zrecznosc'));
            if ($tp <= 0) {
                echo $tp . "<br>Wygrałeś!";
            }
            else
            {
                $hpStworek=$tp;
                $zgredek->zwieksz($tp, 4);
            }
            $geralt->zwieksz($tp, 4);

            break;
        case 2:
            $qq=$geralt->sworzenie_eliksiru(1);
            $geralt->setE($qq);

            break;
        case 3:
            $geralt->sworzenie_eliksiru(2);
            break;
        case 4:
            $geralt->sworzenie_eliksiru(3);
            break;
        case 5:
            $geralt->wypicie_eliksiru($qq);
            $geralt->qq();
            break;
        default:
            echo "ptaszki ćwierkają, żaby kumkają, a słońce poleciało";
            break;

    }}
$s=serialize($geralt);
$zgred = serialize($zgredek);
file_put_contents('store', $s);
file_put_contents('potwor', $zgred);
?>