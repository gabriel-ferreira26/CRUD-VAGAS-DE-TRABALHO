<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database{

    const HOST = 'localhost:3306';
    const NAME = 'vagas';
    const USER = 'root';
    const PASS = '';

    /**
     * nome da tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * Instancia de conexão com o banco de dados 
     * @var PDO
     */
    private $connection;

    /**
     * Define a tabela e instancia a conexão
     * @param string $table
     */
    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }
    
    /**
     * Metodo responsavel por criar uma conexão com o banco de dados 
     */
    private function setConnection(){
 
        try{
            print_r(self::NAME);
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }

    /**
     * metodo responsavel por executar queries dentro do DB
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = []){
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }

    /**
     * Metodo responsavel por inserir dados no banco
     * @param array $values [field => values]
     * @return integer;
     */
    public function insert($values){
        //Dados da query
        $fields = array_keys($values);
        $binds = array_pad([],count($fields),'?');

        //Monta a query
        $query = 'INSERT INTO '.$this->table.'('.implode(',',$fields).') VALUES ('.implode(',',$binds).')';

        //Executa o insert
        $this->execute($query,array_values($values));

        //Retorna o Id inserido
        return $this->connection->lastInsertId();
    }   

    /**
     * Metodo responsavel por executar uma consulta no banco
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return PDOstatement
     */
    public function select($where = null, $order = null, $limit = null){
        $query = 'SELECT * FROM '.$this->table.'';
    }
    
}