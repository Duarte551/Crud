<?php

namespace App\db ;

use PDO;
use PDOException;

class Database 
{
    //Constante de conexão com o banco de dados
    
    const HOST = 'localhost';
    
    //Constante que define o nome do banco de dados

    const NAME = 'soufuturebd';

    //Constante que define o nome de usuário

    const USER = 'root';

    //Constante que define a senha

    const PASS = ''; 

    //Atributo que vai receber a tabela 

    private $tabela;

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

    public function execute ($query, $params = [])
    {
        try{
            $statement = $this->connection ->prepare($query);
            $statement ->execute($params);
            return $statement;
        }
        catch(PDOException $error){
            die ('Fatal Error' . $error ->getmessage());
        }
    }

}