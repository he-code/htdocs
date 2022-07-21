<?php 

namespace src\frame;

use models\UsuarioTable;

class Autentification{
    private $employedTable;
    private $primaryKey;
    private $clave;

    public function __construct(
        UsuarioTable $employedTable,
        string $primaryKey,
        string $clave
    )
    {
        $this->employedTable= $employedTable;
        $this->primaryKey=$primaryKey;
        $this->clave= $clave;
        session_start();
    }

    public function startSession(string $ci, string $clave): bool
    {

        $employe = $this->employedTable->selectFromColumn($this->primaryKey,$ci);
        if($employe && password_verify($clave, $employe[0]->{$this->clave}) ){
            session_regenerate_id();
            $_SESSION['user'] = $ci;
            $_SESSION['password'] = $employe[0]->{$this->clave};
            return true;
        }else{
            return false;
        }

    }

    public function validationAll(){

        if(empty($_SESSION['user'])){
            return false;
        }
        
        $result = $this->employedTable->selectFromColumn($this->primaryKey, $_SESSION['user'])[0];

        
        if($result->{$this->clave} == $_SESSION['password']){
            return true;
        }else{
            return false;
        }
    }

    public function getUser(){

        if($this->validationAll()){
            return $this->employedTable->selectFromColumn($this->primaryKey, $_SESSION['user'])[0];
        }else{
            return false;
        }
        
    }
}