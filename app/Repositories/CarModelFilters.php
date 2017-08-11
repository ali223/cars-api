<?php

namespace App\Repositories;

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
		return $carModelsCollection->map(
			function ($carModel, $key) use ($transmission){
				$filteredCars = $carModel->getCars()->filter(
					function ($car) use ($transmission){
						
						return strtolower($car->getTransmission()) == strtolower($transmission);
					});	

				if(!$filteredCars->count()) {
					return;
				}

				$carModel->setCars($filteredCars);		
				return $carModel;
		})->filter()->values();

	}
	
}