<?php
class Teleporter
{

}
class eliksir 
{
	private $nazwa;
	private $opis;
	private $count;
	public function stworz($nazwa)
	{
		$this->nazwa = $nazwa;
		echo 'Eliksir '. $this->nazwa.' zostal stworzony';
	}
	public function spis()
	{
		echo '<BR>Posiadasz eliksir: '.$this->nazwa;
	}
	public function uzyj($nazwa)
	{
	$tmp=0;
		switch($nazwa)
		{
			case 'grom':
			$this->sila +=4;
			echo $tmp;
			break;
			
			case 'jaskolka':
			$this->wytrzymalosc +=5;
			break;
			
			case 'zamiec':
			$this->zrecznosc +=5;
			break;
			
			default:
			return 'pupa';
			break;
		}
		return 'Eliksir ' .$nazwa. 'zostal wypity';
	}
}
class Umiejetnosci
{
	private $nazwa;
	private $opis;
	public function new_skill($name, $opis)
	{
		$this->nazwa = $name;
		$this->opis = $opis;
		echo 'Nowa umiejetnosc: '. $this->nazwa . ' zostala ogarnieta';
	}
	public function show()
	{
		echo $this->nazwa. "<BR>" . $this->opis;
	}
	
}
interface druzyna{
public function przedstaw_team($array);
}
class Postac extends eliksir implements druzyna
{
	private $name;
	private $klasa;
	private $ekwipunek;
	private $sila;
	private $zrecznosc;
	private $wytrzymalosc;
	private $skill;
	private $skill1;
	private $skill2;
	private $skill3;
	private $tmp='';
	private $hero;
	
	public function IsHero($isHe)
	{
		if($isHe!=0)
		$this->hero = true;
		else
		$this->hero = false;
	}
	
	public function przedstaw_team($array)
	{
		foreach ($array as $value){
		echo $value->przedstaw_sie(). '<br>';
		}
	}
	
	public function new_char($name, $klasa, $ekwipunek, $sila, $zrecznosc, $wytrzymalosc, $skill)
	{
	$this ->name = $name;
	$this ->klasa = $klasa;
	$this ->ekwipunek = $ekwipunek;
	$this ->sila = $sila;
	$this ->zrecznosc = $zrecznosc;
	$this ->wytrzymalosc = $wytrzymalosc;
	$this ->skill = $skill;
	}
	public function przedstaw_sie()
	{
	return $this->name. ' jestem ' . $this->klasa;
	}
	public function stats()
	{
	return 'O to moje statystyki<br>Si³a: '. $this->sila .'<br>Zrecznosc: '. $this->zrecznosc . '<br>Wytrzyma³oœæ: '.$this->wytrzymalosc;
	}
	
	public function nowe_umiejetnosci($skill1, $skill2, $skill3)
	{
		$this->skill1 = $skill1;
		$this->skill2 = $skill2;
		$this->skill3 = $skill3;
	}
	public function uzyj_umiejetnosci($skill)
	{
		switch ($skill)
		{
			case 1:
			$this->tmp = $this->skill1;
			break;
			
			case 2:
			$this->tmp=$this->skill2;
			break;
			
			case 3:
			$this->tmp= $this -> skill3;
			break;
			
			default:
			return 'klops';
			break;
		}
		return $this->name. ' U¿ywa ' . $this->tmp;
	}
	
	public function sila_()
	{
		return $this->sila;
	}
}

class creature
{
	public $name;
	public $lvl;
}
class adventure_quest
{
	private $zadanie;
	private $opis;
	private $deadline;
	public function opisz()
	{
		echo $this->zadanie. '<br>' . $this->opis . '<br>' . $this->deadline;
	}
	public function dodaj_questa($tytul, $desc, $dead)
	{
		$this->zadanie = $tytul;
		$this->opis = $desc;
		$this->deadline = $dead;
	}
}

class miecz
{
	private $nazwa;
	private $obry;
	public dodaj_miecz($nazwa, $obry)
	{
	$this->nazwa=$nazwa;
	$this->obry=$obry;
	}
	public get()
	{
		echo $this->nazwa;
	}
}

$wiedzmin = new Postac;
$zelazlo = new miecz;
$zelazlo->dodaj_miecz('Miecz zelazny', 10);
$srebro = new miecz;
$srebro->dodaj_miecz('Miecz srebny', 15);
$wiedzmin->new_char('Geralt', 'wiedzmin', 'aa', 25, 25, 25, 'szybki atak');
$wiedzmin->nowe_umiejetnosci('Szybki atak', 'Mocny atak', 'znak');
echo $wiedzmin->przedstaw_sie();
echo '<br>'. $wiedzmin->stats();
echo '<br>'. $wiedzmin->uzyj_umiejetnosci(1);
$eliksiry = new eliksir;
echo '<br>';
$wiedzmin->stworz('grom');
$wiedzmin->spis();
echo $wiedzmin->uzyj('grom');
echo $wiedzmin->stats();
echo "<BR>";
$jen = new Postac;
$jen->new_char('Jen', 'czarodziejka', 'magiczna laska', 10, 10, 10, 'zaklecie');
$jen->nowe_umiejetnosci('Pozoga', 'ognista kula', 'sciana ognia');
echo $jen->przedstaw_sie();
echo "<BR>";
echo $jen->uzyj_umiejetnosci(2);

echo "<BR>";
$team = array($wiedzmin, $jen);
$wiedzmin->przedstaw_sie($team);
echo "<BR>";
echo '<br>zxc';
?>