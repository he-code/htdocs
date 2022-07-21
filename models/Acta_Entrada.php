<?php 
namespace models;

class Acta_Entrada extends DatabaseTable{
    public $codigo;
    public $tipo;
    public $ci_ruc;
    public $factura;
    public $id_proovedor;
    public $proceso;
    public $solicitud;
    public $fecha;
    public function __construct()
    {
        parent::__construct('acta_entrada','codigo','\models\Acta_Entrada',['acta_entrada','codigo']);
    }
}