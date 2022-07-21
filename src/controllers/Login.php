<?php

namespace src\controllers;

use models\UsuarioTable;
use src\frame\Autentification;

class Login{
    private $usuarioTable;
    private $autentification;

    public function __construct(UsuarioTable $usuarioTable, Autentification $autentification)
    {
        $this->usuarioTable = $usuarioTable;
        $this->autentification = $autentification;
    }
    public function home(){
        $pass = password_hash('12345',PASSWORD_DEFAULT);
        $dataAdmin = [
            'cedula' => '0250186665',
            'nombre' => 'Dorian',
            'apellido' => 'Armijos',
            'correo' => 'dorian@gmail.com',
            'password' => $pass,
            'cargo' => 'Analista de Materiales',
            'permission' => UsuarioTable::ADMIN
        ];
        //$this->usuarioTable->insert($dataAdmin);
        return [
            'title' => 'Inicio',
            'template' => 'admin/home.html.php'
        ];
    }


    public function verifyLogin(){
        
        if($this->autentification->startSession($_POST['correo'],$_POST['clave'])){
            header('location: /inicio');
            exit();
        }else{
            return [
                'title' => 'Inicio',
                'template' => 'admin/home.html.php',
                'variables' => [
                    'error' => 'Su correo o / contraseña son incorrectas'
                ]
            ];
        }

    }

    public function salir(){
        unset($_SESSION);
        session_destroy();
        header('location: /');
    }

}