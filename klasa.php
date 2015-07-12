<?php
header('Content-type: text/html; charset=utf-8');
class  postac
{
    private $szybkosc;
    private $sila;
    private $zrecznosc;
    private $zycie;
    public static $AP=0;
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

    /**
     * @param $statystyka
     * @return mixed
     */
    public function  wez($statystyka)
    {
        return $this->$statystyka;
    }
    public function zacznij($zr1, $zr2)
    {
        if($zr1>=$zr2)
        {
            while($zr1-$zr2>0)
            {
                $zr1-=$zr2;
                $this->AP++;
            }
            return 1;
        }
        else
        {
            while($zr2-$zr1>0)
            {
                $zr2-=$zr1;
                $this->AP++;
            }
            return 0;
        }
    }
    public function atak($silaAtak, $zycieDef, $zrecznoscAtak, $zrecznoscDef)
    {
        $this->AP-=1;
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
        $temp=parent::wez('AP');
        $temp+=1;
        parent::zwieksz($temp, 5);

    }
		public function przedstaw_sie()
    {
        echo "AP:<br>" . $this->AP . "siła: " . $this->sila . "<br>zręczność: " . $this->zrecznosc . "<br>szybkość: " . $this->szybkosc . "<br>zycie: " . $this->zycie;
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
    private $ktory_bonus;
	public function __Construct($szybkosc, $sila, $zrecznosc, $zycie)
	{
		parent::__Construct($szybkosc, $sila, $zrecznosc, $zycie);
	}
	public function statystyki ($szybkosc, $sila, $zrecznosc, $zycie)
	{
        parent::_Construct($szybkosc, $sila, $zrecznosc, $zycie);

	}

    public  function setE($e)
    {
        $this->eliksir=$e;
    }
    public function sworzenie_eliksiru ($poziom)
    {
        $temp=parent::wez(5);
        $temp-=1+$poziom;
        parent::zwieksz($temp, 'AP');
        $x=mt_rand(1,3);
        switch($x)
        {
            case 1:
                $this->eliksir= 1;
                $this->eliksir_poziom= $poziom;// sprobuj return i przypisz
                echo 'Stworzyles eliksir grom!';
                echo "<br>";
                return 1;
                break;
            case 2:
                $this->eliksir= 2;
                $this->eliksir_poziom= $poziom;
                echo 'stworzyles eliksir zamiec';
                echo "<br>";
                return 2;
                break;
            case 3:
                $this->eliksir= 3;
                $this->eliksir_poziom=$poziom;
                echo 'stworzyles eliksir jaskółka';
                echo "<br>";
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
        $this->bonus=$temp;
        $finito=$podstawa+$temp;
        $podstawa=parent::wez('zycie');
        $podstawa-=2*$this->eliksir_poziom;
        parent::zwieksz(-$podstawa, 4);
        return $finito;

    }
    private function ogarniacz($stat)
    {
        switch($stat)
        {
            case 'sila':
                return 2;
            break;
            case 'szybkosc':
                return 1;
            //todo o ile potrzebne dodaj wiecej statsow...
            default:
                echo 'Ogarniacz nie ogarnął :(';
        }
    }
    public function BonusCheck($runda)
    {
        if(($runda%4==0) && ($this->ktory_bonus != null))
        {
            $stat=parent::wez($this->ktory_bonus);
            $ss=$stat;
            $ss-=$this->bonus;
            parent::zwieksz($ss,$this->ogarniacz($this->ktory_bonus));
        }
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
                //$this->bonus=$temp;
                $this->ktory_bonus='sila';
                echo $this->ktory_bonus;
                /*$asd=parent::wez('sila');
                echo $asd . $temp;*/
                break;
            case 2:
                $temp=$this->formula('szybkosc');
                //$this->bonus=$temp;
                $this->ktory_bonus='szybkosc';
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
        $this->eliksir=null;

    }
    public function obrona()
    {
        $temp=parent::wez('AP');
        $temp-=2;
        parent::zwieksz($temp, 5);
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
 // $geralt = new wiedzmin(20, 15, 10, 5);
 // $zgredek = new stworek(10, 10, 10, 50);

/*}
else
{
    $geralt=unserialize($w);
    $zgredek=unserialize($z);
}*//*
echo "zz";
static $runda=0;
//$geralt->sworzenie_eliksiru(3);
//$geralt->qq();
echo '<br>';
//$geralt= $_SESSION['obj'];
//$zgredek = $_SESSION['obj2'];
$runda = $_SESSION['runda'];
//echo var_dump($zgredek);
echo '<br>';
//$geralt->wypicie_eliksiru();
echo '<br>';*/

//$geralt=$_SESSION['obj'];


 /*   ?>
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
    $runda++;
    echo $runda;
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
//$_SESSION['obj'] = $geralt;
//$_SESSION['obj'] = $zgredek;
$_SESSION['runda'] = $runda;
//echo var_dump($geralt);
echo "<br><br>";

//$zgredek->przedstaw_sie();
//$w = serialize($geralt);
//$z = serialize($zgredek);
*/

?>