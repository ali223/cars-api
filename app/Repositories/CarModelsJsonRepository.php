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

	public function getAllCarModelsByFilters($filters = []) 
	{
		$filteredCollection = $this->carModelsCollection;

		foreach($filters as $filterType => $filterData) {

			$filterName = "filterBy{$filterType}";

			$filteredCollection = $this->carModelFilters->$filterName($filteredCollection, $filterData);
		}

		return $filteredCollection;
	}


}