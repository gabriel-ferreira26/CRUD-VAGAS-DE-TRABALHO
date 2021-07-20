<?php

namespace App\Entity;
use \App\Db\Database;

class Vaga{
    
    /**
     * identificador unico da vaga
     * @var integer;
     */
    public $id;
    
    /**
     * Titulo da vaga
     * @var string;
     */
    public $titulo;

    /**
     * Descricao da vaga
     * @var string
     */
    public $descricao;

    /**
     * Se a vaga esta ativa ou não
     * @var string(s/n)
     */
    public $ativo;

    /**
     * Data de publicacao da vaga 
     * @var string
     */
    public $data;

    /**
     * Metoro responsavel por cadastrar uma nova vaga no banco
     * @return boolean
     */
    public function cadastrar(){
        //Definir data
        $this->data = date('Y-m-d H:i:s');

        //Inserir a vaga no banco
        $obDatabase = new Database('vagas');
        $this -> id = $obDatabase->insert([
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'ativo' => $this->ativo,
            'data' => $this->data
        ]);      

        return true;
        //retornar sucesso
    }

    /**
     * Metodo responsavel por obter as vagas do banco de dados 
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getVagas($where = null, $order = null, $limit = null){
        return (new Database('vagas'))->select($where,$order,$limit);
    }
}