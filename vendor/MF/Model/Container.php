<?php 

	namespace MF\Model;

use Exception;
use src\Conexao;

	class Container {

		public static function getModel($model)
		{
			try {
				$class = "\\src\\Models\\".ucfirst($model); 

				$con = Conexao::getDb();
	
				if($con == false) {
	
					throw new Exception('Erro ao conectar-se com o Banco de Dados. Entre em contato com o Dev do sistema');
				} else {
	
					return new $class($con);
				}
			} catch (Exception $e) {

				echo '<br><br>';
				echo '<div style="color: red">'.$e->getMessage().'</div>';
				echo '<br><br>';
			}			
		} 
	}
?>