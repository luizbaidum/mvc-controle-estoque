<?php

namespace src\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index()
	{	
		$peca = Container::getModel('PecasDAO');

		$atributos = $peca->select;
		$pecas = $peca->getPecas();

		$this->view->dados = $pecas;
		$this->view->atributos = explode(",", $atributos);
		$this->view->ordenar = explode(",", $atributos);

		//conteudo da pagina, titulo da pagina, layout base
		$this->render('index', 'Controle de Estoque de Peças', 'layout-base');
	}
}