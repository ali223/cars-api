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
    	$filterNames = collect(['FuelType', 'Transmission', 'MaxPrice', 'MinPrice', 'Owners']);

    	$filterMap = [];

    	$filterNames->each( function ($filterName) use(&$filterMap) {

    		if(request()->has(strtolower($filterName))) {
    			$filterMap[$filterName] = request()->input(strtolower($filterName));
    			
    		}
    	});

    	return $filterMap;

    }
}
