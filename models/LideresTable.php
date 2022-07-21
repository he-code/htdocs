<?php

namespace models;

class LideresTable extends DatabaseTable{
    public $cedula;
    public $nombre;
    public $apellido;
    public $cargo;
    public $id_institucion;
    public function __construct()
    {
        parent::__construct('lideres','cedula','\models\LideresTable',['lideres','cedula']);
    }
}