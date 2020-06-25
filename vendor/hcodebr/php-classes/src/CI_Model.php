<?php
namespace Hcode;

class CI_Model{

	private $values = [];

	public function __call($nome,$args)
	{
		$method = substr($nome,0,3);
		$atributo = substr($nome, 3 ,strlen($nome));

		switch($method)
		{

			case 'get':
				return $this->values[$atributo];
			break;
			case 'set':
				$this->values[$atributo] = $args ;
			break;

		}


	}

	public function setData($data)
	{
		foreach ($data as $key => $value) {
				$this->{"set".$key}($value);
			}	
		
	}

	public function getValues()
	{
		return $this->values ;
	}

}
