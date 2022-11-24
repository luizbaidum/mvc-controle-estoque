<?php

namespace src;

class Conexao {

	public static function getDb()
	{
		try {
			//PDO é nativo do PHP, então ele não reconhe o namespace/use. Por isso precisamos colocar a \ antes, para que fique como uma classe original do projeto e não do PHP em si.
			require "../controle_estoque/Conexao2.php";
			return $con;
		} catch(\PDOException $e) {
			return false;
		}
	}
}

