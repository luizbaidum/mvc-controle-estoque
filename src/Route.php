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
			'action' => 'todasCaixas'
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

		$routes['preparar_caixa'] = array(
			'route' => '/preparar_caixa',
			'controller' => 'CaixaController',
			'action' => 'prepararCaixa'
		);

		$routes['editar_caixa'] = array(
			'route' => '/editar_caixa',
			'controller' => 'CaixaController',
			'action' => 'editarCaixa'
		);

		$routes['prepara_edit_peca'] = array(
			'route' => '/prepara_edit_peca',
			'controller' => 'PecaController',
			'action' => 'prepararEditarPeca'
		);

		$routes['editar_peca'] = array(
			'route' => '/editar_peca',
			'controller' => 'PecaController',
			'action' => 'editarPeca'
		);

		$routes['pesquisar'] = array(
			'route' => '/pesquisar',
			'controller' => 'IndexController',
			'action' => 'pesquisar'
		);

		$routes['ordenar'] = array(
			'route' => '/ordenar',
			'controller' => 'IndexController',
			'action' => 'ordenar'
		);

		$routes['preparar_baixa'] = array(
			'route' => '/preparar_baixa',
			'controller' => 'PecaController',
			'action' => 'prepararBaixa'
		);

		$routes['baixar_peca'] = array(
			'route' => '/baixar_peca',
			'controller' => 'PecaController',
			'action' => 'baixarPeca'
		);

		$routes['carregar_foto_peca'] = array(
			'route' => '/carregar_foto_peca',
			'controller' => 'PecaController',
			'action' => 'carregarFotoPeca'
		);

		$this->setRoutes($routes);
	}
}