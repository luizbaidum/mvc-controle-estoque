<?php

namespace src\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class CaixaController extends Action {

	public function index()
	{	
		//conteudo da pagina, titulo da pagina, layout base
		$this->render('nova_caixa', 'Cadastrar nova caixa', 'layout-base-cruds');
	}

    public function novaCaixa()
	{	
		$caixa = Container::getModel('CaixasDAO');

		$caixa->insert($_POST);
	}
}