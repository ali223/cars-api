<?php

namespace App\Repositories;

use App\Car;
use App\CarModel;
use Illuminate\Support\Collection;

class CarModelsJsonRepository implements CarModelsRepositoryInterface
{
	public function getAllCarModels()
	{
		$carModels = $this->getData();	

		return $carModels;
	}

	public function getAllCarModelsByFuelType($fuelType = '')
	{

		$carModels = $this->getData();	

		$carModelsCollection = collect($carModels);

		$filteredCollection =  $carModelsCollection->filter(
			function ($carModel) use ($fuelType){
				return $carModel->getFuelType() === $fuelType;
		})->values();

		if(! $filteredCollection->count()) {
			return response(['message' => 'No Records Found'], 404);
		}

		return $filteredCollection;

	}


	protected function getData()
	{

		$jsonData = \File::get('../database/data/models_and_cars.json');

		$phpData = json_decode($jsonData);

		$carModels = [];


		foreach($phpData as $object) {
			$carModel = new CarModel();
			$carModel->setModelId($object->modelId);
			$carModel->setCo2Emissions($object->co2Emmissions);
			$carModel->setMpg($object->mpg);
			$carModel->setEnginePower($object->enginePower);
			$carModel->setEngineSize($object->engineSize);
			$carModel->setFuelType($object->fuelType);				

			$cars = [];

			foreach($object->cars as $objectCar) {
				$car = new Car();
				$car->setId($objectCar->id);
				$car->setModelId($objectCar->modelId);
				$car->setMileage($objectCar->mileage);
				$car->setRegistration($objectCar->registration);
				$car->setTransmission($objectCar->transmission);
				$car->setOwners($objectCar->owners);
				$car->setDescription($objectCar->description);
				$car->setPrice($objectCar->price);
				$car->setPhotos($objectCar->photos);

				$cars[] = $car;
			}

			$carModel->setCars($cars);

			$carModels[] =$carModel;
		}

		return $carModels;

	}
}