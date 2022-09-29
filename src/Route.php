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

		$this->setRoutes($routes);
	}
}