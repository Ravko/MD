<?php
class  postac
{
    private $szybkosc;
    private $sila;
    private $zrecznosc;
    private $zycie;
    private $AP;
    private $szansa;

    public function __Construct($szybkosc, $sila, $zrecznosc, $zycie)
    {
        $this->szybkosc=$szybkosc;
        $this->sila=$sila;
        $this->zrecznosc=$zrecznosc;
        $this->zycie=$zycie;
    }
	public function zwieksz($ile, $co)
	{
        switch($co)
        {
            case 1:
                $this->szybkosc=$ile;
                break;
            case 2:
                $this->sila=$ile;
                break;
            case 3:
                $this->zrecznosc=$ile;
                break;
            case 4:
                $this->zycie=$ile;
                break;
            case 5:
                $this->AP=$ile;
                break;
        }

	}
    public function  wez($statystyka)
    {
        return $this->$statystyka;
    }
    public function atak($silaAtak, $zycieDef, $zrecznoscAtak, $zrecznoscDef)
    {
        $szansa = mt_rand(100);
		$SK= (($zrecznoscAtak-$zrecznoscDef) / $zrecznoscDef) * 100/100;
		if($SK>90)
            $SK=90;
        else if($SK<10)
            $SK=10;
		
		if($szansa>=$SK)
            $zycieDef-=$silaAtak;
        else
            echo 'pudlo';
	}
    public function koniec_tury()
    {

    }
		public function przedstaw_sie()
    {
        echo "siła: " . $this->sila . "<br>zręczność: " . $this->zrecznosc . "<br>szybkość: " . $this->szybkosc . "<br>zycie: " . $this->zycie;
		//echo self::$sila;
    }
}
class wiedzmin extends postac
{
    private $obrona;
    private $eliksir;
    private $eliksir_poziom;
    private $czas;
	public function __Construct($szybkosc, $sila, $zrecznosc, $zycie)
	{
		parent::__Construct($szybkosc, $sila, $zrecznosc, $zycie);
	}
	public function statystyki ($szybkosc, $sila, $zrecznosc, $zycie)
	{
        parent::_Construct($szybkosc, $sila, $zrecznosc, $zycie);

	}
    public function sworzenie_eliksiru ($random)
    {
        switch($random)
        {
            case 1:
                $this->eliksir=1;
                $this->eliksir_poziom=mt_rand(1,3);
                echo '<br>' . $this->eliksir_poziom;
                break;
            case 2:
                $this->eliksir=2;
                $this->eliksir_poziom=mt_rand(1,3);
                break;
            case 3:
                $this->eliksir=3;
                $this->eliksir_poziom=mt_rand(1,3);
                break;
            default:
                echo "cos poszlo nie tak";
                break;
        }

    }
    private function formula($stat)
    {
        $podstawa=parent::wez($stat);;
        $finito=0;
        $temp=0;
        $temp=0.2*$this->eliksir_poziom;
        $temp=$podstawa*$temp;
        $finito=$podstawa+$temp;
        $podstawa=parent::wez('zycie');
        $podstawa-=2*$this->eliksir_poziom;
        parent::zwieksz(-$podstawa, 4);
        return $finito;

    }
	public function wypicie_eliksiru($eliksir)
    {
        $temp=0;
        switch($eliksir)
        {
            case 1:
                $temp=$this->formula('sila');
                parent::zwieksz($temp, 2);
                /*$asd=parent::wez('sila');
                echo $asd . $temp;*/
                break;
            case 2:
                $temp=$this->formula('szybkosc');
                parent::zwieksz($temp, 1);
                break;
            case 3:
                $temp=parent::wez('zycie');
                $z= $temp * $this->eliksir_poziom;
                $z= $temp + $z;
                if($z>$temp)
                    parent::zwieksz($temp, 4);
                else
                    parent::zwieksz($z, 4);
			break;
            default:
                echo "wiedźmin coś pochendorzył i zamiast eliksiru novigradzej żytniej łyknął";
                break;
        }
    }
    public function obrona()
    {

    }
}
class stworek extends postac
{
    public function __Construct($szybkosc, $sila, $zrecznosc, $zycie)
    {
        parent::__Construct($szybkosc, $sila, $zrecznosc, $zycie);
    }
}

echo "asd<br>";
$geralt = new wiedzmin(20, 15, 10, 5);
//geralt->zwieksz(19);
//$geralt->statystyki(20, 20, 20, 20);
$geralt->przedstaw_sie();
$qq = mt_rand(1,3);
echo '<br>' . $qq;
$geralt->sworzenie_eliksiru(1);
echo '<br>';
$geralt->wypicie_eliksiru(3);
echo '<br>';
$geralt->przedstaw_sie();

?>