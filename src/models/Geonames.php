<?php

namespace Travis;

use Travis\CSV;
use Travis\Zipcode;

class Geonames
{
	public $map = [
		0 => 'country',
		1 => 'zip',
		2 => 'city',
		3 => 'state_long',
		4 => 'state_short',
	];

	public $array = [];

	public static function load($country = 'US')
	{
		$object = __CLASS__;

		return new $object($country);
	}

	public function __construct($country = 'US')
	{
		// set path
		$path = __DIR__.'/../storage/'.strtoupper($country).'.txt';

		// load file
		$csv = CSV::fromFile($path, false, "\t");

		// convert to array
		foreach ($csv->getRows() as $row)
		{
			// build new record
			$r = [];
			foreach ($this->map as $key => $value)
			{
				$r[(string) $value] = $row[$key];
			}

			// add to array
			$this->array[$r['zip']] = $r;
		}
	}

	public function find($str)
	{
		// clean the zipcode
		$zipcode = Zipcode::make($str);

		// fetch from array
		return ex($this->array, $zipcode->five);
	}

	public function get($str)
	{
		return $this->find($str);
	}
}