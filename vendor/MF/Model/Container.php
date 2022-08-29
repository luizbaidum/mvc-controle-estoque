<?php 

	namespace MF\Model;

	use src\Conexao;

	class Container {

		public static function getModel($model)
		{
			$class = "\\src\\Models\\".ucfirst($model); 

			$con = Conexao::getDb();

			//stdClass
			return new $class($con);
		} 

	}

?>