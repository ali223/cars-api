<?php

namespace App\Repositories;

use Closure;
use Illuminate\Support\Collection;

class CarModelFilters
{
	public function filterByFuelType(Collection $carModelsCollection, $fuelType)
	{
		
		return $carModelsCollection->filter(

			function ($carModel) use ($fuelType){

				return strtolower($carModel->getFuelType()) == strtolower($fuelType);

		})->values();

	} 

	public function filterByTransmission(Collection $carModelsCollection, $transmission)
	{
		$filterCarsFunction = function ($car) use ($transmission) {
					
			return strtolower($car->getTransmission()) == strtolower($transmission);
		};	

		return $this->filterCars($carModelsCollection, $filterCarsFunction);
	}

	public function filterByMaxPrice(Collection $carModelsCollection, $maxPrice)
	{
		$filterCarsFunction = function ($car) use ($maxPrice) {
					
			return $car->getPrice() <= $maxPrice;
		};	

		return $this->filterCars($carModelsCollection, $filterCarsFunction);
	}

	public function filterByMinPrice(Collection $carModelsCollection, $minPrice)
	{
		$filterCarsFunction = function ($car) use ($minPrice) {
					
			return $car->getPrice() >= $minPrice;
		};	

		return $this->filterCars($carModelsCollection, $filterCarsFunction);
	}

	public function filterByMaxMileage(Collection $carModelsCollection, $maxMileage)
	{
		$filterCarsFunction = function ($car) use ($maxMileage) {
					
			return $car->getMileage() <= $maxMileage;
		};	

		return $this->filterCars($carModelsCollection, $filterCarsFunction);
	}

	public function filterByMinMileage(Collection $carModelsCollection, $minMileage)
	{
		$filterCarsFunction = function ($car) use ($minMileage) {
					
			return $car->getMileage() >= $minMileage;
		};	

		return $this->filterCars($carModelsCollection, $filterCarsFunction);
	}


	public function filterByOwners(Collection $carModelsCollection, $owners)
	{
		$filterCarsFunction = function ($car) use ($owners) {
					
			return $car->getOwners() == $owners;
		};	

		return $this->filterCars($carModelsCollection, $filterCarsFunction);
	}


	private function filterCars(Collection $carModelsCollection, Closure $filterCarsFunction)
	{
		
		return $carModelsCollection->map(

			function ($carModel) use ($filterCarsFunction){

				$filteredCars = $carModel->getCars()->filter($filterCarsFunction);

				if (!$filteredCars->count()) {
					return;
				}

				$carModel->setCars($filteredCars);		
				
				return $carModel;

		})->filter()->values();

	}
	
}