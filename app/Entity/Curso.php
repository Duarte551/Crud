<?php 

namespace App\Entity;


use \PDO;
use App\app\db;
use App\db\Database;

class Curso 
{
    //Identificador único
    public $id; 

    //Nome do curso 
    public $NomeCurso; 

    //Descrição do curso 
    public $Descricao; 

    //Ativo
    public $Ativo; 

    //Data 
    public $Data;

    //Método responsável por inserir os cursos no banco
    public function cadastrar()
    {
        //Definir datas
        $this->Data = date('y-m-d');

        //Inserir cursos no banco de dados
        $obDatabase = new Database('cursos');
        $this -> id -> $obDatabase -> insert([
            "NomeCurso" => $this ->NomeCurso,
            "Ativo" => $this ->Ativo,
            "Descricao" => $this ->Descricao,
            "Data" => $this ->Data
        ]);

        //Retorna verdadeiro 
        return true;
    }

    public function atualizar() 
    {
        return(new Database('cursos'))->update('id= '.$this->id, [
            "NomeCurso" => $this ->NomeCurso,
            "Ativo" => $this ->Ativo,
            "Descricao" => $this ->Descricao,
            "Data" => $this ->Data
        ]);
    }

    public function excluir()
    {
        return(new Database('cursos'))->delete('id='. $this->id);
    }
}