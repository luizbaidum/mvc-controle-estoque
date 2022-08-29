<?php 

namespace src;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	public function initRoutes()
	{
		$routes['nao-preciso-dar-nome-mas-vou-chamar-de-home'] = array(
			'route' => '/',
			'controller' => 'IndexController',
			'action' => 'index'
		);

		$routes['nao-preciso-dar-nome-mas-vou-chamar-de-sobre_nos'] = array(
			'route' => '/sobre_nos',
			'controller' => 'SobreNosController',
			'action' => 'index'
		);

		$routes['nao-preciso-dar-nome-mas-vou-chamar-de-novo'] = array(
			'route' => '/sobre_nos/novo',
			'controller' => 'SobreNosController',
			'action' => 'novo'
		);

		$routes['nao-preciso-dar-nome-mas-vou-chamar-de-infos'] = array(
			'route' => '/infos',
			'controller' => 'InfosController',
			'action' => 'index'
		);

		$this->setRoutes($routes);
	}
}