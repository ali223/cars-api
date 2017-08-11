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
		$filters = $this->createFilters();

		$carModelsCollection = $this->carModelsRepository
					->getAllCarModelsByFilters($filters);

		if(! $carModelsCollection->count()) {
			return response(['message' => 'No Records Found'], 404); 
		}

		return $carModelsCollection;

    }

    private function createFilters()
    {
    	$filters = [];

		if($fuelType = request()->get('fueltype')) {
			$filters['FuelType'] = $fuelType;
		}

		if($transmission = request()->get('transmission')) {
			$filters['Transmission'] = $transmission;	
		}

		if($maxPrice = request()->get('maxprice')) {
			$filters['MaxPrice'] = $maxPrice;	
		}

		if($minPrice = request()->get('minprice')) {
			$filters['MinPrice'] = $minPrice;	
		}

		return $filters;

    }
}
