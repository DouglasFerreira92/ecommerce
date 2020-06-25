<?php
namespace Hcode;
use Rain\Tpl;

class Page {

	private $tpl; //VARIAVEL PARA INSTANCIAR TPL
	private $option = []; //O ARRAY COM O MERGE
	private $defaults = [
		"data" => []
	]; //OPÇÕES PADRÃO

	public function __construct($opt = array())
	{
		//FAZ UM MERGE NOS ARRAYS
		$this->option =  array_merge($this->defaults , $opt);
		//CONFIGURAÇÃO DO TEMPLATE
		$config = array(
			'tpl_dir' => $_SERVER['DOCUMENT_ROOT'] . "/ecommerce/views/", //VISÃO
			'cache_dir' => $_SERVER['DOCUMENT_ROOT'] . "/ecommerce/views-cache/",//CACHE DA VISÃO
			'debug' => false
		);	

		//FUNÇÃO ESTATICA DO RAINTPL PARA CONFIGURAR
		Tpl::configure($config);
		//CRIA INSTANCIA
		$this->tpl = new Tpl();
		//COLOCA VARIAVEIS NO TEMPLATE
		$this->setData($this->option['data']);
		//CHAMA CABEÇALHO
		$this->tpl->draw("header");
	}
	//CHAMA O CORPO DA PÁGINA
	public function template($nome = '',$opt=array() ,$returnHTML=false)
	{
		$this->setData($opt);
		return $this->tpl->draw($nome);
	} 
	//COLOCA VARIAVEIS NO TEMPLATE
	public function setData($data)
	{
		foreach ($data as $key => $value) {
			
				$this->tpl->assign($key,$value);

		}
	} 
	//CHAMA RODAPE
	public function __destruct()
	{
		$this->tpl->draw("footer");
	}

}