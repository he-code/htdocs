<?php 
namespace models;

class CategoriasTable extends DatabaseTable{
    public $id;
    public $nombre;
    public function __construct()
    {
        parent::__construct('categorias','id','\models\CategoriasTable',['categorias','id']);
    }
}