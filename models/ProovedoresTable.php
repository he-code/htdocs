<?php

namespace models;

class ProovedoresTable extends DatabaseTable{
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $direccion;


    public function __construct()
    {
        parent::__construct('proovedores','id','\models\ProovedoresTable',['proovedores','id']);
    }

}