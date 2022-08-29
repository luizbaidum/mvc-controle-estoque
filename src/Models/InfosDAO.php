<?php

namespace src\Models;

use MF\Model\Model;

class InfosDAO extends Model {

	protected $db;

	public function __construct(\PDO $db)
	{
		$this->db = $db;
	}

	public function getInfos()
	{
		$query = 'select id, titulo, descricao from tb_infos';

		return $this->db->query($query)->fetchAll();
	}
}