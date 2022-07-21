<?php

namespace models\conection;

include __DIR__ . '/../../config.php';

class Conection{
    private $pdo;


    public function getConection(){
        $this->pdo = new \PDO('pgsql:host=localhost;port=5432;dbname='.DBNAME,USER,PASS);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);

        return $this->pdo;
    }
}
