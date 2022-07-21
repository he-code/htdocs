<?php 
namespace models;

class Acta_Entrega extends DatabaseTable{
    public $numero;
    public $cedula_usuario;
    public $cedula_lider;
    public $fecha;
    public $cantidad;
    public function __construct()
    {
        parent::__construct('acta_entrega','numero','\models\Acta_Entrega',['acta_entrega','numero']);
    }
}