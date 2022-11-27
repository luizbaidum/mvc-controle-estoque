<?php

namespace MF\Controller;

abstract class Action {

	protected $view;

	public function __construct()
	{
		$this->view = new \stdClass();
	}

	//conteudo da pagina, titulo da pagina, layout base
	protected function render($view, $title, $layout)
	{	
		//atributo da stdClass
		$this->view->pagina = $view;

		$this->title = $title;

		if(file_exists("../controle_estoque/src/Views/".$layout.".phtml"))
			require_once "../controle_estoque/src/Views/".$layout.".phtml";
		else
			$this->content(); //se não existir o arquivo layout, renderiza apenas o miolo da página
	}

	protected function renderPesquisa($view)
	{	
		//atributo da stdClass
		$this->view->pagina = $view;

		$this->content();
	}

	protected function renderModal($view, $titulo, $operacao)
	{
		//$this->view = obj / pagina = atributo
		$this->view->pagina = $view;

		$this->titulo = $titulo;

		$this->view->operacao = $operacao;

		$this->content();
	}

	protected function arrayDataToView($array_data)
	{	
		$this->array_data = $array_data;
	}

	//Dado que vem em matriz (array de arrays)
	protected function matrizDataToView($matriz_data)
	{	
		$this->matriz_data = $matriz_data;
	}
	
	protected function content()
	{	
		$classe_atual = get_class($this);
		$classe_atual = str_replace('src\Controllers\\', '', $classe_atual);
		$classe_atual = str_replace('Controller', '', $classe_atual);
		
		include "../controle_estoque/vendor/MF/ViewHelper/DataExtract.php";
		require_once "../controle_estoque/src/Views/".$classe_atual."/".$this->view->pagina.".phtml";
	}

	protected function limparCaracteres($string)
	{
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
	}
}