<?php
namespace src\controllers;

use models\Acta_Entrada;
use models\Acta_Entrega;
use models\Acta_Entrega_Materiales;
use models\CategoriasTable;
use models\InstitucionesTable;
use models\LideresTable;
use models\Materiales_Categoria;
use models\MaterialesTable;
use models\ProovedoresTable;
use models\UsuarioTable;
use src\aplication\Utiles;
use src\frame\Autentification;

class Acta{
private $acta_entradaTable;
private $materialesTable;
private $proovedorTable;
private $autentification;
private $categoriasTable;
private $categorias_materialesTable;
private $institucionesTable;
private $lideresTable;
private $acta_entregaTable;
private $acta_entrega_materialesTable;
private $usuariosTable;
public function __construct(
    Acta_Entrada $acta_Entrada,
    MaterialesTable $materialesTable,
    ProovedoresTable $proovedoresTable,
    Autentification $autentification,
    CategoriasTable $categoriasTable,
    Materiales_Categoria $categorias_materialesTable,
    InstitucionesTable $institucionesTable,
    LideresTable $lideresTable,
    Acta_Entrega $acta_entregaTable,
    Acta_Entrega_Materiales $acta_entrega_materialesTable,
    UsuarioTable $usuariosTable
)
{
    $this->acta_entradaTable= $acta_Entrada;
    $this->materialesTable= $materialesTable;
    $this->proovedorTable= $proovedoresTable;
    $this->autentification= $autentification;
    $this->categoriasTable= $categoriasTable;
    $this->categorias_materialesTable= $categorias_materialesTable;
    $this->institucionesTable= $institucionesTable;
    $this->lideresTable= $lideresTable;
    $this->acta_entregaTable= $acta_entregaTable;
    $this->acta_entrega_materialesTable= $acta_entrega_materialesTable;
    $this->usuariosTable= $usuariosTable;

}

public function viewActa(){
    if(isset($_GET['id'])){
        $acta = $this->acta_entradaTable->selectFromColumn('codigo', trim($_GET['id']));
        if($acta){

            $materiales = $this->materialesTable->selectFromColumn('codigo_acta_entrada',$acta[0]->codigo);
            $proovedor = $this->proovedorTable->selectFromColumn('id', $acta[0]->id_proovedor)[0];
            $categoria_material = $this->categorias_materialesTable->selectFromColumn('orden_compra',$materiales[0]->orden_compra)[0];
            $categoria = $this->categoriasTable->selectFromColumn('id',$categoria_material->id_categoria)[0];
            $user = $this->autentification->getUser();
            return [
                'title' => 'Acta Entrada',
                'template' => 'admin/actaEntrada.html.php',
                'variables' => [
                    'materiales' => $materiales,
                    'acta' => $acta[0],
                    'proovedor' => $proovedor,
                    'user' => $user,
                    'categoria' => $categoria
                ]
            ];

        }else{
            header('location:/');
        }
    }else{
        header('location:/');
    }
}

    public function viewActaSalida(){
        $instituciones = $this->institucionesTable->select(null,null,true,'nombre');
        $categorias = $this->categoriasTable->select(null,null,true,'nombre');
        return[
            'title' => 'Completa Acta de Entrega',
            'template' => 'admin/viewActaSalida.html.php',
            'variables' => [
                'instituciones' => $instituciones,
                'categorias' => $categorias
            ]
        ];
    }

    public function addInstitucion(){
        $data = [
            'id' => $_POST['codigo'],
            'nombre' => $_POST['nombre']
        ];
        try {
            $this->institucionesTable->insert($data);
            echo json_encode(['done' => 'Se agrego correctamente la institucion']);
            die;
        } catch (\Throwable $th) {
            echo json_encode(['done' => 'Error: '.$th->getMessage()]);
            die;
        }
    }

    public function getLideres(){
        if(isset($_GET['id'])){
            $lideres = $this->lideresTable->selectFromColumn('id_institucion',$_GET['id']);
            echo json_encode( ["lideres" => $lideres],JSON_UNESCAPED_UNICODE);
            die;
        }   
        
    }

    public function addLideres(){
        $data = [
            'cedula' => $_POST['cedula'],
            'nombre' => $_POST['nombres'],
            'apellido' => $_POST['apellidos'],
            'cargo' => $_POST['cargo'],
            'id_institucion' => $_POST['institucion'] 
        ];
        try{
            $this->lideresTable->insert($data);
            echo json_encode(['done' => 'Se ingreso correctamente al lider']);
            die;
        }catch(\PDOException $e){
            echo json_encode(['done' => 'Error: '. $e->getMessage()]);
            die;
        }
    }

    public function saveActaSalida(){
       
        date_default_timezone_set('America/Guayaquil');
        $materiales = json_decode($_POST['materiales'],true);
        $actas = $this->acta_entregaTable->select();
        $user = $this->autentification->getUser();
        $date = new \DateTime();
        $codigoText = 'MINEDUC-CZ5-UDA-000-2022';
        if($actas){
            $codigoText = $actas[count($actas)-1]->numero;
        }
        $codigo = Utiles::generateNumeroActaSalida($codigoText);
        $dataActa = [
            'numero' => $codigo,
            'cedula_usuario' => $user->cedula,
            'fecha' => $date->format('Y-m-d H:i:s'),
            'cedula_lider' => $_POST['lider']
        ];
        
        $this->acta_entregaTable->insert($dataActa);
        foreach($materiales as $material){
            $dataMaterial = [
                'numero_acta' => $codigo,
                'orden_compra' => $material['id'],
                'cantidad' => $material['cant']
            ];
            $this->acta_entrega_materialesTable->insert($dataMaterial);

            $mater = $this->materialesTable->selectFromColumn('orden_compra',$material['id'])[0];
            $resta = intval($mater->cant) - intval($material['cant']);
            $dataUpdateM = [
                'cant' => $resta,
                'orden_compra' => $material['id']
            ];
            $this->materialesTable->update($dataUpdateM);
        }

        echo json_encode(['codigo'=> $codigo],JSON_UNESCAPED_UNICODE);
        die;
    }

    public function viewActaEntrega(){
        if(isset($_GET['id'])){
            $acta = $this->acta_entregaTable->selectFromColumn('numero',$_GET['id'])[0];
            $materiales_acta = $this->acta_entrega_materialesTable->selectFromColumn('numero_acta',$_GET['id']);
            $categoria_before =  $this->categorias_materialesTable->selectFromColumn('orden_compra',
            $materiales_acta[0]->orden_compra)[0];
            $categoria = $this->categoriasTable->selectFromColumn('id',$categoria_before->id_categoria)[0];
            $emisor = $this->usuariosTable->selectFromColumn('cedula',$acta->cedula_usuario)[0];
            $receptor = $this->lideresTable->selectFromColumn('cedula',$acta->cedula_lider)[0];
            $institucion = $this->institucionesTable->selectFromColumn('id',$receptor->id_institucion)[0];
            $materiales = [];
            foreach($materiales_acta as $material){
                $mater = $this->materialesTable->selectFromColumn('orden_compra',$material->orden_compra)[0];
                $mater->cant = $material->cantidad;
                array_push($materiales,$mater);
            }
           
            return[
                'title' => 'Acta de Entrega',
                'template' => 'admin/actaSalida.html.php',
                'variables' => [
                    'acta' => $acta,
                    'categoria' => $categoria,
                    'emisor' => $emisor,
                    'receptor' => $receptor,
                    'institucion' => $institucion,
                    'materiales' => $materiales
                ]
                ];
        }else{
            header('location: /');
        }
        
    }

    public function viewAdmin(){
        return [
            'title' => 'Ingresar Nuevo Administrador',
            'template' => 'admin/addAdmin.html.php'
        ];
    }

    public function addAdmin(){
        $dataAdmin = [
            'cedula' => $_POST['cedula'],
            'nombre' => $_POST['nombres'],
            'apellido' => $_POST['apellidos'],
            'correo' => $_POST['correo'],
            'password' => password_hash($_POST['password'],PASSWORD_DEFAULT),
            'cargo' => $_POST['cargo'],
            'permission' => UsuarioTable::ADMIN
        ];
        try {
            $this->usuariosTable->insert($dataAdmin);
            return [
                'title' => 'Ingresar Nuevo Administrador',
                'template' => 'admin/addAdmin.html.php',
                'variables' => [
                    'exito' => 'Se guardo con exito el nuevo administrador'
                ]
            ];
        } catch (\Throwable $th) {
            return [
                'title' => 'Ingresar Nuevo Administrador',
                'template' => 'admin/addAdmin.html.php',
                'variables' => [
                    'error' => 'Error: '. $th->getMessage()
                ]
            ];
        }
       

    }

    public function bajaAdmin(){
        $user = $this->autentification->getUser();
        $data = [
            'permission' => 0,
            'cedula' => $user->cedula
        ];
        $this->usuariosTable->update($data);
        header('location: /salir');
    }
}
 