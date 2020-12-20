<?php

namespace Sholihin\RajaOngkirPro\Helpers;

use Sholihin\RajaOngkirPro\App\Api;

class RajaOngkir extends Api{
	public function getProvinces(){
		$this->method = 'province';
		return $this->all();
	}

	public function getProvinceByName($keyword){
		$this->method = 'province';
        return $this->search('province', $keyword);
	}

	public function getCities(){
		$this->method = 'city';
		return $this->all();
	}

	public function getCityByProvice($provinceId){
		$this->method = 'city';
		$this->parameters = "?province=".$provinceId;
		return $this->all();
	}

	public function getDistrictByCity($cityId)
	{
		$this->method = 'subdistrict';
		$this->parameters = "?city=".$cityId;
		return $this->all();
	}

	public function getSupportWayBills(){
		return $this->supportedWayBills;
	}

	public function getSupportCouriers(){
		return $this->supportedCouriers;
	}

	public function getCourierLists(){
		return $this->couriersList;
	}

	public function getCost($attributes){
		$this->method = "cost";

		$this->overWriteOptions = [
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => http_build_query($attributes),
			CURLOPT_HTTPHEADER => [
				"content-type: application/x-www-form-urlencoded",
				"key: ".$this->apiKey
				]
		];
		
		return $this->getData();
	}

	public function getWayBill($attributes){
		$this->method = "waybill";

		$this->overWriteOptions = [
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => http_build_query($attributes),
			CURLOPT_HTTPHEADER => [
				"content-type: application/x-www-form-urlencoded",
				"key: ".$this->apiKey
				]
		];

		return $this->getData();
	}
}