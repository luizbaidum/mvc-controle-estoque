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

		$routes['nao-preciso-dar-nome-mas-vou-chamar-de-infos'] = array(
			'route' => '/infos',
			'controller' => 'InfosController',
			'action' => 'index'
		);

		$this->setRoutes($routes);
	}
}