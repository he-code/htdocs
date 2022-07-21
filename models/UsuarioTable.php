<?php
namespace models;

class UsuarioTable extends DatabaseTable{
    public $cedula;
    public $nombre;
    public $apellido;
    public $correo;
    public $cargo;
    public $password;
    public $permission;
    const ADMIN = 16;

    public function __construct()
    {
        parent::__construct('usuarios','cedula','\models\UsuarioTable',['usuarios','cedula']);
    }

    public function hashPermission($permission){

        return $this->permission & $permission;
    }
}



