<?php 

namespace src;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	public function initRoutes()
	{
		$routes['index'] = array(
			'route' => '/',
			'controller' => 'IndexController',
			'action' => 'index'
		);

		$routes['todas_caixas'] = array(
			'route' => '/todas_caixas',
			'controller' => 'CaixaController',
			'action' => 'exibirCaixas'
		);

		$routes['nova_caixa'] = array(
			'route' => '/nova_caixa',
			'controller' => 'CaixaController',
			'action' => 'index'
		);

		$routes['nova_caixa/insert'] = array(
			'route' => '/nova_caixa/insert',
			'controller' => 'CaixaController',
			'action' => 'novaCaixa'
		);

		$routes['nova_peca'] = array(
			'route' => '/nova_peca',
			'controller' => 'PecaController',
			'action' => 'index'
		);

		$routes['nova_peca/insert'] = array(
			'route' => '/nova_peca/insert',
			'controller' => 'PecaController',
			'action' => 'novaPeca'
		);

		$routes['delete_peca'] = array(
			'route' => '/delete_peca',
			'controller' => 'PecaController',
			'action' => 'deletarPeca'
		);

		$routes['delete_caixa'] = array(
			'route' => '/delete_caixa',
			'controller' => 'CaixaController',
			'action' => 'deletarCaixa'
		);

		$routes['prepara_caixa'] = array(
			'route' => '/prepara_caixa',
			'controller' => 'CaixaController',
			'action' => 'preparaCaixa'
		);

		$this->setRoutes($routes);
	}
}