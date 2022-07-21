<?php

namespace src\aplication;

use models\Acta_Entrada;
use models\Acta_Entrega;
use models\Acta_Entrega_Materiales;
use models\CategoriasTable;
use models\Materiales_Categoria;
use models\MaterialesTable;
use models\ProovedoresTable;
use models\UsuarioTable;
use src\controllers\Acta;
use src\controllers\Home;
use src\controllers\Login;
use src\controllers\Materiales;
use src\controllers\Proovedor;
use src\frame\Autentification;
use src\frame\RoutesWeb;
use models\InstitucionesTable;
use models\LideresTable;

class RoutesAplication implements RoutesWeb{
    private $autentification;
    private $usuariosTable;
    private $materialesTable;
    private $proovedorTable;
    private $acta_entradaTable;
    private $acta_entregaTable;
    private $categoriasTable;
    private $categorias_materialesTable;
    private $institucionesTable;
    private $lideresTable;
    private $acta_entrega_materialesTable;
    public function __construct()
    {
        $this->usuariosTable= new UsuarioTable;
        $this->autentification= new Autentification($this->usuariosTable,'correo','password');
        $this->materialesTable = new MaterialesTable;
        $this->proovedorTable= new ProovedoresTable;
        $this->acta_entradaTable= new Acta_Entrada;
        $this->categoriasTable= new CategoriasTable;
        $this->categorias_materialesTable= new Materiales_Categoria;
        $this->institucionesTable= new InstitucionesTable;
        $this->lideresTable= new LideresTable;
        $this->acta_entregaTable= new Acta_Entrega;
        $this->acta_entrega_materialesTable= new Acta_Entrega_Materiales;
    }

    public function getRoutesAplication(): array
    {   

        $loginController = new Login($this->usuariosTable,$this->autentification);
        $homeController = new Home;
        $materialesController = new Materiales($this->materialesTable, 
        $this->proovedorTable,$this->acta_entradaTable,$this->categoriasTable,$this->categorias_materialesTable);
        $proovedorController = new Proovedor($this->proovedorTable);
        $actaController = new Acta($this->acta_entradaTable,
        $this->materialesTable,$this->proovedorTable
        , $this->autentification,$this->categoriasTable
        ,$this->categorias_materialesTable,
        $this->institucionesTable,$this->lideresTable,
        $this->acta_entregaTable,$this->acta_entrega_materialesTable,
        $this->usuariosTable);
        return [
            '' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'home'
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'verifyLogin'
                ]
                ],
            'inicio' => [
                'GET' => [
                    'controller' => $homeController,
                    'action' => 'inicio'
                ],
                'login' => true,
                'permission' => UsuarioTable::ADMIN
            ],
            'ingreso/productos-acta' => [
                'GET' => [
                    'controller' => $materialesController,
                    'action' => 'viewForm'
                ],
                'POST' => [
                    'controller' => $materialesController,
                    'action' => 'add'
                ],
                'login' => true,
                'permission' => UsuarioTable::ADMIN
            ],
            'add/proovedor' => [
                'POST' => [
                    'controller' => $proovedorController,
                    'action' => 'add'
                ],
            ],
            'view/acta-entrada' => [
                'GET' => [
                    'controller' => $actaController,
                    'action' => 'viewActa'
                ],
                'login' => true,
                'permission' => UsuarioTable::ADMIN
            ],
            'agregar/categoria' => [
                'POST' => [
                    'controller' => $materialesController,
                    'action' => 'addCategoria'
                ],
                'login' => true,
            ],
            'view/acta-salida' => [
                'GET' => [
                    'controller' => $actaController,
                    'action' => 'viewActaSalida'
                ],
                'POST' => [
                    'controller' => $actaController,
                    'action' => 'saveActaSalida'
                ],
                'login' => true,
                'permission' => UsuarioTable::ADMIN
                ],
            'get/materiales' => [
                'GET' => [
                    'controller' => $materialesController,
                    'action' => 'getMateriales'
                ]
            ],
            'add/institucion' => [
                'POST' => [
                    'controller' => $actaController,
                    'action' => 'addInstitucion'
                ]
            ],
            'get/instituciones' => [
                'GET' => [
                    'controller' => $actaController,
                    'action' => 'getLideres'
                ]
            ],
            'add/lideres' => [
                'POST' => [
                    'controller' => $actaController,
                    'action' => 'addLideres'
                ]
            ],
            'view/acta-entrega' => [
                'GET' => [
                    'controller' => $actaController,
                    'action' => 'viewActaEntrega'
                ],
                'login' => true,
                'permission' => UsuarioTable::ADMIN
            ],
            'add/admin' => [
                'GET' => [
                    'controller' => $actaController,
                    'action' => 'viewAdmin'
                ],
                'POST' => [
                    'controller' => $actaController,
                    'action' => 'addAdmin'
                ],
                'login' => true,
                'permission' => UsuarioTable::ADMIN
            ],
            'baja' => [
                'GET' => [
                    'controller' => $actaController,
                    'action' => 'bajaAdmin'
                ],
                'login' => true,
                'permission' => UsuarioTable::ADMIN
            ],
            'no/permission' => [
                'GET' => [
                    'controller' => $homeController,
                    'action' => 'regreso'
                ]
            ],
            'salir' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'salir'
                ]
            ],
        ];
    }

    public function getAutentification(): Autentification
    {
        return $this->autentification;
    }

    public function hashPermission($permision):bool
    {
        $user = $this->autentification->getUser();
        return $user->hashPermission($permision);
    }
}