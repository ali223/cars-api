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
		$filters = [];

		if($fuelType = request()->get('fuelType')) {
			$filters['FuelType'] = $fuelType;
		}

		if($transmission = request()->get('transmission')) {
			$filters['Transmission'] = $transmission;	
		}

		$carModelsCollection = $this->carModelsRepository
					->getAllCarModelsByFilters($filters);

		if(! $carModelsCollection->count()) {
			return response(['message' => 'No Records Found'], 404); 
		}

		return $carModelsCollection;

    }
}
