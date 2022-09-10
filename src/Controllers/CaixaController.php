<?php

namespace src\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class CaixaController extends Action {

	public function novaCaixa()
	{	
		$peca = Container::getModel('PecasDAO');

		//conteudo da pagina, titulo da pagina, layout base
		$this->render('nova_caixa', 'Cadastrar nova caixa', 'layout-base-cruds');
	}

    public function insert()
	{	
		$peca = Container::getModel('PecasDAO');

		//conteudo da pagina, titulo da pagina, layout base
		$this->render('nova_caixa', 'Cadastrar nova caixa', 'layout-base-cruds');
	}
}