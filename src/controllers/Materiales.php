<?php 
namespace src\controllers;

use DateTime;
use models\Acta_Entrada;
use models\CategoriasTable;
use models\Materiales_Categoria;
use models\MaterialesTable;
use models\ProovedoresTable;
use src\aplication\Utiles;

class Materiales{
    private $materialesTable;
    private $proovedorTable;
    private $acta_entradaTable;
    private $categoriasTable;
    private $categorias_materialesTable;
    public function __construct(
        MaterialesTable $materialesTable,
        ProovedoresTable $proovedoresTable,
        Acta_Entrada $acta_entradaTable,
        CategoriasTable $categoriasTable,
        Materiales_Categoria $categorias_materialesTable
    )
    {
        $this->materialesTable= $materialesTable;
        $this->proovedorTable= $proovedoresTable;
        $this->acta_entradaTable= $acta_entradaTable;
        $this->categoriasTable= $categoriasTable;
        $this->categorias_materialesTable= $categorias_materialesTable;
    }

    public function viewForm(){
        $proovedores = $this->proovedorTable->select(null,null,true,'apellido');
        $categorias = $this->categoriasTable->select(null,null,true,'nombre');
        return [
            'title' => 'Ingreso de Productos',
            'template' => 'admin/viewFormAdd.html.php',
            'variables' => [
                'proovedores' => $proovedores,
                'categorias' => $categorias
            ]
        ];
    }

    public function add(){
        date_default_timezone_set('America/Guayaquil');
        $acta = $this->acta_entradaTable->select();
        $codigo = 'Nº 02D02-000-2022';
        if(count($acta) > 0){
            $codigo = $acta[count($acta)-1]->codigo;
        }

        $newCod = Utiles::generateNumeroActa($codigo);
        $date = new DateTime();
        $dataActa = [
            'codigo' => $newCod,
            'tipo' => $_POST['tipo'],
            'ci_ruc' => $_POST['ruc'],
            'id_proovedor' => $_POST['proovedor'],
            'factura' => $_POST['factura'],
            'proceso' => $_POST['proceso'],
            'solicitud' => $_POST['solicitud'],
            'fecha' => $date->format('Y-m-d H:i:s')
        ];
        
        $this->acta_entradaTable->insert($dataActa);
        for($i =0 ; $i < intval($_POST['referecia']); $i++){
            $dataMaterial = [];
                
                    $dataMaterial['orden_compra'] = $_POST['material'.$i]['orden'];
                    $dataMaterial['descripcion'] = $_POST['material'.$i]['descripcion'];
                    $dataMaterial['cant'] = $_POST['material'.$i]['cantidad'];
                    $dataMaterial['valor_unitario'] = $_POST['material'.$i]['valor'];
                    $dataMaterial['id_proovedor'] = $_POST['proovedor'];
                    $dataMaterial['codigo_acta_entrada'] = $newCod;
                

            $this->materialesTable->insert($dataMaterial);
            $dataCategorias_Materiales = [
                'orden_compra' => $_POST['material'.$i]['orden'],
                'id_categoria' => $_POST['categoria']
            ];

            $this->categorias_materialesTable->insert($dataCategorias_Materiales);
        }

        header('location: /view/acta-entrada?id='.$newCod);
        die;
    }

    public function addCategoria(){
        $data = [
            'nombre' => $_POST['nombre']
        ];
        try {
            $this->categoriasTable->insert($data);
            echo json_encode(['done' => 'Se guardao correctamente la categoria']);
            die;
        } catch (\Throwable $th) {
            echo json_encode(['done' => 'Error: '.$th->getMessage()]);
            die;
        }
    }

    public function getMateriales(){
        if(isset($_GET['id'])){
            $materiales_pre = $this->categorias_materialesTable->selectFromColumn('id_categoria',$_GET['id']);
            $materiales = [
                "materiales" => []
            ];
            foreach($materiales_pre as $material){
                $mater = $this->materialesTable->selectFromColumn('orden_compra', $material->orden_compra)[0];
                $materiales['materiales'][]= $mater;
            }
            echo json_encode($materiales);
            die;
        }

       
        die;
    }
}