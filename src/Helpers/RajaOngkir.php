<?php

namespace Sholihin\RajaOngkirPro\Helpers;

use Sholihin\RajaOngkirPro\App\Provinsi;
use Sholihin\RajaOngkirPro\App\Kota;
use Sholihin\RajaOngkirPro\App\Kecamatan;
use Sholihin\RajaOngkirPro\App\Cost;
use Sholihin\RajaOngkirPro\App\Resi;

class RajaOngkir {
	public function Provinsi(){
		return new Provinsi;
	}

	public function Kota(){
		return new Kota;
	}

	public function Kecamatan(){
		return new Kecamatan;
	}

	public function Cost($attributes){
		return new Cost($attributes);
	}

	public function Resi($attributes){
		return new Resi($attributes);
	}
}