<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database
{
    const HOST = 'mysql';
    const NAME = 'imob';
    const USER = 'lucas';
    const PASS = 'secret';

    private $table;
    private $connection;

    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Metodo para executar
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('ERROR' . $e->getMessage());
        }
    }


    /**
     * Metodo para inserir dados
     * @param array $values [field => value]
     * @return integer ID INSERIDO
     */
    public function insert($values)
    {
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        $this->execute($query, array_values($values));

        return $this->connection->lastInsertId();
    }


    /**
     * Metodo para consultar dados
     * @param string $where Condições WHERE
     * @param string $order Coluna ASC/DESC
     * @param int $limit Valor limite
     * @param string $columns Se for necessario retornar apenas algumas colunas
     * @return PDOStatement    
     */
    public function select($where = null, $order = null, $limit = null, $columns = '*')
    {
        $where = strlen($where) ? 'WHERE 1=1 ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        $query = 'SELECT' . $columns . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }
      

    /**
     * Metodo prar atualizar dados
     * @param string $where
     * @param array $values [field=> value]
     * @return boolean    
     */
    public function update($where, $values)
    {
        $fields = array_keys($values);

        $query =
            'UPDATE ' . $this->table .
            ' SET ' . implode('=?, ', $fields) . '=? WHERE ' . $where;

        $this->execute($query, array_values($values));

        return true;
    }


    /**
     * Metodo para excluir dados
     * @param string $where
     * @return boolean    
     */
    public function delete($where)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE ' . $where;

        $this->execute($query);

        return true;
    }
}
