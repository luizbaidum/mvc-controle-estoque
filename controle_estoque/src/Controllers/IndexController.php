<?php

namespace src\Controllers;

use Exception;
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index()
	{	
		try {
			$peca = Container::getModel('PecasDAO');

			$atributos = $peca->select;
			$pecas = $peca->getPecas();
	
			$this->view->dados = $pecas;
			$this->view->atributos = explode(",", $atributos);
			$this->view->ordenar = explode(",", $atributos);
	
			//conteudo da pagina, titulo da pagina, layout base
			$this->render('index', 'Controle de Estoque de Peças', 'layout-base-index');

			if(!$pecas || !$atributos) throw new Exception('Erro ao carregar INDEX.');

		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	public function pesquisar()
	{	
		try {
			$peca = Container::getModel('PecasDAO');

			$coluna_pesquisa = explode("-", $_POST['base-pesquisa']);
			$item_pesquisa = $_POST['item-pesquisa'];

			$pecas = $peca->getPecasPesquisa($coluna_pesquisa[1], $item_pesquisa);
	
			$this->view->dados = $pecas;

			$this->renderPesquisa('index');
			
		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	public function ordenar()
	{	
		try {
			$peca = Container::getModel('PecasDAO');
			
			$ordem = $peca->selectWithOrdenation($_POST);

			$this->view->dados = $ordem;

			$this->renderPesquisa('index');

		} catch (Exception $e) {
			$e->getMessage();
		}
	}
}