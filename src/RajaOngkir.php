<?php

namespace Sholihin\RajaongkirPro;

use Sholihin\RajaongkirPro\App\Provinsi;
use Sholihin\RajaongkirPro\App\Kota;
use Sholihin\RajaongkirPro\App\Kecamatan;
use Sholihin\RajaongkirPro\App\Cost;
use Sholihin\RajaongkirPro\App\Resi;

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