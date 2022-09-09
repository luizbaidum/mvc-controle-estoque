<?php

namespace src;

class Conexao {

	public static function getDb()
	{
		try {

			//PDO é nativo do PHP, então ele não reconhe o namespace/use. Por isso precisamos colocar a \ antes, para que fique como uma classe original do projeto e não do PHP em si.
			require '../../Conexao.php';

			return $con;
		} catch(\PDOException $e) {

			return 'Erro na conexão com o Banco de Dados';
		}
	}
}

