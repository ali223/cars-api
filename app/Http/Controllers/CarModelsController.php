<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CarModelsJsonRepository;

class CarModelsController extends Controller
{

	protected $carModelsRepository;

	public function __construct(
		CarModelsJsonRepository $carModelsRepository)
	{
		$this->carModelsRepository = $carModelsRepository;
	}

    public function index()
    {
   		if($fuelType = request()->get('fuelType')) {
			return $this->carModelsRepository->getAllCarModelsByFuelType($fuelType);
		}
	
		return $carModelsRepository->getAllCarModels();

    }
}
