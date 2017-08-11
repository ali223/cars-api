<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CarModelsRepositoryInterface;


class CarModelsApiController extends Controller
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
		} elseif($transmission = request()->get('transmission')) {
			return $this->carModelsRepository->getAllCarModelsByTransmission($transmission);
		}
	
		return $this->carModelsRepository->getAllCarModels();

    }
}
