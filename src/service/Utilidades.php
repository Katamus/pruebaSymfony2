<?php
namespace App\service;

class Utilidades{

    public function imprimir($variable){
        echo '<pre>';
        echo var_dump($variable);
        echo '</pre>';
    }

}