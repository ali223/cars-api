<?php

namespace App\Repositories;

use App\Car;
use App\CarModel;
use App\Repositories\JsonDataSource;
use Illuminate\Support\Collection;

class CarModelsJsonRepository implements CarModelsRepositoryInterface
{

	protected $dataSource;

	public function __construct(JsonDataSource $dataSource)
	{
		$this->dataSource = $dataSource;
	}

	public function getAllCarModels()
	{
		$carModels = $this->dataSource->getData();	

		return $carModels;
	}

	public function getAllCarModelsByFuelType($fuelType = '')
	{

		$carModels = $this->dataSource->getData();	

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



}