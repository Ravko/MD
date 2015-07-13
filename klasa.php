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

    /** Konstruktor
     * @param $szybkosc
     * @param $sila
     * @param $zrecznosc
     * @param $zycie
     */
    public function __Construct($szybkosc, $sila, $zrecznosc, $zycie)
    {
        $this->szybkosc=$szybkosc;
        $this->sila=$sila;
        $this->zrecznosc=$zrecznosc;
        $this->zycie=$zycie;
    }

    /** Przypisuje odpowiedniej statystyce liczbę
     * @param $ile
     * @param $co
     */
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

    /** zwraca określoną statystyke
     * @param $statystyka
     * @return mixed
     */
    public function  wez($statystyka)
    {
        return $this->$statystyka;
    }

    /**rozdziela statystyki
     * @param $zr1
     * @param $zr2
     */
    public function przydzielAP($zr1, $zr2)
    {
        $temp=$zr1;
        $temp-=$zr2;
        while($temp >=0)
        {
            $temp-=$zr2;
            $this->AP++;
        }
        if ($this->AP == 0)
            $this->AP++;
    }

    /** sprawdza kto zaczyna
     * @param $zr1
     * @param $zr2
     * @return int
     */
    public function zacznij($zr1, $zr2)
    {
        if($zr1>=$zr2)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    /** sprawdza szanse na atak zwraca zdrowie po wykonanym ataku lub samo zdrowie
     * @param $silaAtak
     * @param $zycieDef
     * @param $zrecznoscAtak
     * @param $zrecznoscDef
     * @return mixed
     */
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
        {
            echo '<p>Atak sie powiódł</p>';
            return $zycieDef - $silaAtak;
        }
        else
        {
            echo '<p>pudło</p>';
            return $zycieDef;
        }
	}

    /** koniec tury
     *
     */
    public function koniec_tury()
    {
        $temp=$this->wez('AP');
        $temp+=1;
        $this->zwieksz($temp, 5);

    }

    /** wyświetla statystyki
     *
     */
		public function przedstaw_sie()
    {
        echo "AP: " . $this->AP . "<br>siła: " . $this->sila . "<br>zręczność: " . $this->zrecznosc . "<br>szybkość: " . $this->szybkosc . "<br>zycie: " . $this->zycie;
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
    private $obrona_bonus;

    /**Konstruktor
     * @param $szybkosc
     * @param $sila
     * @param $zrecznosc
     * @param $zycie
     */
	public function __Construct($szybkosc, $sila, $zrecznosc, $zycie)
	{
		parent::__Construct($szybkosc, $sila, $zrecznosc, $zycie);
	}
	public function statystyki ($szybkosc, $sila, $zrecznosc, $zycie)
	{
        parent::_Construct($szybkosc, $sila, $zrecznosc, $zycie);

	}

    /** przypisuje eliksir
     * @param $e
     */
    public  function setE($e)
    {
        $this->eliksir=$e;
    }

    /** Tworzy rosowy eliksir, zwraca ktory stworzylo
     * @param $poziom
     * @return int
     */
    public function sworzenie_eliksiru ($poziom)
    {
        $temp=parent::wez('AP');
        $temp-=1+$poziom;
        parent::zwieksz($temp, 5);
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

    /** ustala bonus eliksiru
     * @param $stat
     * @return int|mixed
     */
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
        $temp=2*$this->eliksir_poziom;
        $podstawa-=$temp;
        parent::zwieksz($podstawa, 4);
        return $finito;

    }

    /** enumeruje slowa, zwara statystyki
     * @param $stat
     * @return int
     */
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

    /** sprawdza aktywny bonus
     * @param $runda
     */
    public function BonusCheck($runda)
    {
        if(($runda%4==0) && ($this->ktory_bonus != null))
        {
            $stat=parent::wez($this->ktory_bonus);
            $ss=$stat;
            $ss-=$this->bonus;
            parent::zwieksz($ss,$this->ogarniacz($this->ktory_bonus));
            $this->ktory_bonus= null;
        }
    }

    /** sprawdza bonus do obrony
     *
     */
    public function DefCheck()
    {
        if($this->obrona_bonus)
        {
            $temp=parent::wez('zrecznosc');
            $temp=$temp/2;
            parent::zwieksz($temp, 3);
            $this->obrona_bonus = false;
        }
    }

    /**usuwa eliksir i przypisuje statystyki
     *
     */
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
                //echo $this->ktory_bonus;
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
                $temp=parent::wez('sila');
                $z= $temp * $this->eliksir_poziom;
                $z= $temp + $z;
                $temp=parent::wez('zycie');
                $z+=$temp;
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

    /**podwaja zręczność, aktywuje bonus do obrony
     *
     */
    public function obrona()
    {
        $temp=parent::wez('AP');
        $temp-=2;
        parent::zwieksz($temp, 5);
        $temp=parent::wez('zrecznosc');
        $temp+=$temp;
        parent::zwieksz($temp, 3);
        $this->obrona_bonus = true;

    }
}
class stworek extends postac
{
    /** Konstruktor
     * @param $szybkosc
     * @param $sila
     * @param $zrecznosc
     * @param $zycie
     */
    public function __Construct($szybkosc, $sila, $zrecznosc, $zycie)
    {
        parent::__Construct($szybkosc, $sila, $zrecznosc, $zycie);
    }
}
session_start();


?>