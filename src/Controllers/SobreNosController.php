<?php

namespace src\Controllers;

use MF\Controller\Action;
use MF\Model\Container;
use src\Models\SobreNosDAO;

class SobreNosController extends Action {

	public function index()
	{	
		$sb = Container::getModel('SobreNosDAO');

		$sbs = $sb->getSobreNos();

		$this->view->dados = $sbs;

		$this->render('index', 'layout1');
	}

	public function novo()
	{
		$sb = Container::getModel('SobreNosDAO');

		$sbs = $sb->getSobreNosNovo();

		$this->view->dados = $sbs;

		$this->render('sobrenos_novo', 'layout1');
	}
}