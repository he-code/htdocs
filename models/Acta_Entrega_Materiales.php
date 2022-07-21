<?php
namespace models;

class Acta_Entrega_Materiales extends DatabaseTable{
    public $numero_acta;
    public $orden_compra;
    public function __construct()
    {
        parent::__construct('acta_entrega_materiales','numero_acta',
        '\models\Acta_Entrega_Materiales',['acta_entrega_materiales','numero_acta']);
    }
}