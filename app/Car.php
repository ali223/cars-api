<?php

namespace App;

use JsonSerializable;

class Car implements JsonSerializable
{
	private $id;
	private $modelId;
	private $mileage;
	private $registration;
	private $transmission;
	private $owners;
	private $description;
	private $price;
	private $photos = [];

	public function getId() 
	{
		return $this->id;
	}

	public function setId($id) 
	{
		return $this->id = $id;
	}

	public function getModelId() 
	{
		return $this->modelId;
	}

	public function setModelId($modelId) 
	{
		return $this->modelId = $modelId;
	}

	public function getMileage() 
	{
		return $this->mileage;
	}

	public function setMileage($mileage) 
	{
		return $this->mileage = $mileage;
	}

	public function getRegistration() 
	{
		return $this->registration;
	}

	public function setRegistration($registration) 
	{
		return $this->registration = $registration;
	}

	public function getTransmission()
	{
		return $this->transmission;
	}

	public function setTransmission($transmission) 
	{
		return $this->transmission = $transmission;
	}

	public function getOwners()
	{
		return $this->owners;
	}

	public function setOwners($owners) 
	{
		return $this->owners = $owners;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function setPrice($price)
	{
		$this->price = $price;
	}

	public function getPhotos()
	{
		return $this->photos;
	}

	public function setPhotos(Array $photos)
	{
		$this->photos = $photos;
	}

	public function jsonSerialize()
	{
		return [
			'id' => $this->getId(),
			'modelId' => $this->getModelId(),
			'mileage' => $this->getMileage(),
			'registration' => $this->getRegistration(),
			'transmission' => $this->getTransmission(),
			'owners' => $this->getOwners(),
			'description' => $this->getDescription(),
			'price' => $this->getPrice(),
			'photos' => $this->getPhotos()
		];
	}


	
}