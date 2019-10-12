<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria", indexes={@ORM\Index(name="idUsario_idx", columns={"idUsuario"})})
 * @ORM\Entity
 */
class Categoria
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCategoria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategoria;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=225, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=45, nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="datetime", nullable=false)
     */
    private $fechacreacion;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fechaActualizacion", type="datetime", nullable=true)
     */
    private $fechaactualizacion;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUsuario", referencedColumnName="idUsuario")
     * })
     */
    private $idusuario;

    public function getIdcategoria(): ?int
    {
        return $this->idcategoria;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getFechacreacion(): ?\DateTimeInterface
    {
        return $this->fechacreacion;
    }

    public function setFechacreacion(\DateTimeInterface $fechacreacion): self
    {
        $this->fechacreacion = $fechacreacion;

        return $this;
    }

    public function getFechaactualizacion(): ?\DateTimeInterface
    {
        return $this->fechaactualizacion;
    }

    public function setFechaactualizacion(?\DateTimeInterface $fechaactualizacion): self
    {
        $this->fechaactualizacion = $fechaactualizacion;

        return $this;
    }

    public function getIdusuario(): ?Usuario
    {
        return $this->idusuario;
    }

    public function setIdusuario(?Usuario $idusuario): self
    {
        $this->idusuario = $idusuario;

        return $this;
    }


}
