<?php

namespace App\Repositories;

use App\Car;
use App\CarModel;
use App\Repositories\DataSource;
use Illuminate\Support\Collection;

class CarModelsJsonRepository implements CarModelsRepositoryInterface
{

	protected $carModelsCollection;
	protected $carModelFilters;

	public function __construct(DataSourceInterface $dataSource, 
								CarModelFilters $carModelFilters)
	{
		$this->carModelsCollection = $dataSource->getData();	
		$this->carModelFilters = $carModelFilters;
	}

	public function getAllCarModels()
	{
		return $this->carModelsCollection;
	}

	public function getAllCarModelsByFuelType($fuelType = '')
	{

		$filteredCollection = $this->carModelFilters->filterByFuelType($this->carModelsCollection, $fuelType);

		if(! $filteredCollection->count()) {
			return response(['message' => 'No Records Found'], 404);
		}

		return $filteredCollection;

	}

	public function getAllCarModelsByTransmission($transmission = '')
	{

		$filteredCollection =  $this->carModelFilters->filterByTransmission($this->carModelsCollection, $transmission);

		if(! $filteredCollection->count()) {
			return response(['message' => 'No Records Found'], 404);
		}

		return $filteredCollection;

	}


}