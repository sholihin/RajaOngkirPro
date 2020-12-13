<?php

namespace Sholihin\RajaongkirPro\App;

class Kecamatan extends Api {
	protected $method = "subdistrict";

	public function byCity($city_id){
		$this->parameters = "?city=".$city_id;
		return $this->GetData();
	}
}