<?php
namespace models;

class Materiales_Categoria extends DatabaseTable{
    public $orde_compra;
    public $id_categoria;
    public function __construct()
    {
        parent::__construct('materiales_categorias','orde_compra',
        '\models\Materiales_Categoria',['materiales_categorias','orde_compra']);
    }
}