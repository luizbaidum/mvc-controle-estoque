<?php

namespace src\Controllers;

use MF\Controller\Action;
use MF\Model\Container;
use src\Models\InfosDAO;

class InfosController extends Action {

	public function index()
	{	
		$info = Container::getModel('InfosDAO');

		$infos = $info->getInfos();

		$this->view->dados = $infos;

		$this->render('index', 'layout1');
	}
}