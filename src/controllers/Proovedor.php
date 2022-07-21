<?php
namespace src\controllers;

use models\ProovedoresTable;

class Proovedor{
    private $proovedorTable;

    public function __construct(
        ProovedoresTable $proovedoresTable
    )
    {
        $this->proovedorTable= $proovedoresTable;
    }

    public function add(){
        $data = [
            'nombre' => $_POST['nombres'],
            'apellido' => $_POST['apellidos'],
            'telefono' => empty($_POST['telefono']) == true ? 'undefined': $_POST['telefono'],
            'direccion' => empty($_POST['telefono']) == true ? 'undefined': $_POST['direccion'],
        ];
        try {
            $this->proovedorTable->insert($data);
            echo json_encode([
                'done' => 'Se guardo con exito el proovedor'
            ]);
            die;
        } catch (\PDOException $th) {
            echo json_encode([
                'done' => 'Error: ' . $th->getMessage()
            ]);
            die;
        }
       


    }
}