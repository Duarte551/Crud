<?php

namespace App\db ;

use PDO;
use PDOException;

class Database 
{
    //Constante de conexão com o banco de dados
    
    const HOST = 'localhost';
    
    //Constante que define o nome do banco de dados

    const NAME = 'soufuturedb';

    //Constante que define o nome de usuário

    const USER = 'root';

    //Constante que define a senha

    const PASS = ''; 

    //Atributo que vai receber a tabela 

    private $table;

    //Atributo que define a conexão com o banco de dados

    private $connection;

    //Método responsável por criar a conexão com o banco de dados

    public function setConnection()
    {  
        try {
            //Método pra chamada de atributo de forma pública

        $this->connection = new PDO('mysql:host=' . self::HOST . 'dbname=' . self::NAME, self::USER, self::PASS);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        //Direção para tela de errro 

        catch (PDOException $erro) {
            // Mensagem de erro 

            die ('Fatal Error' . $erro ->getmessage());
        }
    }
    
    //Metódo para executar o comando SQL 

    public function execute($query, $params = [])
    {
        try{
            $statement = $this->connection ->prepare($query);
            $statement -> execute($params);
            return $statement;
        }
        catch(PDOException $error){
            die ('Fatal Error 2' . $error ->getmessage());
        }
    }

    //Metódo de criação de dados do banco  

    public function insert($values)
    {
        //Passa os dados pra query

        $fields = array_keys($values);
        $binds = array_pad([], count ($fields), '?');

        //Monta a query 

        $query = 'INSERT INTO' . $this->table . '(' . implode(',', $fields) . ') VALUES ('. implode(',', $binds);

        //Executa a query 

        $this->execute($query, array_values($values));

        //Retorna o último id inserido

        return $this->connection->lastInsertId();
    }

    public function select($where = NULL, $order = NULL, $limit = NULL, $fields = '*')
    {
        //Preparar os dados da query    

        $where = strlen($where) ? 'WHERE '. $where : '';
        $order = strlen($order) ? ' ORDER BY '. $order : '';
        $limit = strlen($limit) ? ' LIMIT '. $limit : '';

        //Montando a query  

        $query = 'SELECT' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        //Executa a query

        $this->execute ($query);
    }

    public function update($where, $values)
    {
        //Dados da query sendo passados

        $fields = array_keys($values);

        //Montando a query 

        $query = 'UPDATE' . $this->table . ' SET ' . implode('=?', $fields) . '=? WHERE' . $where ;
    }

    public function delete($where)
    {
        //Montar a query
        $query = 'DELETE FROM ' . $this->table . 'WHERE' . $where; 

        //Executa a query 
        $this->execute ($query); 

        //Retorna sucesso
        return true;
    }

}