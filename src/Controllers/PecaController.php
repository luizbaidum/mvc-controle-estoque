<?php

namespace src\Controllers;

use Exception;
use MF\Controller\Action;
use MF\Model\Container;
use src\Models\PecasEntity;

class PecaController extends Action {

	public function index()
	{	
		//prepara os dados
		$caixa = Container::getModel('CaixasDAO');
		$lista_caixas = $caixa->selectCaixas();

		$teste = [
			'nome' => 'luli',
			'idade' => 16
		];
		
		$this->teste($teste);

		//conteudo da pagina, titulo da pagina, layout base
		$this->render('nova_peca', 'Cadastrar nova peça', 'layout-base-cruds');
	}

    public function novaPeca()
	{	
		try {
			$peca = Container::getModel('PecasDAO');
			$processo_finalizado = 'processo_iniciado';

			$obj = new PecasEntity();

			//está reconhecendo o $_post normalmente, mesmo ele vindo do ajax todo 'zoado'
			$obj->setIdPeca($_POST['idPeca']);
			$obj->setNomePeca($_POST['nomePeca']);
			$obj->setVlrCompraPeca($_POST['vlrCompraPeca']);
			$obj->setCaixaPeca($_POST['caixaPeca']);

			if($peca->insert($obj) == true) {

				$processo_finalizado = true;
				echo $processo_finalizado;
			} else {

				throw new Exception('Erro ao lançar nova Peça. Verifique se o ID da Peça já está cadastrado.');
			}

		} catch (Exception $e) {

			$processo_finalizado = false;
			echo $processo_finalizado;
			echo $e->getMessage();
		}
	}
}