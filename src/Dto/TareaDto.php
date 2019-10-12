<?php


namespace App\Dto;


class TareaDto
{

    public $idtarea;

    public $nombre;

    public $descripcion;

    public $estado;

    public $fechacreacion;

    public $fechaactualizacion;

    public $fechafinalizacion;

    public $idlista;

    public $idCategorias;

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

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
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @return mixed
     */
    public function getFechaactualizacion()
    {
        return $this->fechaactualizacion;
    }

    /**
     * @return mixed
     */
    public function getFechacreacion()
    {
        return $this->fechacreacion;
    }

    /**
     * @return mixed
     */
    public function getFechafinalizacion()
    {
        return $this->fechafinalizacion;
    }

    /**
     * @return mixed
     */
    public function getIdlista()
    {
        return $this->idlista;
    }

    /**
     * @return mixed
     */
    public function getIdtarea()
    {
        return $this->idtarea;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }

    /**
     * @param mixed $fechaactualizacion
     */
    public function setFechaactualizacion($fechaactualizacion): void
    {
        $this->fechaactualizacion = $fechaactualizacion;
    }

    /**
     * @param mixed $fechacreacion
     */
    public function setFechacreacion($fechacreacion): void
    {
        $this->fechacreacion = $fechacreacion;
    }

    /**
     * @param mixed $fechafinalizacion
     */
    public function setFechafinalizacion($fechafinalizacion): void
    {
        $this->fechafinalizacion = $fechafinalizacion;
    }

    /**
     * @param mixed $idlista
     */
    public function setIdlista($idlista): void
    {
        $this->idlista = $idlista;
    }

    /**
     * @param mixed $idtarea
     */
    public function setIdtarea($idtarea): void
    {
        $this->idtarea = $idtarea;
    }

    /**
     * @return mixed
     */
    public function getIdCategorias()
    {
        return $this->idCategorias;
    }

    /**
     * @param mixed $idCategorias
     */
    public function setIdCategorias($idCategorias): void
    {
        $this->idCategorias = $idCategorias;
    }

}