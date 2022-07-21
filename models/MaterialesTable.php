<?php 
namespace models;

class MaterialesTable extends DatabaseTable{
    public $orden_compra;
    public $descripcion;
    public $cant;
    public $valor_unitario;
    public $id;
    public function __construct()
    {
        parent::__construct('materiales','orden_compra','\models\MaterialesTable',['materiales','orden_compra']);
    }
}