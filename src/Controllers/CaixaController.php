<?php

namespace src\Controllers;

use Exception;
use MF\Controller\Action;
use MF\Model\Container;
use src\Models\CaixasEntity;

class CaixaController extends Action {

	public function index()
	{	
		//conteudo da pagina, titulo da pagina, layout base
		$this->render('nova_caixa', 'Cadastrar nova caixa', 'layout-base-cruds');
	}

    public function novaCaixa()
	{	
		try {
			$caixa = Container::getModel('CaixasDAO');
			$processo_finalizado = 'processo_iniciado';

			$obj = new CaixasEntity();

			//está reconhecendo o $_post normalmente, mesmo ele vindo do ajax todo 'zoado'
			$obj->setIdCaixa($_POST['idCaixa']);
			$obj->setNomeCaixa($_POST['nomeCaixa']);
			$obj->setCorCaixa($_POST['corCaixa']);
			$obj->setDescricaoCaixa($_POST['descricaoCaixa']);

			if($caixa->insert($obj) == true) {

				$processo_finalizado = true;
				echo $processo_finalizado;
			} else {

				throw new Exception('Erro ao lançar nova Caixa. Verifique se o ID da Caixa já está cadastrado.');
			}

		} catch (Exception $e) {

			$processo_finalizado = false;
			echo $processo_finalizado;
			echo $e->getMessage();
		}
	}
}