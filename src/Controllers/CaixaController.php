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

			$obj = new CaixasEntity();

			$obj->setIdCaixa($_POST['idCaixa']);
			$obj->setNomeCaixa($_POST['nomeCaixa']);
			$obj->setCorCaixa($_POST['corCaixa']);
			$obj->setDescricaoCaixa($_POST['descricaoCaixa']);

			if($caixa->insert($obj) == true) {

				echo 'sucesso';
				//criar um arquivo de Alertas e chama-lo aqui
				//fazer com que ele apareça na página sem precisar mudar de página e tbm limpar os caracteres digitados
			} else {

				throw new Exception('Erro ao lançar nova Caixa. Volte a página anterior e verifique se o ID da Caixa já está cadastrado.');
			}

		} catch (Exception $e) {

			echo $e->getMessage();
		}
	}
}