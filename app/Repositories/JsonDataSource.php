<?php

namespace App\Repositories;

use File;
use App\Car;
use App\CarModel;

class JsonDataSource implements DataSourceInterface
{
	private $jsonFileName;

	public function __construct($jsonFileName)
	{
		$this->jsonFileName = $jsonFileName;
	}

	public function getData()
	{

		$jsonData = File::get($this->jsonFileName);

		$phpData = json_decode($jsonData);

		$collection = $this->transformDataIntoCarModelsCollection($phpData);
					
		return $collection;
	}	

	private function transformDataIntoCarModelsCollection($phpData)
	{

		$carModels = [];

		foreach($phpData as $object) {
			$carModel = new CarModel();
			$carModel->setModelId($object->modelId);
			$carModel->setCo2Emissions($object->co2Emmissions);
			$carModel->setMpg($object->mpg);
			$carModel->setEnginePower($object->enginePower);
			$carModel->setEngineSize($object->engineSize);
			$carModel->setFuelType($object->fuelType);				

			$cars = $this->transformDataIntoCarsCollection($object->modelId, $object->cars);

			$carModel->setCars($cars);

			$carModels[] =$carModel;
		}

		return collect($carModels);
	}

	private function transformDataIntoCarsCollection($modelId, $carsData)
	{
		$cars = [];

		foreach($carsData as $object) {
			$car = new Car();
			$car->setId($object->id);
			$car->setModelId($modelId);
			$car->setMileage($object->mileage);
			$car->setRegistration($object->registration);
			$car->setTransmission($object->transmission);
			$car->setOwners($object->owners);
			$car->setDescription($object->description);
			$car->setPrice($object->price);
			$car->setPhotos($object->photos);

			$cars[] = $car;
		}

		return collect($cars);

	}
}