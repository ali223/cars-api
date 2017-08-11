<?php

namespace App;

use JsonSerializable;

class CarModel implements JsonSerializable
{
	private $modelId;
	private $co2Emmissions;
	private $mpg;
	private $enginePower;
	private $engineSize;
	private $fuelType;
	private $cars = [];

	public function getModelId() 
	{
		return $this->modelId;
	}

	public function setModelId($modelId) 
	{
		return $this->modelId = $modelId;
	}

	public function getCo2Emissions() 
	{
		return $this->co2Emmissions;
	}

	public function setCo2Emissions($co2Emmissions) 
	{
		return $this->co2Emmissions = $co2Emmissions;
	}

	public function getMpg() 
	{
		return $this->mpg;
	}

	public function setMpg($mpg) 
	{
		return $this->mpg = $mpg;
	}

	public function getEnginePower()
	{
		return $this->enginePower;
	}

	public function setEnginePower($enginePower) 
	{
		return $this->enginePower = $enginePower;
	}

	public function getEngineSize()
	{
		return $this->engineSize;
	}

	public function setEngineSize($engineSize) 
	{
		return $this->engineSize = $engineSize;
	}

	public function getFuelType()
	{
		return $this->fuelType;
	}

	public function setFuelType($fuelType)
	{
		$this->fuelType = $fuelType;
	}

	public function getCars()
	{
		return $this->cars;
	}

	public function setCars(Array $cars)
	{
		$this->cars = $cars;
	}

	public function jsonSerialize()
	{
		return [
			'modelId' => $this->getModelId(),
			'co2Emmissions' => $this->getCo2Emissions(),
			'mpg' => $this->getMpg(),
			'enginePower' => $this->getEnginePower(),
			'engineSize' => $this->getEngineSize(),
			'fuelType' => $this->getFuelType(),
			'cars' => $this->getCars()

		];
	}

}