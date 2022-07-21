<?php

namespace models;

class InstitucionesTable extends DatabaseTable{
    public $id;
    public $nombre;

    public function __construct()
    {
        parent::__construct('instituciones','id',
        '\models\InstitucionesTable',['instituciones','id']);
    }
}