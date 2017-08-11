<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CarModelsRepositoryInterface;


class CarModelsController extends Controller
{

	protected $carModelsRepository;

	public function __construct(
		CarModelsRepositoryInterface $carModelsRepository)
	{
		$this->carModelsRepository = $carModelsRepository;
	}

    public function index()
    {
   		if($fuelType = request()->get('fuelType')) {
			return $this->carModelsRepository->getAllCarModelsByFuelType($fuelType);
		}
	
		return $this->carModelsRepository->getAllCarModels();

    }
}
