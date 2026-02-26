<?php

namespace src;

/**
 * Classe responsável por fornecer a conexão com o banco de dados.
 */
class Conexao
{
    /**
     * Retorna uma instância de conexão PDO.
     * @return \PDO|false
     */
    public static function getDb()
    {
        require_once __DIR__ . '/../conn/Conexao2.php';
        try {
            return (new ConfigConnection())->getConnection();
        } catch (\PDOException $e) {
            // Registre o erro em log ao invés de exibir diretamente
            error_log("Erro de conexão: " . $e->getMessage());
            return false;
        }
    }
}