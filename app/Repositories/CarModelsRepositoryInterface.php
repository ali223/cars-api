<?php

namespace App\Repositories;

interface CarModelsRepositoryInterface
{
	public function getAllCarModels();

	public function getAllCarModelsByFuelType();
}

