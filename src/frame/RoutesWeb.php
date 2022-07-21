<?php 

namespace src\frame;

interface RoutesWeb {
    public function getRoutesAplication () : array;
    public function getAutentification(): Autentification;
    public function hashPermission($permision):bool;
}