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
        $szansa = mt_rand(1, 100);
        //echo '<br>'.$szansa . '<br>' . $zrecznoscAtak . '<br>' ;
        $tmp = $zrecznoscAtak-$zrecznoscDef;
        if($tmp<=0)
        {
            $SK=10;
        }
        else
        {
            $SK= $tmp / $zrecznoscDef;
        }
		if($SK>90)
            $SK=90;
        else if($SK<10)
            $SK=10;
		//echo $SK . '<br>' ;
		if($szansa>=$SK)
           return $zycieDef - $silaAtak;
        else
            echo 'pudło';
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
    private $bonus;
	public function __Construct($szybkosc, $sila, $zrecznosc, $zycie)
	{
		parent::__Construct($szybkosc, $sila, $zrecznosc, $zycie);
	}
	public function statystyki ($szybkosc, $sila, $zrecznosc, $zycie)
	{
        parent::_Construct($szybkosc, $sila, $zrecznosc, $zycie);

	}
    public  function qq()
    {
        echo $this->eliksir;
    }
    public  function setE($e)
    {
        $this->eliksir=$e;
    }
    public function sworzenie_eliksiru ($poziom)
    {
        $x=mt_rand(1,3);
        switch($x)
        {
            case 1:
                $this->eliksir= 1;
                $this->eliksir_poziom= $poziom;// sprobuj return i przypisz
                return 1;
                break;
            case 2:
                $this->eliksir= 2;
                $this->eliksir_poziom= $poziom;
                return 2;
                break;
            case 3:
                $this->eliksir= 3;
                $this->eliksir_poziom=$poziom;
                return 3;
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
	public function wypicie_eliksiru()
    {
        $temp=parent::wez('AP');
        $temp-=1;
        parent::zwieksz($temp, 5);
        //echo $this->eliksir;
        switch($this->eliksir)
        {
            case 1:
                $temp=$this->formula('sila');
                parent::zwieksz($temp, 2);
                $this->bonus=$temp;
                /*$asd=parent::wez('sila');
                echo $asd . $temp;*/
                break;
            case 2:
                $temp=$this->formula('szybkosc');
                $this->bonus=$temp;
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
        $temp=parent::wez(3);
        $temp+=$temp;


    }
}
class stworek extends postac
{
    public function __Construct($szybkosc, $sila, $zrecznosc, $zycie)
    {
        parent::__Construct($szybkosc, $sila, $zrecznosc, $zycie);
    }
}
session_start();
  $geralt = new wiedzmin(20, 15, 10, 5);
  $zgredek = new stworek(10, 10, 10, 50);

/*}
else
{
    $geralt=unserialize($w);
    $zgredek=unserialize($z);
}*/
echo "zz";
//$geralt->sworzenie_eliksiru(3);
//$geralt->qq();
echo '<br>';
$geralt= $_SESSION['obj'];
echo '<br>';
//$geralt->wypicie_eliksiru();
echo '<br>';

//$geralt=$_SESSION['obj'];

$geralt->qq();
    ?>
    <form action="" method="POST" name="wybor" id="wybor">
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
                $zgredek->zwieksz($tp, 4);
            }

            break;
        case 2:
            $qq=$geralt->sworzenie_eliksiru(1);
            $geralt->setE($qq);

            break;
        case 3:
            $qq=$geralt->sworzenie_eliksiru(2);
            $geralt->setE($qq);
            break;
        case 4:
            $qq=$geralt->sworzenie_eliksiru(3);
            $geralt->setE($qq);
            break;
        case 5:
            $geralt->wypicie_eliksiru($qq);
            $geralt->qq();
            break;
        default:
            echo "ptaszki ćwierkają, żaby kumkają, a słońce poleciało";
            break;

    }}
$_SESSION['obj'] = $geralt;
echo var_dump($geralt);
echo "<br><br>";
$geralt->qq();
$geralt->przedstaw_sie();
//$zgredek->przedstaw_sie();
//$w = serialize($geralt);
//$z = serialize($zgredek);


?>