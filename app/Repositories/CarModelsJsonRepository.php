<?php

namespace App\Repositories;

use App\Car;
use App\CarModel;
use App\Repositories\DataSource;
use Illuminate\Support\Collection;

class CarModelsJsonRepository implements CarModelsRepositoryInterface
{

	protected $carModelsCollection;

	public function __construct(DataSourceInterface $dataSource)
	{
		$this->carModelsCollection = $dataSource->getData();	
	}

	public function getAllCarModels()
	{
		return $this->carModelsCollection;
	}

	public function getAllCarModelsByFuelType($fuelType = '')
	{

		$filteredCollection =  $this->carModelsCollection->filter(
			function ($carModel) use ($fuelType){
				return $carModel->getFuelType() === ucfirst($fuelType);
		})->values();

		if(! $filteredCollection->count()) {
			return response(['message' => 'No Records Found'], 404);
		}

		return $filteredCollection;

	}

	public function getAllCarModelsByTransmission($transmission = '')
	{

		$filteredCollection =  $this->carModelsCollection->map(
			function ($carModel, $key) use ($transmission){
				$filteredCars = $carModel->getCars()->filter(
					function ($car) use ($transmission){
						
						return $car->getTransmission() == ucfirst($transmission);
					});	

				if(!$filteredCars->count()) {
					return;
				}

				$carModel->setCars($filteredCars);		
				return $carModel;
		})->filter()->values();

		if(! $filteredCollection->count()) {
			return response(['message' => 'No Records Found'], 404);
		}

		return $filteredCollection;

	}


}