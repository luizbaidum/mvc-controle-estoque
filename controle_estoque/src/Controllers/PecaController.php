<?php

namespace src\Controllers;

use Exception;
use MF\Controller\Action;
use MF\Model\Container;
use MF\ViewHelper\NumbersHelper;
use src\Models\PecasEntity;
use src\Models\UsoPecaEntity;

class PecaController extends Action {

	public function index()
	{	
		$model_peca = Container::getModel('PecasDAO');
		$model_caixa = Container::getModel('CaixasDAO');

		$this->view->dados['lista_pecas'] = $model_peca->getPecas();
		$this->view->dados['lista_caixas'] = $model_caixa->selectCaixas();

		//conteudo da pagina, titulo da pagina, layout base
		$this->render('nova_peca', 'Cadastrar nova peça', 'layout-base-inserts');
	}

    public function novaPeca()
	{	
		try {
			$model_peca = Container::getModel('PecasDAO');

			$obj = new PecasEntity();

			//está reconhecendo o $_post normalmente, mesmo ele vindo do ajax todo 'zoado'
			$obj->setIdPeca(preg_replace('/[^a-z0-9]/i', '', $_POST['idPeca']));
			$obj->setNomePeca($_POST['nomePeca']);
			$_POST['vlrCompraPeca'] != '' ? $obj->setVlrCompraPeca(NumbersHelper::formatBRtoUS($_POST['vlrCompraPeca'])) : $obj->setVlrCompraPeca('');
			$obj->setQtdPeca($_POST['qtdPeca']);
			$obj->setCaixaPeca($_POST['caixaPeca']);

			if ($_FILES['fotoPeca']['name'] != '') {
				$foto_peca = $this->limparCaracteres($_FILES['fotoPeca']['name']);
				$foto_peca = substr_replace($foto_peca, '.', -3, 0);
			}
			
			if (isset($foto_peca)) {
				$obj->setFotoPeca($foto_peca);
				$resultado_upload = $model_peca->upload_img($obj);
			}
				
			if ((isset($foto_peca) && $resultado_upload === true) || !isset($foto_peca))
				$resultado_operacao = $model_peca->insert($obj);

			if ($resultado_operacao != 1) {

				$resposta = array('resultado_operacao' => false, 'id_operacao' => $obj->getIdPeca());
				throw new Exception('Erro ao lançar nova Peça. Verifique se o ID da Peça já está cadastrado.');
			} else {
				
				$resposta = array('resultado_operacao' => true, 'id_operacao' => $obj->getIdPeca());
				echo json_encode($resposta);
			}

		} catch (Exception $e) {
			$e->getMessage();
			echo json_encode($resposta);
		}
	}

	public function deletarPeca()
	{
		try {
			$pecas_excluir = $_POST['idPeca'];
	
			$model_peca = Container::getModel('PecasDAO');

			$resultado_operacao = $model_peca->deletar($pecas_excluir);

			if($resultado_operacao == count($pecas_excluir)) {

				$resposta = array('resultado_operacao' => true, 'ids_operacao' => $pecas_excluir);
				echo json_encode($resposta);
			} else {
				
				$resposta = array('resultado_operacao' => false, 'ids_operacao' => $pecas_excluir);
				throw new Exception('Erro ao deletar peça(s).');
			}
		} catch (Exception $e) {
			$e->getMessage();
			echo json_encode($resposta);
		}
	}

	public function prepararEditarPeca()
	{
		try {	
			$model_peca = Container::getModel('PecasDAO');
			$model_caixa = Container::getModel('CaixasDAO');
			$model_uso = Container::getModel('UsoPecaDAO');

			$id_peca = $_POST['idPeca'][0];
			$peca_editar = $model_peca->selectPeca($id_peca);
			$lista_caixas = $model_caixa->selectCaixas();

			$this->view->opcoes['disabled'] = false;
			if($model_uso->vericarPecaEmUso($id_peca)) $this->view->opcoes['disabled'] = true;

			$this->view->dados['peca_editar'] = $peca_editar;
			$this->view->dados['lista_caixas'] = $lista_caixas;
			
			$this->render('editar_peca', 'Editar peça ID: '.$id_peca, 'layout-base-inserts');

			if(!$peca_editar || !$lista_caixas) throw new Exception('Erro ao carregar peça para edição.');

		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	public function editarPeca()
	{	
		try {
			$model_peca = Container::getModel('PecasDAO');

			$obj = new PecasEntity();

			$obj->setIdPeca($_POST['idPeca']);
			$obj->setNomePeca($_POST['nomePeca']);
			$_POST['vlrCompraPeca'] != '' ? $obj->setVlrCompraPeca(NumbersHelper::formatBRtoUS($_POST['vlrCompraPeca'])) : $obj->setVlrCompraPeca('');
			$obj->setQtdPeca($_POST['qtdPeca']);
			$obj->setCaixaPeca($_POST['caixaPeca']);

			if ($_FILES['fotoPeca']['name'] != '') {
				$foto_peca = $this->limparCaracteres($_FILES['fotoPeca']['name']);
				$foto_peca = substr_replace($foto_peca, '.', -3, 0);
				$obj->setFotoPeca($foto_peca);
			}
			$obj->setOldId($_POST['oldId']);

			$resultado_upload = NULL;

			if (isset($foto_peca))
				$resultado_upload = $model_peca->upload_img($obj);
			
			if ((isset($foto_peca) && $resultado_upload === true) || !isset($foto_peca))	
				$resultado_operacao = $model_peca->editar($obj);

			if ($resultado_operacao != 1) {
				
				$resposta = array('resultado_operacao' => false, 'id_operacao' => $obj->getIdPeca());
				throw new Exception('Erro ao editar Peça.');
			} else {

				$resposta = array('resultado_operacao' => true, 'id_operacao' => $obj->getIdPeca());
				echo json_encode($resposta);
			}
		} catch (Exception $e) {
			$e->getMessage();
			echo json_encode($resposta);
		}
	}

	public function prepararBaixa()
	{	
		try {
			$model_peca = Container::getModel('PecasDAO');

			foreach($_GET['idPeca'] as $id) {
				$pecas[] = $model_peca->selectPeca($id);
			}

			if (count($pecas) > 0) {
				$this->view->dados['pecas'] = $pecas;
				$this->render('baixar_peca', 'Baixar peça(s)', 'layout-base-inserts');
			} else {
				throw new Exception('Erro ao selecionar peça(s) para baixa.');
			}
		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	public function baixarPeca()
	{	
		try {
			$model_uso = Container::getModel('UsoPecaDAO');
			$model_peca = Container::getModel('PecasDAO');

			foreach ($_POST['idPeca'] as $k => $peca_baixar) {

				$obj = new UsoPecaEntity();

				$obj->setIdPeca($peca_baixar);
				$obj->setQtdUso($_POST['qtdUso'][$k]);
				$obj->setMotivoUso($_POST['motivoUso'][$k]);
				$obj->setDataUso($_POST['dataUso'][$k]);

				$baixa = $model_uso->insertUso($obj);

				$abatimento = $model_peca->baixarQtdPeca($obj);
				
				if($baixa != '1' || $abatimento == false) {
					$resultado_operacao = false;
				} else {
					$resultado_operacao = true;
				}
					
				$ids_sucesso[] = $obj->getIdPeca();
			};

			if ($resultado_operacao == true) {
				$resposta = array('resultado_operacao' => true, 'id_operacao' => $ids_sucesso);
				echo json_encode($resposta);
			} else {
				$resposta = array('resultado_operacao' => false, 'id_operacao' => $ids_sucesso);
				throw new Exception('Erro no precesso de baixar Peça(s).');
			}
		} catch (Exception $e) {
			$e->getMessage();
			echo json_encode($resposta);
		}
	}

	public function carregarFotoPeca()
	{
		try {
			$model_peca = Container::getModel('PecasDAO');

			$abrir_foto = $model_peca->load_img($_POST['peca'], $_POST['foto']);

			if($abrir_foto == '' || $abrir_foto == NULL) {
				throw new Exception('Erro no precesso de carregar imagem.');
			} else {
				$this->renderModal('foto_peca', $_POST["peca"], $abrir_foto);
			}
		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	public function deletarImagem()
	{
		try {
			$model_peca = Container::getModel('PecasDAO');

			$resultado_operacao = $model_peca->delete_img_bd($_POST['id_img']);

			if($resultado_operacao) {
				$resposta = array('resultado_operacao' => true, 'id_operacao' => '');
				echo json_encode($resposta);
			} else {
				$resposta = array('resultado_operacao' => false, 'id_operacao' => '');
				throw new Exception('Erro no precesso de deletar imagem.');
			}
		} catch (Exception $e) {
			$e->getMessage();
			echo json_encode($resposta);
		}
	}
}