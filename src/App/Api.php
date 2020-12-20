<?php

namespace Sholihin\RajaOngkirPro\App;

use Exception;

abstract class Api {
	protected $method;
	protected $parameters;
	protected $endPointAPI;
	protected $overWriteOptions = [];
	protected $apiKey;
	protected $data;
	protected $supportedCouriers = [
		'starter' => [
			'jne',
			'pos',
			'tiki',
		],
		'basic'   => [
			'jne',
			'pos',
			'tiki',
			'pcp',
			'esl',
			'rpx',
		],
		'pro'     => [
			'jne',
			'pos',
			'tiki',
			'rpx',
			'pandu',
			'wahana',
			'sicepat',
			'jnt',
			'pahala',
			'sap',
			'jet',
			'indah',
			'dse',
			'slis',
			'first',
			'ncs',
			'star',
			'ninja',
			'lion',
			'idl',
			'rex',
			'ide',
			'sentral'
		],
	];
	protected $supportedWayBills = [
		'starter' => [],
		'basic'   => [
			'jne',
		],
		'pro'     => [
			'jne',
			'pos',
			'tiki',
			'pcp',
			'rpx',
			'wahana',
			'sicepat',
			'j&t',
			'sap',
			'jet',
			'dse',
			'first',
		],
	];
	protected $couriersList = [
		'jne'       => 'Jalur Nugraha Ekakurir (JNE)',
		'pos'       => 'POS Indonesia (POS)',
		'tiki'      => 'Citra Van Titipan Kilat (TIKI)',
		'pcp'       => 'Priority Cargo and Package (PCP)',
		'esl'       => 'Eka Sari Lorena (ESL)',
		'rpx'       => 'RPX Holding (RPX)',
		'pandu'     => 'Pandu Logistics (PANDU)',
		'wahana'    => 'Wahana Prestasi Logistik (WAHANA)',
		'sicepat'   => 'SiCepat Express (SICEPAT)',
		'j&t'       => 'J&T Express (J&T)',
		'pahala'    => 'Pahala Kencana Express (PAHALA)',
		'cahaya'    => 'Cahaya Logistik (CAHAYA)',
		'sap'       => 'SAP Express (SAP)',
		'jet'       => 'JET Express (JET)',
		'indah'     => 'Indah Logistic (INDAH)',
		'slis'      => 'Solusi Express (SLIS)',
		'expedito*' => 'Expedito*',
		'dse'       => '21 Express (DSE)',
		'first'     => 'First Logistics (FIRST)',
		'ncs'       => 'Nusantara Card Semesta (NCS)',
		'star'      => 'Star Cargo (STAR)',
	];


	public function __construct(){
		$this->endPointAPI = 'https://pro.rajaongkir.com/api';
		$this->apiKey = '69e56d1a26b3184f0057188aa30cf7ad';
	}

	public function all(){
		return $this->getData();
	}

	public function find($id){
		$this->parameters = "?id=".$id;
		return $this->getData();
	}

	public function search($column, $searchKey){
		$data = ( empty($this->data) ) ? $this->getData() : $this->data;

		$rowColumn = array_column($data, $column);
		$s = preg_quote(ucwords($searchKey), '~');
		$res = preg_grep('~' . $s . '~', $rowColumn);
		$resKey = array_keys($res);
		$temp = [];
		foreach($data as $key => $val){
			if(in_array($key, $resKey)){
				array_push($temp, $val);
			}
		}

		return $temp;
	}

	public function count(){
		empty($this->data) ? $this->getData() : $this->data;
		return count($this->data);
	}

	protected function getData(){
		$curl = curl_init();
		$options = [
			CURLOPT_URL => $this->endPointAPI."/".$this->method.$this->parameters,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => [
				"key: ".$this->apiKey
			],
		];

		foreach( $this->overWriteOptions as $key => $val){
			$options[$key] = $val;
		}

		curl_setopt_array($curl, $options);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		 	throw new Exception($err, 1);	
		} else {
			$data = json_decode($response, true);
			$code = $data['rajaongkir']['status']['code'];
			if($code == 400){
				return json_encode($data['rajaongkir']['status']['description']);		
			}else{
				if($this->method == 'waybill'){
					$this->data = $data['rajaongkir']['result'];
				}else{
					$this->data = $data['rajaongkir']['results'];
				}
				return $this->data;
			}
		}
	}

}
