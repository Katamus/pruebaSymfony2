<?php


namespace App\Dto;


class CategoriaDTO
{
    public $idcategoria;

    public $nombre;

    public $descripcion;

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $idcategoria
     */
    public function setIdcategoria($idcategoria): void
    {
        $this->idcategoria = $idcategoria;
    }

    /**
     * @return mixed
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }


}