<?php
	class Airport
	{
		protected $planeList = array();
		public function acceptPlane(Airplane $plane) // Принять самолет
		{
			$this->planeList["$plane->name"] = $plane;
			$this->planeList["$plane->name"]->status = "Самолет принят в аэропорту";
		}

		public function planeClearedAndTookOff(Airplane $plane) // Самолет освободил место и улетел
		{
			$this->planeList["$plane->name"] = "Самолет освободил место и улетел";
			$plane->status = "Самолет в воздухе";
			return $plane;
		}

		public function planeWentParking(Airplane $plane) // Самолет ушел на стоянку
		{
			$this->planeList["$plane->name"]->status = "Самолет ушел на стоянку";
		}

		public function planeReadyTakeOff(Airplane $plane) // Самолет готов взлетать
		{
			$this->planeList["$plane->name"]->status = "Самолет готов взлетать";
		}

		public function planeRepair(Airplane $plane) // Ремонт самолета (Придуманный метод)
		{
			$this->planeList["$plane->name"]->hp = 10;
		}

		public function createMig(string $name, float $maxSpeed) // Создание самолета в аэропорту(Придуманный метод)
		{
			$plane = new Mig($name,$maxSpeed);
			$this->acceptPlane($plane);
			$this->planeList["$name"]->status = "Самолет создан в аэропорту";
		}
		
	}
	abstract class Airplane
	{
		public $name;
		protected $maxSpeed;
		public $hp;
		public $status = "Самолет на земле"; // Самолет находится в воздухе или на земле
		public function __construct(string $name, float $maxSpeed)
		{
			$this->name = $name;
			$this->maxSpeed = $maxSpeed;
		}
		abstract public function getStatus(); // Получение статуса самолета
		abstract public function takeOffOrLanding(); // Посадка или взлет самолета с одинаковой реализацией
	}

	class Mig extends Airplane
	{
		public $hp = 10;
		public function performAttack(Airplane $plane) // метод "Атака" для самолетов типа МИГ
		{
			$plane->hp--;
			return $plane;
		}
		public function getStatus() // Получение статуса самолета
		{
			echo "$this->status";
			return $this->status;
		} 
		public function takeOffOrLanding() // Посадка или взлет самолета с одинаковой реализацией
		{
			$this->status = ($this->plane == "Самолет на земле") ? "Самолет в воздухе" : "Самолет на земле";
		}
	}

	class Ty_154 extends Airplane
	{
		public $hp = 10;
		public function getStatus() // Получение статуса самолета
		{
			echo "$this->status";
			return $this->status;
		} 
		public function takeOffOrLanding() // Посадка или взлет самолета с одинаковой реализацией
		{
			$this->status = ($this->plane == "Самолет на земле") ? "Самолет в воздухе" : "Самолет на земле";
		}
	}
	// Тест всех методов:
	// $firstPlane = new Mig("Первый самолет", 100);
	// $secondPlane = new Ty_154("Второй самолет", 150);
	// $thirdPlane = new Mig("Третий самолет", 200);
	// $airport = new Airport();
	// $firstPlane->performAttack($secondPlane);
	// $airport->acceptPlane($firstPlane);
	// $airport->acceptPlane($secondPlane);
	// $airport->acceptPlane($thirdPlane);
	// $airport->createMig("Мой самолет", 250);
	// $airport->planeWentParking($firstPlane);
	// $airport->planeReadyTakeOff($secondPlane);
	// $airport->planeClearedAndTookOff($thirdPlane);
	// $airport->planeRepair($secondPlane);	
	// echo ''.print_r($airport).'';
	// $thirdPlane->getStatus();
	// $thirdPlane->takeOffOrLanding();
	// echo "\n";
	// $thirdPlane->getStatus();
?>