<?php

namespace src\controllers;

class Home{

    
    public function inicio(){
        return [
            'title' => 'Inicio del Programa',
            'template' => 'admin/inicio.html.php'
        ];
    }
    public function regreso(){
        return [
            'title' => 'Inicio del Programa',
            'template' => 'admin/regreso.html.php'
        ];
    }
}