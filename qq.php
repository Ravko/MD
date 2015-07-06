<?php
class  postac
{
    private $szybkosc;
    private $sila;
    private $zrecznosc;
    private $zycie;
    private $AP;
    mt_srand();
    private $szansa;
    $szansa = mt_rand(100);
    function _Construct($szybkosc, $sila, $zrecznosc, $zycie, $AP)
    {
        $this->szybkosc=$szybkosc;
        $this->sila=$sila;
        $this->zrecznosc=$zrecznosc;
        $this->zycie=$zycie;
        $this->AP=$AP;
    }
    function atak($silaAtak, $zycieDef, $zrecznoscAtak, $zrecznoscDef)
    {

		$SK= (($zrecznoscAtak-$zrecznoscDef) / $zrecznoscDef) * 100/100;
		if($SK>90)
            $SK=90;
        else if($SK<10)
            $SK=10;
		
		if($szansa>=$SK)
            $zycieDef-=$silaAtak;
        else
            echo 'pud�o';
	}
    function koniec_tury()
    {

    }
}
class eliksir
{
    private $nazwa;
    private $opis;
    function _Construct($nazwa, $opis)
    {
        $this->nazwa=$nazwa;
        $this->opis=$opis;
    }
    function przedstaw_sie()
    {
        echo 'eliskir: ' . $opis;
    }

}
class wiedzmin extends postac
{
    private $obrona;
    private $eliksir;
    private $eliksir_poziom;
    function sworzenie_eliksiru ($random)
    {
        switch($random)
        {
            case 1:
                $this->eliksir=1;
                break;
            case 2:
                $this->eliksir=2;
                break;
            case 3:
                $this->eliksir=3;
                break;
            default:
                echo "cos poszlo nie tak";
                break;
        }

    }
    function wypicie_eliksiru()
    {
        switch($eliksir)
        {
            case 1:
                $this->sila=$this->sila + $sila*($eliksir_poziom*10/100);
                $this->zycie=$this->zycie - (zycie*10/100);
                break;
            case 2:
                $this->zrecznosc=$this->zrecznosc + $zrecznosc*($eliksir_poziom*10/100);
                $this->zycie=$this->zycie - (zycie*10/100);
                break;
            case 3:
                $this->zycie = $this->zycie + $zycie*($eliksir_poziom*10/100);
			break;
            default:
                echo "wied�min co� pochendorzy� i zamiast eliksiru novigradzej �ytniej �ykn��";
                break;
        }
    }
    function obrona()
    {

    }

}
class stowrek extends postac
{

}


?>